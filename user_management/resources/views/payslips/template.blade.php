<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Payroll Payment Slip</title>
  <style>
    @page { size: A4; margin: 0.4in; }
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: Arial, sans-serif;
      font-size: 11px;
      color: #000;
      background: #fff;
    }
    .container {
      width: 100%;
      border: 1px solid #000;
    }

    /* ── HEADER ── */
    .header {
      border-bottom: 2px solid #000;
      padding: 8px 10px 6px;
      text-align: center;
    }
    .header-top {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      margin-bottom: 4px;
    }
    .logo {
      width: 60px;
      height: 60px;
      flex-shrink: 0;
      border-radius: 50%;
      background: #0a5ba8;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      font-weight: bold;
      font-size: 16px;
    }
    .logo img {
      width: 100%;
      height: 100%;
      object-fit: contain;
      border-radius: 50%;
    }
    .org-info {
      text-align: center;
    }
    .org-name {
      font-weight: bold;
      font-size: 13px;
      margin-bottom: 1px;
    }
    .org-address {
      font-size: 10px;
      line-height: 1.2;
    }
    .slip-title {
      text-align: center;
      font-weight: bold;
      font-size: 13px;
      text-decoration: underline;
      margin: 3px 0 1px;
    }
    .slip-dept {
      text-align: center;
      font-size: 10px;
      font-weight: bold;
    }

    /* ── CONTENT ── */
    .content {
      padding: 8px 10px;
    }

    /* Employee Info */
    .info-table {
      width: 100%;
      font-size: 11px;
      border-collapse: collapse;
      margin-bottom: 4px;
    }
    .info-table td {
      padding: 1px 2px;
      vertical-align: top;
    }
    .info-table .label { white-space: nowrap; width: 120px; }
    .info-table .colon { width: 8px; }
    .info-table .emp-no-label { white-space: nowrap; text-align: right; padding-right: 4px; }
    .info-table .emp-no-val { white-space: nowrap; }

    /* Section Headers */
    .section-header {
      font-weight: bold;
      font-size: 11px;
      border-top: 1px solid #000;
      border-bottom: 1px solid #000;
      padding: 2px 3px;
      margin: 4px 0 0;
    }
    .section-header .right { float: right; }

    /* ── EARNINGS TABLE ── */
    .earnings-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 10px;
      margin-bottom: 1px;
    }
    .earnings-table td {
      padding: 1px 2px;
    }
    .earnings-table .col-label { width: 75%; }
    .earnings-table .col-amount { width: 25%; text-align: right; }
    .earnings-table .gross-row td {
      font-weight: bold;
      border-top: 1px solid #000;
      border-bottom: 1px solid #000;
      padding: 2px 2px;
    }

    /* ── DEDUCTIONS TABLE (single-column layout matching image) ── */
    .ded-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 10px;
      border: 1px solid #000;
    }
    .ded-table td {
      padding: 1px 4px;
      vertical-align: top;
    }
    .ded-table .col-label { width: 75%; }
    .ded-table .col-amount { width: 25%; text-align: right; }
    .ded-table .cat-header td {
      font-weight: bold;
      padding-top: 3px;
    }
    .ded-table .sub-item .col-label { padding-left: 20px; }
    .ded-table .sub-sub-item .col-label { padding-left: 40px; }

    .total-deductions-row td {
      font-weight: bold;
      border-top: 1px solid #000;
      padding: 2px 4px;
    }

    /* ── NET PAY ── */
    .net-pay-section {
      border: 1px solid #000;
      padding: 4px 6px;
      margin: 4px 0;
      display: flex;
      justify-content: space-between;
      font-weight: bold;
      font-size: 11px;
      align-items: center;
    }

    /* ── PAYOUT TABLE ── */
    .payout-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 10px;
      border: 1px solid #000;
    }
    .payout-table th, .payout-table td {
      padding: 2px 4px;
      border-bottom: 1px solid #000;
    }
    .payout-table th:last-child { text-align: right; }
    .payout-table td:last-child { text-align: right; }
    .payout-table th {
      font-weight: bold;
      background: #fafafa;
      text-align: left;
    }
    .payout-table tr:last-child td { border-bottom: none; }

    /* ── FOOTER ── */
    .footer-note {
      font-size: 8px;
      margin-top: 4px;
      line-height: 1.2;
    }
    .form-code {
      text-align: right;
      font-size: 8px;
      margin-top: 2px;
    }
    @page {
      size: A4;
      margin: 0.4in;
      @bottom-left { content: ''; }
      @bottom-center { content: ''; }
      @bottom-right { content: ''; }
      @top-left { content: ''; }
      @top-center { content: ''; }
      @top-right { content: ''; }
    }

  </style>
