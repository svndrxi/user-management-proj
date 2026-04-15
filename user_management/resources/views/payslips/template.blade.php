<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LRA_Payslip___employee_id__</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: Arial, sans-serif;
      font-size: 9px;
      color: #000;
      background: #fff;
    }
    .container {
      width: 72%;
      border: 1px solid #000;
      margin: 0 auto;
    }

    /* ── HEADER ── */
    .header {
      padding: 8px 10px 6px;
      text-align: center;
    }
    .header-top {
      width:100%; 
      border-collapse:collapse; 
      margin-bottom:4px;
    }
    .logo {
      width: 60px; vertical-align: middle; padding-right: 10px; padding-left: 115px;
    }
    .logo-img {
      width:72px; height:72px; border-radius:50%; display:block;
    }
    .org-info { vertical-align: middle; text-align: center; padding-right:115px;}
    .org-name { font-weight: bold; font-size: 10px; margin-bottom: 1px; }
    .org-address { font-size: 8px; line-height: 1.2; }
    .slip-title {
      text-align: center;
      font-weight: bold;
      font-size: 12px;
      text-decoration: underline;
      padding-top: 20px;
      margin: 3px 0 1px;
    }
    .slip-dept { text-align: left; padding:10px 0 0 138px; font-size: 11px; }

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
    .right {padding-right:10%;}

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
    .ded-table .c2 { width: 36%; }
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
      width:100%; 
      border-collapse:collapse; 
      font-weight:bold; 
      font-size:11px; 
      padding: 3px 0;
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
    .footer-note { font-size: 8px; margin-top: 6px; line-height: 1.2; }
    .form-code { text-align: right; font-size: 8px; margin: 0 auto; width: 68%; }

    @page {
      size: A4;
      margin: 0.5in;
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
    <table class="header-top">
      <tr>
        <td class="logo">
          <img src="{{ Vite::asset('resources/images/frontend/lra_logo.png') }}" alt="LRA Logo"
              class="logo-img"/>
        </td>
        <td class="org-info">
          <div class="org-name">Land Registration Authority</div>
          <div class="org-address">East Avenue Cor. NIA Road, Quezon City</div>
          <div class="slip-title">PAYROLL PAYMENT SLIP</div>
          <br>
        </td>
      </tr>
    </table>
    <div class="slip-dept">__department__</div>
  </div>

  <!-- CONTENT -->
  <div class="content">

    <!-- Employee Info -->
    <table class="info-table">
      <tr>
        <td class="label">Pay Period:</td>
        <td class="colon"></td>
        <td>__pay_period_label__</td>
      </tr>
      <tr>
        <td class="label">Employee's Name:</td>
        <td class="colon"></td>
        <td>__name__</td>
      </tr>
      <tr>
        <td class="label">Position:</td>
        <td class="colon"></td>
        <td>__designation__</td>
        <td class="emp-no-label">Employee No:</td>
        <td class="emp-no-val">__employee_id__</td>
      </tr>
    </table>

    <!-- Divider 1: below employee info -->
    <hr class="divider">

    <!-- EARNINGS -->
    <div class="section-header">**Earnings** <span class="right">Monthly</span></div>
    <table class="earnings-table">
      <tr>
        <td class="col-label">Salary Basic</td>
        <td class="col-amount">__monthly_salary__</td>
      </tr>
      <tr>
        <td class="col-label">Salary Increase</td>
        <td class="col-amount"></td>
      </tr>
      <tr>
        <td class="col-label">Personnel Economic Relief Allowance</td>
        <td class="col-amount">__pera__</td>
      </tr>
      <tr>
        <td class="col-label">Others: (Specify)</td>
        <td class="col-amount"></td>
      </tr>
      <tr class="gross-row">
        <td class="col-label" style="text-align:center;">Gross Earnings</td>
        <td class="col-amount">__gross_amount__</td>
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
        <td class="c3">__gsis_premium__</td>
      </tr>
      <tr>
        <td colspan="2">Withholding Tax</td>
        <td class="c3">__tax_withheld__</td>
      </tr>
      <tr>
        <td colspan="2">PHILHEALTH Contribution</td>
        <td class="c3">__philhealth__</td>
      </tr>
      <tr>
        <td colspan="2">HDMF Contribution</td>
        <td class="c3">__hdmf_premium__</td>
      </tr>
      <tr>
        <td colspan="2">HDMF Contribution (Additional)</td>
        <td class="c3"></td>
      </tr>

      <tr class="spacer"><td colspan="3"></td></tr>

      <!-- ── GSIS: c1=label, c2=sub-item ── -->
      <tr>
        <td class="c1">GSIS</td>
        <td class="c2">Conso/Salary Loan</td>
        <td class="c3">__conso_loan__</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2">Policy Loan</td>
        <td class="c3">__policy_loan__</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2">Optional Policy Loan</td>
        <td class="c3">__opt_pol_ln__</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2">UOLI</td>
        <td class="c3">__uoli__</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2">GFAL II</td>
        <td class="c3">__gfal_ii__</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2">MPL</td>
        <td class="c3">__mpl__</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2">MPL LITE</td>
        <td class="c3">__mpl_lite__</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2">Comp Ln</td>
        <td class="c3">__comp_ln__</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2">Emergency Loan</td>
        <td class="c3">__emer_ln__</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2">Cash Advance Loan</td>
        <td class="c3">__ecash_adv__</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2">REL</td>
        <td class="c3">__rel__</td>
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
        <td class="c3">__educ_ln__</td>
      </tr>

      <tr class="spacer"><td colspan="3"></td></tr>

      <!-- ── HDMF-Multi Purpose Loan: c1=label, all sub-items in c2 ── -->
      <tr>
        <td class="c1">HDMF-Multi Purpose Loan</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2">Calamity Loan</td>
        <td class="c3">__hdmf_cal__</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2">Housing Loan</td>
        <td class="c3">__hdmg_hsng__</td>
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
        <td class="c3">__landbank_loan__</td>
      </tr>

      <tr class="spacer"><td colspan="3"></td></tr>

      <!-- ── Other Deductions: c1=label, all sub-items in c2 ── -->
      <tr>
        <td class="c1">Other Deductions</td>
      <tr>
      <tr>
        <td class="c1"></td>
        <td class="c2">LRAEA</td>
        <td class="c3">__lraea__</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2">GABAY</td>
        <td class="c3">__gabay__</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2">NARDS</td>
        <td class="c3">__nards__</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2">LRAECC</td>
        <td class="c3">__lraecc__</td>
      </tr>
      <tr>
        <td class="c1"></td>
        <td class="c2">NHMFC</td>
        <td class="c3">__nhfmc__</td>
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

      <!--__DYNAMIC_FIELDS__-->

      <tr class="spacer"><td colspan="3"></td></tr>

      <tr class="total-row">
        <td class="c1"></td>
        <td class="c2" style="font-weight: bold; padding-left: 50px;">Total Deductions</td>
        <td class="c3" style="font-weight:bold;">__total_deductions__</td>
      </tr>
    </table>

    <!-- Divider 3: below total deductions / above net pay -->
    <hr class="divider">

    <!-- NET PAY -->
    <table style="width:100%; border-collapse:collapse; font-weight:bold; font-size:11px; padding: 3px 0;">
      <tr>
        <td style="text-align:left;">**Net Pay**</td>
        <td style="text-align:right;">__net_pay__</td>
      </tr>
    </table>  

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
          <td>__15th_dop__</td>
          <td>__pay_15th__</td>
        </tr>
        <tr>
          <td>30th</td>
          <td>__30th_dop__</td>
          <td>__pay_30th__</td>
        </tr>
      </tbody>
    </table>

    <div class="footer-note">
      Not Included: Phil Veterans Bank Ln. COOP Ln &amp; Credit Union Ln
    </div>

  </div><!-- /content -->
</div><!-- /container -->
<br>
<div class="form-code">A-HRDD.FRM.2015.007</div>
<br><br><br><br><br>
</body>
</html>
