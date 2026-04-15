<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\PayslipMailer;
use App\Models\ActivityLog;
use App\Models\Payslip;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
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
        'mp2'               => ['nullable', 'numeric', 'min:0'],
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
        'mp2'               => ['sometimes', 'nullable', 'numeric', 'min:0'],
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

    public function pdf(Request $request, Payslip $payslip)
    {
        $disposition = strtolower((string) $request->query('disposition', 'attachment'));
        if (! in_array($disposition, ['inline', 'attachment'], true)) {
            $disposition = 'attachment';
        }

        $templateHtml = view('payslips.template')->render();
        $templateHtml = $this->injectInlineLogoData($templateHtml);

        $renderedHtml = $this->renderPayslipTemplateHtml($templateHtml, $payslip);

        $pdf = Pdf::loadHTML($renderedHtml)
            ->setPaper('a4', 'portrait')
            ->setOption('isRemoteEnabled', true)
            ->setOption('isHtml5ParserEnabled', true);

        $payPeriod = $payslip->pay_period ? Carbon::parse($payslip->pay_period)->format('Y-m') : 'unknown';
        $employeeId = $payslip->employee_id ?: (string) $payslip->id;
        $employeeName = $payslip->name ?: (string) $payslip->id;
        $fileName = "{$payPeriod}_{$employeeName}.pdf";

        return $disposition === 'inline'
            ? $pdf->stream($fileName)
            : $pdf->download($fileName);
    }

    public function preview(Payslip $payslip)
    {
        $templateHtml = view('payslips.template')->render();
        $templateHtml = $this->injectInlineLogoData($templateHtml);

        $renderedHtml = $this->renderPayslipTemplateHtml($templateHtml, $payslip);

        return response($renderedHtml, 200)
            ->header('Content-Type', 'text/html');
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
            $failed = 0;
            $errors = [];

            foreach ($rows as $rowIndex => $row) {
                try {
                    // Ignore completely empty rows (common in spreadsheets).
                    $hasAnyValue = false;
                    foreach ($row as $v) {
                        if (is_string($v)) {
                            $v = trim($v);
                        }
                        if ($v !== null && $v !== '') {
                            $hasAnyValue = true;
                            break;
                        }
                    }
                    if (! $hasAnyValue) {
                        continue;
                    }

                    $aliases = [
                        'employee_id' => ['employee_id', 'emp_id', 'employee_number', 'employeenumber', 'employee_no', 'user_id'],
                        'pay_period' => ['pay_period', 'payperiod', 'payroll_date', 'pay_date', 'paydate'],
                        'name' => ['name', 'employee_name', 'employees_name'],
                        'department' => ['department', 'dept'],
                        'designation' => ['designation', 'position'],

                        // Earnings
                        'monthly_salary' => ['monthly_salary', 'salary_basic', 'salarybasic'],
                        'pera' => ['pera'],
                        'gross_amount' => ['gross_amount', 'gross_earnings'],

                        // Deductions 
                        'gsis_premium' => ['gsis_premium', 'gsis_membership_ins'],
                        'tax_withheld' => ['tax_withheld', 'withholding_tax'],
                        'philhealth' => ['philhealth', 'philhealth_contribution'],
                        'hdmf_premium' => ['hdmf_premium', 'hdmf_contribution'],
                        'conso_loan' => ['conso_loan', 'gsis_conso_salary_loan', 'conso_salary_loan'],
                        'policy_loan' => ['policy_loan'],
                        'hdmf_loan' => ['hdmf_loan'],
                        'mp2' => ['mp2'],
                        'opt_pol_ln' => ['opt_pol_ln', 'optional_policy_loan'],
                        'uoli' => ['uoli'],
                        'gfal_ii' => ['gfal_ii', 'gfal_ii_'],
                        'mpl' => ['mpl'],
                        'mpl_lite' => ['mpl_lite'],
                        'comp_ln' => ['comp_ln', 'comp_ln_'],
                        'emer_ln' => ['emer_ln', 'emergency_loan'],
                        'ecash_adv' => ['ecash_adv', 'cash_advance_loan'],
                        'rel' => ['rel'],
                        'fip_g' => ['fip_g', 'fib'],
                        'sri_g' => ['sri_g', 'sri'],
                        'mri_h' => ['mri_h', 'mri'],
                        'educ_ln' => ['educ_ln', 'educ_child'],
                        'hdmf_cal' => ['hdmf_cal', 'calamity_loan'],
                        'hdmg_hsng' => ['hdmg_hsng', 'housing_loan'],
                        'mri_n' => ['mri_n'],
                        'landbank_loan' => ['landbank_loan', 'land_bank_loan'],
                        'lraea' => ['lraea'],
                        'gabay' => ['gabay'],
                        'nards' => ['nards'],
                        'lraecc' => ['lraecc'],
                        'nhfmc' => ['nhfmc', 'nhmfc'],
                        'fire_h' => ['fire_h'],
                        'fire_n' => ['fire_n'],

                        'total_deductions' => ['total_deductions', 'total_deduction'],
                        'net_pay' => ['net_pay', 'netpay'],
                        'pay_15th' => ['pay_15th', '15th', 'first_payout_amount', 'firstpayoutamount'],
                        'pay_30th' => ['pay_30th', '30th', 'second_payout_amount', 'secondpayoutamount'],
                    ];

                    $get = function (string $field) use ($row, $aliases) {
                        $keys = $aliases[$field] ?? [$field];
                        foreach ($keys as $key) {
                            if (! array_key_exists($key, $row)) {
                                continue;
                            }
                            $value = $row[$key];
                            if (is_string($value)) {
                                $value = trim($value);
                            }
                            if ($value === '' || $value === null) {
                                continue;
                            }
                            return $value;
                        }
                        return null;
                    };

                    $employeeId = trim((string) ($get('employee_id') ?? ''));
                    $payPeriod = $get('pay_period');
                    $name = trim((string) ($get('name') ?? ''));
                    $department = trim((string) ($get('department') ?? ''));
                    $designation = trim((string) ($get('designation') ?? ''));

                    // Missing required columns is a "skipped" row, not an "error".
                    if ($employeeId === '' || empty($payPeriod)) {
                        $skipped++;
                        continue;
                    }

                    $dateString = $this->normalizePayrollDate($payPeriod);
                    if ($dateString === null) {
                        $failed++;
                        $errors[] = ['row' => $rowIndex, 'error' => "Invalid pay_period for Employee ID {$employeeId}."];
                        continue;
                    }

                    $payload = [
                        'employee_id' => $employeeId,
                        'pay_period' => $dateString,
                        'name' => $name !== '' ? $name : $employeeId,
                        'department' => $department !== '' ? $department : null,
                        'designation' => $designation !== '' ? $designation : 'N/A',
                        'is_archived' => false,
                    ];

                    $numericFields = [
                        'monthly_salary',
                        'pera',
                        'gross_amount',
                        'gsis_premium',
                        'hdmf_premium',
                        'tax_withheld',
                        'philhealth',
                        'conso_loan',
                        'policy_loan',
                        'hdmf_loan',
                        'opt_pol_ln',
                        'uoli',
                        'gfal_ii',
                        'mpl',
                        'mpl_lite',
                        'comp_ln',
                        'emer_ln',
                        'ecash_adv',
                        'educ_ln',
                        'fip_g',
                        'sri_g',
                        'mri_h',
                        'mri_n',
                        'fire_h',
                        'fire_n',
                        'hdmf_cal',
                        'hdmg_hsng',
                        'honor_disallow',
                        'ltcp_disallow',
                        'lwop',
                        'mp2',
                        'rel',
                        'landbank_loan',
                        'lraea',
                        'gabay',
                        'nards',
                        'lraecc',
                        'nhfmc',
                        'fine',
                        'help',
                        'pvb_ln',
                        'aom_2013_014',
                        'cna_2009',
                        'dorm_fee',
                        'total_deductions',
                        'net_pay',
                        'pay_15th',
                        'pay_30th',
                    ];

                    foreach ($numericFields as $field) {
                        $value = $get($field);
                        if ($value === null) {
                            continue;
                        }
                        $number = $this->normalizeNumber($value);
                        if ($number === null) {
                            continue;
                        }
                        $payload[$field] = $number;
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

                        foreach ($payload as $field => $value) {
                            if (in_array($field, ['employee_id', 'pay_period', 'is_archived'], true)) {
                                continue;
                            }
                            if ($value === null || $value === '') {
                                continue;
                            }
                            $current = $existing->getAttribute($field);
                            if ($current === null || $current === '') {
                                $existing->setAttribute($field, $value);
                                $needsUpdate = true;
                            }
                        }

                        if ($needsUpdate) {
                            $existing->save();
                            $restored++;
                        }
                        continue;
                    }

                    Payslip::query()->create($payload);

                    $created++;
                } catch (\Throwable $e) {
                    $failed++;
                    $errors[] = ['row' => $rowIndex, 'error' => $e->getMessage()];
                }
            }

            ActivityLog::record('imported_payslips', 'Payslip Management', "Imported payslips (created={$created}, restored={$restored}, skipped={$skipped}, failed={$failed})");

            return [
                'created' => $created,
                'restored' => $restored,
                'skipped' => $skipped,
                'failed' => $failed,
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

    private function normalizeNumber(mixed $value): ?float
    {
        if ($value === null) {
            return null;
        }

        if (is_int($value) || is_float($value)) {
            return is_finite((float) $value) ? (float) $value : null;
        }

        $string = trim((string) $value);
        if ($string === '') {
            return null;
        }

        $isNegative = false;
        if (preg_match('/^\\(.*\\)$/', $string) === 1) {
            $isNegative = true;
            $string = trim($string, " ()\t\n\r\0\x0B");
        }

        $string = str_replace([',', '₱', '$'], '', $string);
        $string = preg_replace('/[^0-9.\\-]/', '', $string) ?? '';
        if ($string === '' || $string === '-' || $string === '.') {
            return null;
        }

        if (! is_numeric($string)) {
            return null;
        }

        $number = (float) $string;
        if ($isNegative) {
            $number *= -1;
        }

        return is_finite($number) ? $number : null;
    }

    private function renderPayslipTemplateHtml(string $html, Payslip $payslip): string
    {
        $payPeriodIso = $payslip->pay_period ? Carbon::parse($payslip->pay_period)->format('Y-m-d') : '';

        $pay15Iso = $this->computePayoutDate($payPeriodIso, 14);
        $pay30Iso = $this->computePayoutDate($payPeriodIso, 28);

        $tokenValues = [
            'employee_id' => (string) ($payslip->employee_id ?? ''),
            'name' => (string) ($payslip->name ?? ''),
            'department' => (string) ($payslip->department ?? ''),
            'designation' => (string) ($payslip->designation ?? ''),
            'pay_period_label' => $this->formatPayPeriodLabel($payPeriodIso),

            // Earnings
            'monthly_salary' => $this->formatMoneyBlankZero($payslip->monthly_salary),
            'pera' => $this->formatMoneyBlankZero($payslip->pera),
            'gross_amount' => $this->formatMoneyBlankZero($payslip->gross_amount),

            // Deductions
            'gsis_premium' => $this->formatMoneyBlankZero($payslip->gsis_premium),
            'tax_withheld' => $this->formatMoneyBlankZero($payslip->tax_withheld),
            'philhealth' => $this->formatMoneyBlankZero($payslip->philhealth),
            'hdmf_premium' => $this->formatMoneyBlankZero($payslip->hdmf_premium),

            'conso_loan' => $this->formatMoneyBlankZero($payslip->conso_loan),
            'policy_loan' => $this->formatMoneyBlankZero($payslip->policy_loan),
            'hdmf_loan' => $this->formatMoneyBlankZero($payslip->hdmf_loan),
            'opt_pol_ln' => $this->formatMoneyBlankZero($payslip->opt_pol_ln),
            'uoli' => $this->formatMoneyBlankZero($payslip->uoli),
            'gfal_ii' => $this->formatMoneyBlankZero($payslip->gfal_ii),
            'mpl' => $this->formatMoneyBlankZero($payslip->mpl),
            'mpl_lite' => $this->formatMoneyBlankZero($payslip->mpl_lite),
            'comp_ln' => $this->formatMoneyBlankZero($payslip->comp_ln),
            'emer_ln' => $this->formatMoneyBlankZero($payslip->emer_ln),
            'ecash_adv' => $this->formatMoneyBlankZero($payslip->ecash_adv),
            'rel' => $this->formatMoneyBlankZero($payslip->rel),
            'fip_g' => $this->formatMoneyBlankZero($payslip->fip_g),
            'sri_g' => $this->formatMoneyBlankZero($payslip->sri_g),
            'mri_h' => $this->formatMoneyBlankZero($payslip->mri_h),
            'educ_ln' => $this->formatMoneyBlankZero($payslip->educ_ln),

            'hdmf_cal' => $this->formatMoneyBlankZero($payslip->hdmf_cal),
            'hdmg_hsng' => $this->formatMoneyBlankZero($payslip->hdmg_hsng),
            'mri_n' => $this->formatMoneyBlankZero($payslip->mri_n),
            'landbank_loan' => $this->formatMoneyBlankZero($payslip->landbank_loan),
            'lraea' => $this->formatMoneyBlankZero($payslip->lraea),
            'gabay' => $this->formatMoneyBlankZero($payslip->gabay),
            'nards' => $this->formatMoneyBlankZero($payslip->nards),
            'lraecc' => $this->formatMoneyBlankZero($payslip->lraecc),
            'nhfmc' => $this->formatMoneyBlankZero($payslip->nhfmc),

            'total_deductions' => $this->formatMoneyBlankZero($payslip->total_deductions),
            'net_pay' => $this->formatMoneyBlankZero($payslip->net_pay),
            '15th_dop' => $this->formatLongDate($pay15Iso),
            '30th_dop' => $this->formatLongDate($pay30Iso),
            'pay_15th' => $this->formatMoneyBlankZero($payslip->pay_15th),
            'pay_30th' => $this->formatMoneyBlankZero($payslip->pay_30th),
        ];

        foreach ($tokenValues as $key => $value) {
            $html = str_replace("__{$key}__", e((string) $value), $html);
        }

        $dynamicFields = [
            ['hdmf_loan', 'HDMF Loan'],
            ['mp2', 'MP2'],
            ['fip_g', 'FIP-G'],
            ['sri_g', 'SRI-G'],
            ['fire_h', 'FIRE-H'],
            ['fire_n', 'FIRE-N'],
            ['honor_disallow', 'HONOR DISALLOW'],
            ['ltcp_disallow', 'LTCP DISALLOW'],
            ['lwop', 'LWOP'],
            ['mri_h', 'MRI-H'],
            ['mri_n', 'MRI-N'],
            ['fine', 'FINE'],
            ['help', 'HELP'],
            ['pvb_ln', 'PVB LN'],
            ['aom_2013_014', 'AOM 2013-014'],
            ['cna_2009', 'CNA 2009'],
            ['dorm_fee', 'DORM FEE'],
        ];

        $dynamicRows = '';
        foreach ($dynamicFields as [$field, $label]) {
            $raw = $this->toNumber($payslip->getAttribute($field));
            if ($raw === null || $raw <= 0) {
                continue;
            }
            $dynamicRows .= "\n<tr>\n"
                . "  <td class=\"c1\"></td>\n"
                . "  <td class=\"c2\" style=\"padding-left: 50px\">" . e($label) . "</td>\n"
                . "  <td class=\"c3\">" . e($this->formatMoney($raw)) . "</td>\n"
                . "</tr>\n";
        }

        return str_replace('<!--__DYNAMIC_FIELDS__-->', $dynamicRows, $html);
    }

    private function injectInlineLogoData(string $html): string
    {
        $logoPath = resource_path('images/frontend/lra_logo.png');
        if (! is_file($logoPath)) {
            return $html;
        }

        $bytes = @file_get_contents($logoPath);
        if ($bytes === false || $bytes === '') {
            return $html;
        }

        $dataUri = 'data:image/png;base64,' . base64_encode($bytes);

        return preg_replace_callback('/<img\\b[^>]*alt="LRA Logo"[^>]*>/i', function ($matches) use ($dataUri) {
            $tag = $matches[0];
            if (preg_match('/\\bsrc\\s*=\\s*\"[^\"]*\"/i', $tag) === 1) {
                return preg_replace('/\\bsrc\\s*=\\s*\"[^\"]*\"/i', 'src="' . $dataUri . '"', $tag, 1) ?? $tag;
            }
            return $tag;
        }, $html, 1) ?? $html;
    }

    private function toNumber(mixed $value): ?float
    {
        if ($value === null) {
            return null;
        }

        if (is_int($value) || is_float($value)) {
            return is_finite((float) $value) ? (float) $value : null;
        }

        $string = trim((string) $value);
        if ($string === '') {
            return null;
        }

        $normalized = preg_replace('/[^0-9.\\-]/', '', str_replace(',', '', $string)) ?? '';
        if ($normalized === '' || $normalized === '-' || $normalized === '.') {
            return null;
        }

        $number = (float) $normalized;
        return is_finite($number) ? $number : null;
    }

    private function formatMoney(float $value): string
    {
        return number_format($value, 2, '.', ',');
    }

    private function formatMoneyBlankZero(mixed $value): string
    {
        $n = $this->toNumber($value);
        if ($n === null || $n == 0.0) {
            return '';
        }
        return $this->formatMoney($n);
    }

    private function formatLongDate(string $isoDate): string
    {
        if ($isoDate === '') {
            return '';
        }

        try {
            return Carbon::parse($isoDate)->format('F d, Y');
        } catch (\Throwable) {
            return $isoDate;
        }
    }

    private function formatPayPeriodLabel(string $isoDate): string
    {
        if ($isoDate === '') {
            return '';
        }

        try {
            return Carbon::parse($isoDate)->format('F Y');
        } catch (\Throwable) {
            return $isoDate;
        }
    }

    private function computePayoutDate(string $payPeriodIso, int $day): string
    {
        if ($payPeriodIso === '') {
            return '';
        }

        try {
            return Carbon::parse($payPeriodIso)->setDay($day)->format('Y-m-d');
        } catch (\Throwable) {
            return '';
        }
    }

    public function sendMail(Request $request, Payslip $payslip): JsonResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        $templateHtml = view('payslips.template')->render();
        $templateHtml = $this->injectInlineLogoData($templateHtml);
        $renderedHtml = $this->renderPayslipTemplateHtml($templateHtml, $payslip);

        $pdf = Pdf::loadHTML($renderedHtml)
            ->setPaper('a4', 'portrait')
            ->setOption('isRemoteEnabled', true)
            ->setOption('isHtml5ParserEnabled', true);

        $payPeriod = $payslip->pay_period ? Carbon::parse($payslip->pay_period)->format('Y-m') : 'unknown';
        $employeeName = Str::slug($payslip->name ?: (string) $payslip->id, '_');
        $fileName = "{$payPeriod}_{$employeeName}.pdf";

        Mail::to($validated['email'])->send(
            new PayslipMailer($payslip, $pdf->output(), $fileName)
        );

        ActivityLog::record(
            'emailed_payslip',
            'Payslip Management',
            "Emailed payslip for {$payslip->employee_id} to {$validated['email']}"
        );

        return response()->json([
            'message' => 'Payslip email sent successfully.',
        ]);
    }
}
