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
            ->latest('pay_period');

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
        // Pay Period
        'pay_period'        => ['required', 'date'],

        // Employee Information
        'employee_id'       => ['required', 'string', 'max:100'],
        'name'              => ['required', 'string', 'max:255'],
        'department'        => ['nullable', 'string', 'max:255'],
        'designation'       => ['required', 'string', 'max:255'],

        // Earnings
        'monthly_salary'    => ['nullable', 'numeric', 'min:0'],
        'pera'              => ['nullable', 'numeric', 'min:0'],
        'gross_amount'      => ['nullable', 'numeric', 'min:0'],

        // Deductions
        'gsis_premium'      => ['nullable', 'numeric', 'min:0'],
        'hdmf_premium'      => ['nullable', 'numeric', 'min:0'],
        'tax_withheld'      => ['nullable', 'numeric', 'min:0'],
        'philhealth'        => ['nullable', 'numeric', 'min:0'],
        'conso_loan'        => ['nullable', 'numeric', 'min:0'],
        'policy_loan'       => ['nullable', 'numeric', 'min:0'],
        'hdmf_loan'         => ['nullable', 'numeric', 'min:0'],
        'landbank_loan'     => ['nullable', 'numeric', 'min:0'],
        'lraea'             => ['nullable', 'numeric', 'min:0'],
        'gabay'             => ['nullable', 'numeric', 'min:0'],
        'lraecc'            => ['nullable', 'numeric', 'min:0'],
        'ecash_adv'         => ['nullable', 'numeric', 'min:0'],
        'educ_ln'           => ['nullable', 'numeric', 'min:0'],
        'emer_ln'           => ['nullable', 'numeric', 'min:0'],
        'fip_g'             => ['nullable', 'numeric', 'min:0'],
        'fire_h'            => ['nullable', 'numeric', 'min:0'],
        'fire_n'            => ['nullable', 'numeric', 'min:0'],
        'hdmf_cal'          => ['nullable', 'numeric', 'min:0'],
        'hdmg_hsng'         => ['nullable', 'numeric', 'min:0'],
        'honor_disallow'    => ['nullable', 'numeric', 'min:0'],
        'ltcp_disallow'     => ['nullable', 'numeric', 'min:0'],
        'lwop'              => ['nullable', 'numeric', 'min:0'],
        'mri_h'             => ['nullable', 'numeric', 'min:0'],
        'mri_n'             => ['nullable', 'numeric', 'min:0'],
        'nhfmc'             => ['nullable', 'numeric', 'min:0'],
        'opt_pol_ln'        => ['nullable', 'numeric', 'min:0'],
        'rel'               => ['nullable', 'numeric', 'min:0'],
        'sri_g'             => ['nullable', 'numeric', 'min:0'],
        'uoli'              => ['nullable', 'numeric', 'min:0'],
        'gfal_ii'           => ['nullable', 'numeric', 'min:0'],
        'mpl'               => ['nullable', 'numeric', 'min:0'],
        'mpl_lite'          => ['nullable', 'numeric', 'min:0'],
        'comp_ln'           => ['nullable', 'numeric', 'min:0'],
        'nards'             => ['nullable', 'numeric', 'min:0'],
        'fine'              => ['nullable', 'numeric', 'min:0'],
        'help'              => ['nullable', 'numeric', 'min:0'],
        'pvb_ln'            => ['nullable', 'numeric', 'min:0'],
        'total_deductions'  => ['nullable', 'numeric', 'min:0'],

        // Net Pay
        'net_pay'           => ['nullable', 'numeric'],
        'pay_15th'          => ['nullable', 'numeric'],
        'pay_30th'          => ['nullable', 'numeric'],
        '15th_dop'          => ['nullable', 'date'],
        '30th_dop'          => ['nullable', 'date'],

        // Others
        'aom_2013_014'      => ['nullable', 'numeric', 'min:0'],
        'cna_2009'          => ['nullable', 'numeric', 'min:0'],
        'dorm_fee'          => ['nullable', 'numeric', 'min:0'],

        'is_archived'       => ['sometimes', 'boolean'],
        ]);

        $payslip = Payslip::create($validated);

        ActivityLog::record('created_payslip', 'Payslip Management', "Created payslip for {$payslip->employee_id}");

        return response()->json([
            'message' => 'Payslip created successfully.',
            'data'    => $payslip,
        ], 201);

    }

    public function show(Payslip $payslip): JsonResponse
    {
        return response()->json($payslip);
    }

    public function update(Request $request, Payslip $payslip): JsonResponse
    {
        $validated = $request->validate([
        // Pay Period
        'pay_period'        => ['sometimes', 'date'],

        // Employee Information
        'employee_id'       => ['sometimes', 'string', 'max:100'],
        'name'              => ['sometimes', 'string', 'max:255'],
        'department'        => ['sometimes', 'nullable', 'string', 'max:255'],
        'designation'       => ['sometimes', 'string', 'max:255'],

        // Earnings
        'monthly_salary'    => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'pera'              => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'gross_amount'      => ['sometimes', 'nullable', 'numeric', 'min:0'],

        // Deductions
        'gsis_premium'      => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'hdmf_premium'      => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'tax_withheld'      => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'philhealth'        => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'conso_loan'        => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'policy_loan'       => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'hdmf_loan'         => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'landbank_loan'     => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'lraea'             => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'gabay'             => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'lraecc'            => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'ecash_adv'         => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'educ_ln'           => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'emer_ln'           => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'fip_g'             => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'fire_h'            => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'fire_n'            => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'hdmf_cal'          => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'hdmg_hsng'         => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'honor_disallow'    => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'ltcp_disallow'     => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'lwop'              => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'mri_h'             => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'mri_n'             => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'nhfmc'             => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'opt_pol_ln'        => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'rel'               => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'sri_g'             => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'uoli'              => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'gfal_ii'           => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'mpl'               => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'mpl_lite'          => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'comp_ln'           => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'nards'             => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'fine'              => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'help'              => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'pvb_ln'            => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'total_deductions'  => ['sometimes', 'nullable', 'numeric', 'min:0'],

        // Net Pay
        'net_pay'           => ['sometimes', 'nullable', 'numeric'],
        'pay_15th'          => ['sometimes', 'nullable', 'numeric'],
        'pay_30th'          => ['sometimes', 'nullable', 'numeric'],
        '15th_dop'          => ['sometimes', 'nullable', 'date'],
        '30th_dop'          => ['sometimes', 'nullable', 'date'],

        // Others
        'aom_2013_014'      => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'cna_2009'          => ['sometimes', 'nullable', 'numeric', 'min:0'],
        'dorm_fee'          => ['sometimes', 'nullable', 'numeric', 'min:0'],

        'is_archived'       => ['sometimes', 'boolean'],
        ]);

        $payslip->update($validated);

        ActivityLog::record('updated_payslip', 'Payslip Management', "Updated payslip for {$payslip->employee_id}");

        return response()->json([
            'message' => 'Payslip updated successfully.',
            'data'    => $payslip->fresh(),
        ], 200);

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
                    $employeeId = trim((string) ($row['employee_id'] ?? $row['emp_id'] ?? $row['employee_number'] ?? $row['user_id'] ?? ''));
                    $payPeriod = $row['pay_period'] ?? $row['payroll_date'] ?? $row['pay_date'] ?? $row['paydate'] ?? null;
                    $name = isset($row['name']) ? trim((string) $row['name']) : '';
                    $department = isset($row['department']) ? trim((string) $row['department']) : '';
                    $designation = isset($row['designation']) ? trim((string) $row['designation']) : '';

                    if ($employeeId === '' || empty($payPeriod)) {
                        $skipped++;
                        continue;
                    }

                    $dateString = $this->normalizePayrollDate($payPeriod);
                    if ($dateString === null) {
                        $errors[] = ['row' => $rowIndex, 'error' => "Invalid pay_period for Employee ID {$employeeId}."];
                        continue;
                    }

                    $existing = Payslip::query()
                        ->withTrashed()
                        ->where('employee_id', $employeeId)
                        ->whereDate('pay_period', $dateString)
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

                        if ($name !== '' && empty($existing->name)) {
                            $existing->name = $name;
                            $needsUpdate = true;
                        }
                        if ($department !== '' && empty($existing->department)) {
                            $existing->department = $department;
                            $needsUpdate = true;
                        }
                        if ($designation !== '' && empty($existing->designation)) {
                            $existing->designation = $designation;
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
                        'pay_period' => $dateString,
                        'name' => $name !== '' ? $name : $employeeId,
                        'department' => $department !== '' ? $department : null,
                        'designation' => $designation !== '' ? $designation : 'N/A',
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