</head>
<body>
<div class="container">

  <!-- HEADER -->
  <div class="header">
    <div class="header-top">
      <div class="logo">
        <img src="{{ Vite::asset('resources/images/frontend/lra_logo.png') }}" alt="LRA Logo" />
      </div>
      <div class="org-info">
        <div class="org-name">Land Registration Authority</div>
        <div class="org-address">East Avenue Cor. NIA Road, Quezon City</div>
      </div>
    </div>
    <div class="slip-title">PAYROLL PAYMENT SLIP</div>
    <div class="slip-dept">INFO &amp; COMMUNICATIONS TECHNOLOGY</div>
  </div>

  <!-- CONTENT -->
  <div class="content">

    <!-- Employee Info -->
    <table class="info-table">
      <tr>
        <td class="label">Pay Period</td>
        <td class="colon">:</td>
        <td>{{ $payPeriod ?? 'April 2025' }}</td>
      </tr>
      <tr>
        <td class="label">Employees Name</td>
        <td class="colon">:</td>
        <td>{{ $employeeName ?? 'JUAN DELA CRUZ' }}</td>
      </tr>
      <tr>
        <td class="label">Position</td>
        <td class="colon">:</td>
        <td>{{ $position ?? 'COMP PROGRAMMER II' }}</td>
        <td class="emp-no-label">Employee No:</td>
        <td class="emp-no-val">{{ $employeeNo ?? '20260302' }}</td>
      </tr>
    </table>

    <!-- EARNINGS -->
    <div class="section-header">**Earnings** <span class="right">Monthly</span></div>
    <table class="earnings-table">
      <tr>
        <td class="col-label">Salary Basic</td>
        <td class="col-amount">{{ $salaryBasic ?? '50,413.00' }}</td>
      </tr>
      <tr>
        <td class="col-label">Salary Increase</td>
        <td class="col-amount">{{ $salaryIncrease ?? '' }}</td>
      </tr>
      <tr>
        <td class="col-label">Personnel Economic Relief Allowance</td>
        <td class="col-amount">{{ $pera ?? '2,000.00' }}</td>
      </tr>
      <tr>
        <td class="col-label">Others: (Specify)</td>
        <td class="col-amount">{{ $otherEarnings ?? '' }}</td>
      </tr>
      <tr class="gross-row">
        <td class="col-label" style="text-align:center;">Gross Earnings</td>
        <td class="col-amount">{{ $grossEarnings ?? '52,513.00' }}</td>
      </tr>
    </table>

    <!-- DEDUCTIONS -->
    <div class="section-header">**Deductions**</div>

    <!-- Single-column deductions table -->
    <table class="ded-table">
      <tr>
        <td class="col-label">GSIS Membership Ins</td>
        <td class="col-amount">{{ $gsisMembershipIns ?? '3,727.17' }}</td>
      </tr>
      <tr>
        <td class="col-label">Withholding Tax</td>
        <td class="col-amount">{{ $withholdingTax ?? '2,498.50' }}</td>
      </tr>
      <tr>
        <td class="col-label">PHILHEALTH Contribution</td>
        <td class="col-amount">{{ $philhealthContribution ?? '1,035.32' }}</td>
      </tr>
      <tr>
        <td class="col-label">HDMF Contribution</td>
        <td class="col-amount">{{ $hdmfContribution ?? '200.00' }}</td>
      </tr>
      <tr>
        <td class="col-label">HDMF Contribution (Additional)</td>
        <td class="col-amount">{{ $hdmfAdditional ?? '' }}</td>
      </tr>

      <!-- GSIS Loans -->
      <tr class="cat-header">
        <td class="col-label" colspan="2">GSIS</td>
      </tr>
      <tr class="sub-item">
        <td class="col-label">Conso/Salary Loan</td>
        <td class="col-amount">{{ $gsisConsoSalaryLoan ?? '' }}</td>
      </tr>
      <tr class="sub-item">
        <td class="col-label">Policy Loan</td>
        <td class="col-amount">{{ $policyLoan ?? '' }}</td>
      </tr>
      <tr class="sub-item">
        <td class="col-label">Optional Policy Loan</td>
        <td class="col-amount">{{ $optionalPolicyLoan ?? '' }}</td>
      </tr>
      <tr class="sub-item">
        <td class="col-label">UOLI</td>
        <td class="col-amount">{{ $uoli ?? '' }}</td>
      </tr>
      <tr class="sub-item">
        <td class="col-label">GFAL II</td>
        <td class="col-amount">{{ $gfalII ?? '' }}</td>
      </tr>
      <tr class="sub-item">
        <td class="col-label">MPL</td>
        <td class="col-amount">{{ $mpl ?? '' }}</td>
      </tr>
      <tr class="sub-item">
        <td class="col-label">MPL LITE</td>
        <td class="col-amount">{{ $mplLite ?? '' }}</td>
      </tr>
      <tr class="sub-item">
        <td class="col-label">Comp Ln</td>
        <td class="col-amount">{{ $compLn ?? '' }}</td>
      </tr>
      <tr class="sub-item">
        <td class="col-label">Emergency Loan</td>
        <td class="col-amount">{{ $emergencyLoan ?? '' }}</td>
      </tr>
      <tr class="sub-item">
        <td class="col-label">Cash Advance Loan</td>
        <td class="col-amount">{{ $cashAdvanceLoan ?? '' }}</td>
      </tr>
      <tr class="sub-item">
        <td class="col-label">REL</td>
        <td class="col-amount">{{ $rel ?? '' }}</td>
      </tr>
      <tr class="sub-sub-item">
        <td class="col-label">FIB</td>
        <td class="col-amount">{{ $fib1 ?? '' }}</td>
      </tr>
      <tr class="sub-sub-item">
        <td class="col-label">SRI</td>
        <td class="col-amount">{{ $sri1 ?? '' }}</td>
      </tr>
      <tr class="sub-sub-item">
        <td class="col-label">MRI</td>
        <td class="col-amount">{{ $mri1 ?? '' }}</td>
      </tr>
      <tr class="sub-sub-item">
        <td class="col-label">Educ Child</td>
        <td class="col-amount">{{ $educChild ?? '' }}</td>
      </tr>

      <!-- HDMF Multi Purpose Loan -->
      <tr class="cat-header">
        <td class="col-label" colspan="2">HDMF-Multi Purpose Loan</td>
      </tr>
      <tr class="sub-item">
        <td class="col-label">Calamity Loan</td>
        <td class="col-amount">{{ $calamityLoan ?? '' }}</td>
      </tr>

      <!-- Housing Loan -->
      <tr class="cat-header">
        <td class="col-label" colspan="2">&nbsp; Housing Loan</td>
      </tr>
      <tr class="sub-sub-item">
        <td class="col-label">FIB</td>
        <td class="col-amount">{{ $fib2 ?? '' }}</td>
      </tr>
      <tr class="sub-sub-item">
        <td class="col-label">SRI</td>
        <td class="col-amount">{{ $sri2 ?? '' }}</td>
      </tr>
      <tr class="sub-sub-item">
        <td class="col-label">MRI</td>
        <td class="col-amount">{{ $mri2 ?? '' }}</td>
      </tr>

      <!-- Multi-purpose Loan -->
      <tr class="cat-header">
        <td class="col-label" colspan="2">Multi-purpose Loan</td>
      </tr>

      <!-- Other Loans -->
      <tr class="cat-header">
        <td class="col-label" colspan="2">Other Loans</td>
      </tr>
      <tr class="sub-item">
        <td class="col-label">Land Bank Loan</td>
        <td class="col-amount">{{ $landBankLoan ?? '' }}</td>
      </tr>

      <!-- Other Deductions -->
      <tr class="cat-header">
        <td class="col-label" colspan="2">Other Deductions</td>
      </tr>
      <tr class="sub-item">
        <td class="col-label">LRAEA</td>
        <td class="col-amount">{{ $lraea ?? '20.00' }}</td>
      </tr>
      <tr class="sub-item">
        <td class="col-label">GABAY</td>
        <td class="col-amount">{{ $gabay ?? '' }}</td>
      </tr>
      <tr class="sub-item">
        <td class="col-label">NARDS</td>
        <td class="col-amount">{{ $nards ?? '' }}</td>
      </tr>
      <tr class="sub-item">
        <td class="col-label">LRAECC</td>
        <td class="col-amount">{{ $lraecc ?? '' }}</td>
      </tr>
      <tr class="sub-item">
        <td class="col-label">NHMFC</td>
        <td class="col-amount">{{ $nhmfc ?? '' }}</td>
      </tr>
      <tr class="sub-sub-item">
        <td class="col-label">FIRE</td>
        <td class="col-amount">{{ $fire ?? '' }}</td>
      </tr>
      <tr class="sub-sub-item">
        <td class="col-label">MRI</td>
        <td class="col-amount">{{ $mri3 ?? '' }}</td>
      </tr>

      <!-- Total Deductions -->
      <tr class="total-deductions-row">
        <td class="col-label" style="text-align:center;">Total Deductions</td>
        <td class="col-amount">{{ $totalDeductions ?? '7,470.00' }}</td>
      </tr>
    </table>

    <!-- NET PAY -->
    <div class="net-pay-section">
      <span>**Net Pay**</span>
      <span>{{ $netPay ?? '45,003.00' }}</span>
    </div>

    <!-- PAYOUT TABLE -->
    <table class="payout-table">
      <thead>
        <tr>
          <th>Amount Due</th>
          <th>DATE OF PAYOUT</th>
          <th>Amount</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>15<sup>th</sup></td>
          <td>{{ $firstPayoutDate ?? 'April 14, 2025' }}</td>
          <td>{{ $firstPayoutAmount ?? '22,501.5' }}</td>
        </tr>
        <tr>
          <td>30<sup>th</sup></td>
          <td>{{ $secondPayoutDate ?? 'April 28, 2025' }}</td>
          <td>{{ $secondPayoutAmount ?? '22,501.5' }}</td>
        </tr>
      </tbody>
    </table>

    <div class="footer-note">
      Not Included: Phil Veterans Bank Ln. COOP Ln &amp; Credit Union Ln
    </div>

  </div><!-- /content -->
</div><!-- /container -->
<div class="form-code">A-HRDD FRM 2015 007</div>
</body>
</html>