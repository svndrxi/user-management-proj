<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>LRA Payslip Email Template</title>
  <style>
    /* ===== RESET & BASE ===== */
    body {
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
      font-family: Arial, sans-serif;
    }

    /* ===== OUTER WRAPPER ===== */
    .outer-wrapper {
      width: 100%;
      background-color: #f4f4f4;
      padding: 0;
      border-collapse: collapse;
    }

    .outer-wrapper > tbody > tr > td {
      text-align: center;
    }

    /* ===== EMAIL CONTAINER ===== */
    .email-container {
      width: 780px;
      max-width: 780px;
      background-color: #ffffff;
      border-collapse: collapse;
    }

    /* ===== HEADER ===== */
    .header-cell {
      background-color: #F5C700;
      padding: 14px 30px;
      vertical-align: middle;
    }

    .header-inner {
      border-collapse: collapse;
      width: 100%;
    }

    .header-logo-cell {
      padding-right: 18px;
      vertical-align: middle;
      width: 80px;
    }

    .header-logo {
      display: block;
      width: 75px;
      height: 75px;
    }

    .header-text-cell {
      vertical-align: middle;
      text-align: left;
    }

    .header-org-name {
      margin: 0 0 3px 0;
      font-size: 22px;
      font-weight: bold;
      color: #1a2f6e;
      line-height: 1.2;
    }

    .header-address {
      margin: 0;
      font-size: 13px;
      font-weight: normal;
      color: #1a2f6e;
      line-height: 1.3;
    }

    /* ===== TITLE BAR ===== */
    .title-cell {
      background-color: #1a2f6e;
      padding: 14px 30px;
      text-align: center;
    }

    .title-text {
      color: #ffffff;
      font-size: 16px;
      font-weight: bold;
      letter-spacing: 1px;
      text-transform: uppercase;
    }

    /* ===== BODY AREA ===== */
    .body-outer-cell {
      padding: 0;
    }

    .body-watermark-table {
      width: 100%;
      border-collapse: collapse;
      background-image:
        linear-gradient(rgba(255,255,255,0.9), rgba(255,255,255,0.9)),
        url('lra_logo.png');
      background-repeat: no-repeat;
      background-position: center;
      background-size: 50%;
    }

    .body-content-cell {
      padding: 36px 44px 48px 44px;
    }

    /* ===== TYPOGRAPHY ===== */
    .greeting {
      margin: 0 0 20px 0;
      font-size: 20px;
      font-weight: bold;
      color: #1a2f6e;
    }

    .greeting em {
      font-style: italic;
    }

    .body-text {
      margin: 0 0 20px 10px;
      font-size: 14px;
      color: #222222;
      line-height: 1.6;
    }

    .body-text-last {
      margin: 0 0 28px 10px;
      font-size: 14px;
      color: #222222;
      line-height: 1.6;
    }

    .signoff {
      margin: 0 0 4px 10px;
      font-size: 14px;
      color: #222222;
    }

    .signoff-last {
      margin: 0 0 0 10px;
      font-size: 14px;
      color: #222222;
    }

    /* ===== FOOTER YELLOW BAR ===== */
    .footer-bar {
      background-color: #F5C700;
      height: 24px;
    }

    /* ===== DISCLAIMER ===== */
    .disclaimer-cell {
      background-color: #ffffff;
      padding: 10px 30px 14px 30px;
    }

    .disclaimer-text {
      margin: 0;
      font-size: 9px;
      color: #555555;
      line-height: 1.5;
    }
  </style>
</head>
<body>

  <!-- Outer wrapper -->
  <table class="outer-wrapper" cellpadding="0" cellspacing="0" border="0">
    <tr>
      <td>

        <!-- Email container -->
        <table class="email-container" cellpadding="0" cellspacing="0" border="0">

          <!-- ===== HEADER ===== -->
          <tr>
            <td class="header-cell">
              <table class="header-inner" cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td class="header-logo-cell">
                    <!-- REPLACE: swap src with your actual logo filename e.g. src="lra_logo.png" -->
                    <img src="{{ asset('lra_logo.png') }}" alt="LRA Logo" class="header-logo" />
                  </td>
                  <td class="header-text-cell">
                    <p class="header-org-name">Land Registration Authority</p>
                    <p class="header-address">East Avenue Cor. NIA Road, Quezon City</p>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- ===== TITLE BAR ===== -->
          <tr>
            <td class="title-cell">
              <span class="title-text">PAYSLIP FOR {{ strtoupper($payPeriod) }}</span>
            </td>
          </tr>

          <!-- ===== BODY WITH WATERMARK BACKGROUND ===== -->
          <tr>
            <td class="body-outer-cell">
              <table class="body-watermark-table" cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td class="body-content-cell">

                    <!-- Greeting -->
                    <p class="greeting">Hi <em>{{ $employeeName }}</em>,</p>

                    <!-- Good day -->
                    <p class="body-text">Good day.</p>

                    <!-- Para 1 -->
                    <p class="body-text">
                      Please find attached your payslip for the period of {{ $payPeriod }}. This document
                      contains a detailed summary of your earnings, deductions, and net pay.
                    </p>

                    <!-- Para 2 -->
                    <p class="body-text">
                      We encourage you to review your payslip carefully and verify that all information is
                      accurate. If you have any questions, concerns, or notice any discrepancies, please
                      do not hesitate to contact the HR Department for assistance.
                    </p>

                    <!-- Para 3 -->
                    <p class="body-text-last">
                      Kindly note that this payslip contains confidential payroll information and is
                      intended solely for your reference. Please handle it with care and refrain from
                      sharing it with unauthorized individuals.
                    </p>

                    <!-- Thank you -->
                    <p class="body-text">Thank you.</p>

                    <!-- Sign-off -->
                    <p class="signoff">Best regards,</p>
                    <p class="signoff">HR Department</p>
                    <p class="signoff-last">Land Registration Authority</p>

                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- ===== FOOTER YELLOW BAR ===== -->
          <tr>
            <td class="footer-bar">&nbsp;</td>
          </tr>

          <!-- ===== DISCLAIMER ===== -->
          <tr>
            <td class="disclaimer-cell">
              <p class="disclaimer-text">
                <strong>Disclaimer:</strong> The content of this email is confidential and intended for the recipient specified in message only. It is strictly forbidden to share any part
                of this message with any third party, without a written consent of the sender. If you received this message by mistake, please reply to this message
                and follow with its deletion, so that we can ensure such a mistake does not occur in the future.
              </p>
            </td>
          </tr>

        </table>
        <!-- /Email container -->

      </td>
    </tr>
  </table>

</body>
</html>