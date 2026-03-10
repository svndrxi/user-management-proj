<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Payslip;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PayslipApiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $perPage = (int) $request->integer('per_page', 15);

        $query = Payslip::query()
            ->with(['user'])
            ->latest('payroll_date');

        if ($request->boolean('only_archived')) {
            $query->onlyTrashed();
        } elseif ($request->boolean('include_archived')) {
            $query->withTrashed();
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', (int) $request->input('user_id'));
        }

        $payslips = $query->paginate(max(1, min($perPage, 100)));

        return response()->json($payslips);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'payroll_date' => ['required', 'date'],
        ]);

        $payslip = Payslip::query()->create([
            'user_id' => (int) $validated['user_id'],
            'payroll_date' => $validated['payroll_date'],
        ]);

        $payslip->load(['user']);
        ActivityLog::record('created_payslip', 'Payslip Management', "Created payslip #{$payslip->id}");

        return response()->json($payslip, 201);
    }

    public function show(Payslip $payslip): JsonResponse
    {
        $payslip->load(['user']);

        return response()->json($payslip);
    }

    public function update(Request $request, Payslip $payslip): JsonResponse
    {
        $validated = $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'payroll_date' => ['required', 'date'],
        ]);

        $payslip->update([
            'user_id' => (int) $validated['user_id'],
            'payroll_date' => $validated['payroll_date'],
        ]);

        $payslip->load(['user']);
        ActivityLog::record('updated_payslip', 'Payslip Management', "Updated payslip #{$payslip->id}");

        return response()->json($payslip);
    }

    public function destroy(Payslip $payslip): JsonResponse
    {
        $id = $payslip->id;
        $payslip->delete();
        ActivityLog::record('archived_payslip', 'Payslip Management', "Archived payslip #{$id}");

        return response()->json(['message' => 'Payslip archived successfully.']);
    }

    public function import(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'file' => ['required', 'file', 'max:10240', 'mimes:xlsx,xls,csv'],
        ]);

        /** @var UploadedFile $file */
        $file = $validated['file'];
        $extension = strtolower((string) $file->getClientOriginalExtension());

        if (in_array($extension, ['xlsx', 'xls'], true) && ! class_exists(\PhpOffice\PhpSpreadsheet\IOFactory::class)) {
            return response()->json([
                'message' => 'Excel import requires phpoffice/phpspreadsheet. Install it via Composer (e.g. composer require phpoffice/phpspreadsheet) or upload a .csv instead.',
            ], 422);
        }

        $rows = match ($extension) {
            'csv' => $this->readCsvRows($file),
            'xlsx', 'xls' => $this->readSpreadsheetRows($file),
            default => [],
        };

        $result = DB::transaction(function () use ($rows) {
            $created = 0;
            $restored = 0;
            $skipped = 0;
            $errors = [];

            foreach ($rows as $rowIndex => $row) {
                try {
                    $employeeId = trim((string) ($row['employee_id'] ?? $row['emp_id'] ?? $row['empid'] ?? ''));
                    $payrollDate = $row['payroll_date'] ?? $row['pay_date'] ?? $row['paydate'] ?? null;

                    if ($employeeId === '' || empty($payrollDate)) {
                        $skipped++;
                        continue;
                    }

                    $user = User::query()->where('employee_id', $employeeId)->first();
                    if (! $user) {
                        $errors[] = ['row' => $rowIndex, 'error' => "Employee ID {$employeeId} not found."];
                        continue;
                    }

                    $dateString = $this->normalizePayrollDate($payrollDate);
                    if ($dateString === null) {
                        $errors[] = ['row' => $rowIndex, 'error' => "Invalid payroll_date for Employee ID {$employeeId}."];
                        continue;
                    }

                    $existing = Payslip::query()
                        ->withTrashed()
                        ->where('user_id', $user->id)
                        ->whereDate('payroll_date', $dateString)
                        ->first();

                    if ($existing) {
                        if ($existing->trashed()) {
                            $existing->restore();
                            $restored++;
                        } else {
                            $skipped++;
                        }
                        continue;
                    }

                    Payslip::query()->create([
                        'user_id' => $user->id,
                        'payroll_date' => $dateString,
                    ]);

                    $created++;
                } catch (\Throwable $e) {
                    $errors[] = ['row' => $rowIndex, 'error' => $e->getMessage()];
                }
            }

            ActivityLog::record('imported_payslips', 'Payslip Management', "Imported payslips (created={$created}, restored={$restored}, skipped={$skipped})");

            return [
                'created' => $created,
                'restored' => $restored,
                'skipped' => $skipped,
                'errors' => $errors,
            ];
        });

        return response()->json($result);
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function readCsvRows(UploadedFile $file): array
    {
        $path = $file->getRealPath();
        if (! $path) {
            return [];
        }

        $handle = fopen($path, 'r');
        if ($handle === false) {
            return [];
        }

        try {
            $header = fgetcsv($handle);
            if (! is_array($header)) {
                return [];
            }

            $header = array_map(fn ($h) => $this->normalizeHeader((string) $h), $header);

            $rows = [];
            $rowNumber = 1; // header row
            while (($data = fgetcsv($handle)) !== false) {
                $rowNumber++;
                $row = [];
                foreach ($header as $i => $key) {
                    if ($key === '') {
                        continue;
                    }
                    $row[$key] = $data[$i] ?? null;
                }
                $rows[$rowNumber] = $row;
            }

            return $rows;
        } finally {
            fclose($handle);
        }
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function readSpreadsheetRows(UploadedFile $file): array
    {
        $path = $file->getRealPath();
        if (! $path) {
            return [];
        }

        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($path);
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($path);
        $sheet = $spreadsheet->getActiveSheet();

        $rawRows = $sheet->toArray(null, true, true, true);
        if (count($rawRows) < 2) {
            return [];
        }

        $headerRow = array_shift($rawRows);
        $headers = [];
        foreach ($headerRow as $col => $value) {
            $headers[$col] = $this->normalizeHeader((string) $value);
        }

        $rows = [];
        foreach ($rawRows as $rowIndex => $raw) {
            $row = [];
            foreach ($headers as $col => $key) {
                if ($key === '') {
                    continue;
                }
                $row[$key] = $raw[$col] ?? null;
            }
            $rows[$rowIndex] = $row;
        }

        return $rows;
    }

    private function normalizeHeader(string $value): string
    {
        $value = Str::of($value)->trim()->lower()->replace([' ', '-', '.'], '_')->toString();
        $value = preg_replace('/[^a-z0-9_]/', '', $value) ?? '';
        $value = preg_replace('/_+/', '_', $value) ?? '';

        return trim((string) $value, '_');
    }

    private function normalizePayrollDate(mixed $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $string = trim((string) $value);
        if ($string === '') {
            return null;
        }

        // YYYY-MM-DD
        if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $string) === 1) {
            return $string;
        }

        // Excel serial number (only when PhpSpreadsheet is available)
        if (is_numeric($value) && class_exists(\PhpOffice\PhpSpreadsheet\Shared\Date::class)) {
            try {
                $dt = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject((float) $value);
                return $dt->format('Y-m-d');
            } catch (\Throwable) {
                return null;
            }
        }

        try {
            return (new \DateTimeImmutable($string))->format('Y-m-d');
        } catch (\Throwable) {
            return null;
        }
    }
}
