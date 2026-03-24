<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Payslip;
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
            ->latest('payroll_date');

        if ($request->boolean('only_archived')) {
            $query->where('is_archived', true);
        } elseif ($request->boolean('include_archived')) {
            // include both active + archived (but still exclude soft-deleted)
        } else {
            $query->where('is_archived', false);
        }

        if ($request->filled('employee_id')) {
            $query->where('employee_id', trim((string) $request->input('employee_id')));
        }

        $payslips = $query->paginate(max(1, min($perPage, 100)));

        return response()->json($payslips);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'employee_id' => ['required', 'string', 'max:100'],
            'first_name' => ['nullable', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'payroll_date' => ['required', 'date'],
        ]);

        $payslip = Payslip::query()->create([
            'employee_id' => trim($validated['employee_id']),
            'first_name' => $validated['first_name'] ?? null,
            'middle_name' => $validated['middle_name'] ?? null,
            'last_name' => $validated['last_name'] ?? null,
            'payroll_date' => $validated['payroll_date'],
            'is_archived' => false,
        ]);

        ActivityLog::record('created_payslip', 'Payslip Management', "Created payslip for {$payslip->employee_id}");

        return response()->json($payslip, 201);
    }

    public function show(Payslip $payslip): JsonResponse
    {
        return response()->json($payslip);
    }

    public function update(Request $request, Payslip $payslip): JsonResponse
    {
        $validated = $request->validate([
            'employee_id' => ['required', 'string', 'max:100'],
            'first_name' => ['nullable', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'payroll_date' => ['required', 'date'],
        ]);

        $payslip->update([
            'employee_id' => trim($validated['employee_id']),
            'first_name' => $validated['first_name'] ?? null,
            'middle_name' => $validated['middle_name'] ?? null,
            'last_name' => $validated['last_name'] ?? null,
            'payroll_date' => $validated['payroll_date'],
        ]);

        ActivityLog::record('updated_payslip', 'Payslip Management', "Updated payslip for {$payslip->employee_id}");

        return response()->json($payslip);
    }

    public function destroy(Payslip $payslip): JsonResponse
    {
        $emp_id = $payslip->employee_id ?: (string) $payslip->id;
        $payslip->update(['is_archived' => true]);
        ActivityLog::record('archived_payslip', 'Payslip Management', "Archived payslip for {$emp_id}");

        return response()->json(['message' => 'Payslip archived successfully.']);
    }

    public function unarchive(Payslip $payslip): JsonResponse
    {
        $emp_id = $payslip->employee_id ?: (string) $payslip->id;

        if ($payslip->trashed()) {
            return response()->json([
                'message' => 'Cannot unarchive a deleted payslip.',
            ], 422);
        }

        $payslip->update(['is_archived' => false]);
        ActivityLog::record('unarchived_payslip', 'Payslip Management', "Unarchived payslip for {$emp_id}");

        return response()->json(['message' => 'Payslip unarchived successfully.']);
    }

    public function softDelete(Payslip $payslip): JsonResponse
    {
        $emp_id = $payslip->employee_id ?: (string) $payslip->id;

        $payslip->delete();

        ActivityLog::record('deleted_payslip', 'Payslip Management', "Soft-deleted payslip for {$emp_id}");

        return response()->json(['message' => 'Payslip deleted successfully.']);
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
                    $employeeId = trim((string) ($row['employee_id'] ?? $row['emp_id'] ?? $row['empid'] ?? $row['user_id'] ?? ''));
                    $payrollDate = $row['payroll_date'] ?? $row['pay_date'] ?? $row['paydate'] ?? null;
                    $firstName = isset($row['first_name']) ? trim((string) $row['first_name']) : null;
                    $middleName = isset($row['middle_name']) ? trim((string) $row['middle_name']) : null;
                    $lastName = isset($row['last_name']) ? trim((string) $row['last_name']) : null;

                    if ($employeeId === '' || empty($payrollDate)) {
                        $skipped++;
                        continue;
                    }

                    $dateString = $this->normalizePayrollDate($payrollDate);
                    if ($dateString === null) {
                        $errors[] = ['row' => $rowIndex, 'error' => "Invalid payroll_date for Employee ID {$employeeId}."];
                        continue;
                    }

                    $existing = Payslip::query()
                        ->withTrashed()
                        ->where('employee_id', $employeeId)
                        ->whereDate('payroll_date', $dateString)
                        ->first();

                    if ($existing) {
                        $needsUpdate = false;

                        if ($existing->trashed()) {
                            $existing->restore();
                            $needsUpdate = true;
                        }

                        if ($existing->is_archived) {
                            $existing->is_archived = false;
                            $needsUpdate = true;
                        }

                        if ($firstName !== null && $firstName !== '' && empty($existing->first_name)) {
                            $existing->first_name = $firstName;
                            $needsUpdate = true;
                        }
                        if ($middleName !== null && $middleName !== '' && empty($existing->middle_name)) {
                            $existing->middle_name = $middleName;
                            $needsUpdate = true;
                        }
                        if ($lastName !== null && $lastName !== '' && empty($existing->last_name)) {
                            $existing->last_name = $lastName;
                            $needsUpdate = true;
                        }

                        if ($needsUpdate) {
                            $existing->save();
                            $restored++;
                        } else {
                            $skipped++;
                        }
                        continue;
                    }

                    Payslip::query()->create([
                        'employee_id' => $employeeId,
                        'first_name' => $firstName ?: null,
                        'middle_name' => $middleName ?: null,
                        'last_name' => $lastName ?: null,
                        'payroll_date' => $dateString,
                        'is_archived' => false,
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
