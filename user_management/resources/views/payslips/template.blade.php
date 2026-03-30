<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LRA_Payslip_{{ $last_name ?? 'Employee' }}</title>
  <style>
    @page { size: A4; margin: 0.4in; }
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: Arial, sans-serif;
      font-size: 9px;
      color: #000;
      background: #fff;
    }
    .container {
      width: 65%;
      border: 1px solid #000;
      margin: 0 auto;
    }

    /* ── HEADER ── */
    .header {
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
    .org-info { text-align: center; }
    .org-name { font-weight: bold; font-size: 13px; margin-bottom: 1px; }
    .org-address { font-size: 10px; line-height: 1.2; }
    .slip-title {
      text-align: center;
      font-weight: bold;
      font-size: 13px;
      text-decoration: underline;
      margin: 3px 0 1px;
    }
    .slip-dept { text-align: center; font-size: 10px; }

    /* ── CONTENT ── */
    .content { padding: 8px 10px; }

    /* Employee Info */
    .info-table {
      width: 100%;
      font-size: 11px;
      border-collapse: collapse;
      margin-bottom: 4px;
    }
    .info-table td { padding: 1px 2px; vertical-align: top; }
    .info-table .label { white-space: nowrap; width: 120px; }
    .info-table .colon { width: 8px; }
    .info-table .emp-no-label { white-space: nowrap; text-align: right; padding-right: 4px; }
    .info-table .emp-no-val { white-space: nowrap; }

    /* ── HORIZONTAL DIVIDERS ── */
    .divider {
      border: none;
      border-top: 1px solid #000;
      margin: 4px -10px;
      display: block;
    }

    /* Section Headers */
    .section-header {
      font-weight: bold;
      font-size: 11px;
      padding: 2px 0;
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
    .earnings-table td { padding: 1px 2px; }
    .earnings-table .col-label { width: 75%; }
    .earnings-table .col-amount { width: 25%; text-align: right; }
    .earnings-table .gross-row td {
      font-weight: bold;
      padding: 2px 2px;
    }

    /* ── DEDUCTIONS TABLE ── */
    .ded-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 10px;
    }
    .ded-table td {
      padding: 1px 2px;
      vertical-align: top;
      border: none;
      word-wrap: break-word;
    }
    /* c1: category label - wide enough for longest text "HDMF-Multi Purpose Loan" */
    .ded-table .c1 { width: 20%;}
    /* c2: sub-item label */
    .ded-table .c2 { width: 20%; }
    /* c3: amount */
    .ded-table .c3 { width: 25%; text-align: right; padding-right: 0; }

    .ded-table .total-row td {
      font-weight: bold;
      padding-top: 3px;
      padding-bottom: 3px;
    }
    .ded-table .spacer td { height: 6px; }

    /* ── NET PAY ── */
    .net-pay-section {
      padding: 3px 0;
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
  table-layout: fixed;
}
.payout-table th, .payout-table td {
  padding: 1px 3px;
}
.payout-table th:first-child, .payout-table td:first-child { width: 20%; text-align: left; }
.payout-table th:nth-child(2), .payout-table td:nth-child(2) { width: 60%; text-align: center; }
.payout-table th:last-child, .payout-table td:last-child { width: 20%; text-align: right; }

    /* ── FOOTER ── */
    .footer-note { font-size: 6px; margin-top: 6px; line-height: 1.2; }
    .form-code { text-align: right; font-size: 8px; margin: 0 auto; width: 62%; }

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
<br><br><br><br><br>
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
    <br>
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

    <!-- Divider 1: below employee info -->
    <hr class="divider">

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

    <!-- Divider 2: below gross earnings -->
    <hr class="divider">

    <!-- DEDUCTIONS -->
    <div class="section-header">**Deductions**</div>

    <table class="ded-table">

      <!-- ── Direct deductions: label spans c1+c2 ── -->
      <tr>
        <td colspan="2">GSIS Membership Ins</td>
        <td class="c3">{{ $gsisMembershipIns ?? '3,727.17' }}</td>
      </tr>
      <tr>
        <td colspan="2">Withholding Tax</td>
        <td class="c3">{{ $withholdingTax ?? '2,498.50' }}</td>
      </tr>
      <tr>
        <td colspan="2">PHILHEALTH Contribution</td>
        <td class="c3">{{ $philhealthContribution ?? '1,035.32' }}</td>
      </tr>
      <tr>
        <td colspan="2">HDMF Contribution</td>
        <td class="c3">{{ $hdmfContribution ?? '200.00' }}</td>
      </tr>
      <tr>
        <td colspan="2">HDMF Contribution (Additional)</td>
        <td class="c3">{{ $hdmfAdditional ?? '' }}</td>
      </tr>

      <tr class="spacer"><td colspan="3"></td></tr>

      <!-- ── GSIS: c1=label, c2=sub-item ── -->
      <tr>
        <td class="c1">GSIS</td>
        <td class="c2">Conso/Salary Loan</td>
        <td class="c3">{{ $gsisConsoSalaryLoan ?? '' }}</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2">Policy Loan</td>
        <td class="c3">{{ $policyLoan ?? '' }}</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2">Optional Policy Loan</td>
        <td class="c3">{{ $optionalPolicyLoan ?? '' }}</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2">UOLI</td>
        <td class="c3">{{ $uoli ?? '' }}</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2">GFAL II</td>
        <td class="c3">{{ $gfalII ?? '' }}</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2">MPL</td>
        <td class="c3">{{ $mpl ?? '' }}</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2">MPL LITE</td>
        <td class="c3">{{ $mplLite ?? '' }}</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2">Comp Ln</td>
        <td class="c3">{{ $compLn ?? '' }}</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2">Emergency Loan</td>
        <td class="c3">{{ $emergencyLoan ?? '' }}</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2">Cash Advance Loan</td>
        <td class="c3">{{ $cashAdvanceLoan ?? '' }}</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2">REL</td>
        <td class="c3">{{ $rel ?? '' }}</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2" style="padding-left:70px;">FIB</td>
        <td class="c3">{{ $fib1 ?? '' }}</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2" style="padding-left:70px;">SRI</td>
        <td class="c3">{{ $sri1 ?? '' }}</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2" style="padding-left:70px;">MRI</td>
        <td class="c3">{{ $mri1 ?? '' }}</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2" style="padding-left:65px;">Educ Child</td>
        <td class="c3">{{ $educChild ?? '' }}</td>
      </tr>

      <tr class="spacer"><td colspan="3"></td></tr>

      <!-- ── HDMF-Multi Purpose Loan: c1=label, all sub-items in c2 ── -->
      <tr>
        <td class="c1">HDMF-Multi Purpose Loan</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2">Calamity Loan</td>
        <td class="c3">{{ $calamityLoan ?? '' }}</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2">Housing Loan</td>
        <td class="c3"></td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2" style="padding-left:70px;">FIB</td>
        <td class="c3">{{ $fib2 ?? '' }}</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2" style="padding-left:70px;">SRI</td>
        <td class="c3">{{ $sri2 ?? '' }}</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2" style="padding-left:70px;">MRI</td>
        <td class="c3">{{ $mri2 ?? '' }}</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2">Multi-purpose Loan</td>
        <td class="c3"></td>
      </tr>

      <tr class="spacer"><td colspan="3"></td></tr>

      <!-- ── Other Loans: c1=label, Land Bank Loan in c2 ── -->
      <tr>
          <td class="c1">Other Loans</td>
      <tr>
      <tr>
        <td class="c1"></td>
        <td class="c2">Land Bank Loan</td>
        <td class="c3">{{ $landBankLoan ?? '' }}</td>
      </tr>

      <tr class="spacer"><td colspan="3"></td></tr>

      <!-- ── Other Deductions: c1=label, all sub-items in c2 ── -->
      <tr>
        <td class="c1">Other Deductions</td>
      <tr>
      <tr>
        <td class="c1"></td>
        <td class="c2">LRAEA</td>
        <td class="c3">{{ $lraea ?? '20.00' }}</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2">GABAY</td>
        <td class="c3">{{ $gabay ?? '' }}</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2">NARDS</td>
        <td class="c3">{{ $nards ?? '' }}</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2">LRAECC</td>
        <td class="c3">{{ $lraecc ?? '' }}</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2">NHMFC</td>
        <td class="c3">{{ $nhmfc ?? '' }}</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2" style="padding-left:70px">FIRE</td>
        <td class="c3">{{ $fire ?? '' }}</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2" style="padding-left:70px;">MRI</td>
        <td class="c3">{{ $mri3 ?? '' }}</td>
      </tr>

      <tr class="spacer"><td colspan="3"></td></tr>

      <tr class="total-row">
        <td class="c1"></td>
        <td class="c2" style="font-weight: bold; padding-left: 50px;">Total Deductions</td>
        <td class="c3" style="font-weight:bold;">{{ $totalDeductions ?? '7,470.00' }}</td>
      </tr>
    </table>

    <!-- Divider 3: below total deductions / above net pay -->
    <hr class="divider">

    <!-- NET PAY -->
    <div class="net-pay-section">
      <span>**Net Pay**</span>
      <span>{{ $netPay ?? '45,003.00' }}</span>
    </div>

    <!-- PAYOUT TABLE -->
    <table class="payout-table">
      <thead>
        <tr>
          <th style="font-weight: normal;">Amount Due</th>
          <th style="font-weight: normal;">DATE OF PAYOUT</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>15th</td>
          <td>{{ $firstPayoutDate ?? 'April 14, 2025' }}</td>
          <td>{{ $firstPayoutAmount ?? '22,501.5' }}</td>
        </tr>
        <tr>
          <td>30th</td>
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
<br>
<div class="form-code">A-HRDD FRM 2015 007</div>
</body>
</html>