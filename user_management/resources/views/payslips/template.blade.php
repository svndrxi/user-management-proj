<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Payroll Slip</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #333333; margin: 0; padding: 0; background: #ffffff;">

  <div style="max-width: 700px; margin: 0 auto; padding: 36px 40px;">

    <!-- ===== HEADER ===== -->
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 28px;">
      <tr>
        <td style="width: 55%; vertical-align: middle;">
          <table style="border-collapse: collapse;">
            <tr>
              <td style="vertical-align: middle; padding-right: 12px;">
                @if(isset($logoUrl) && $logoUrl)
                  <img src="{{ $logoUrl }}" alt="LRA Logo"
                       style="width: 68px; height: 68px; object-fit: contain; display: block;" />
                @else
                  <div style="width: 68px; height: 68px; background: #0a1f6e; border-radius: 50%;
                               display: flex; align-items: center; justify-content: center;
                               font-size: 10px; color: #fff; text-align: center; line-height: 1.2;">
                    LRA
                  </div>
                @endif
              </td>
              <td style="vertical-align: middle;">
                <div style="font-size: 16px; font-weight: 700; color: #0a1f6e; line-height: 1.2; margin-bottom: 4px;">
                  Land Registration Authority
                </div>
                <div style="font-size: 11px; color: #555555; line-height: 1.5;">
                  East Avenue cor. NIA Road, Diliman,<br>
                  Quezon City, 1101 Metro Manila
                </div>
              </td>
            </tr>
          </table>
        </td>
        <td style="width: 45%; text-align: right; vertical-align: top; color: #555555; font-size: 11.5px; line-height: 1.7;">
          <div>Address</div>
          <div>your@email.com</div>
          <div>222 555 7777</div>
        </td>
      </tr>
    </table>

    <!-- ===== DIVIDER ===== -->
    <hr style="border: none; border-top: 1px solid #cccccc; margin-bottom: 22px;" />

    <!-- ===== TITLE ===== -->
    <h1 style="text-align: center; font-size: 22px; font-weight: 700; color: #111111;
                margin: 0 0 8px 0; letter-spacing: 0.01em;">
      Payroll Slip
    </h1>
    <p style="text-align: center; font-size: 13px; color: #333333; margin: 0 0 26px 0;">
      <strong>Pay Period:</strong> {{ $payPeriod ?? 'January 1 - 15, 2050' }};
      <strong>Pay Date:</strong> {{ $payDate ?? 'January 16, 2050' }}
    </p>

    <!-- ===== EMPLOYEE INFO ===== -->
    <p style="font-size: 13px; margin: 0 0 6px 0;">
      <strong>Employee Name:</strong> {{ $employeeName ?? 'Lester Nolan' }}
    </p>
    <p style="font-size: 13px; margin: 0 0 24px 0;">
      <strong>SSN:</strong> {{ $ssn ?? '248-98-9404' }}
    </p>

    <!-- ===== EARNINGS TABLE ===== -->
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 16px;">
      <thead>
        <tr>
          <th style="border: 1px solid #bbbbbb; padding: 9px 12px; text-align: left;
                      background: #f2f2f2; font-size: 13px; font-weight: 700; color: #111111; width: 34%;">
            Earnings
          </th>
          <th style="border: 1px solid #bbbbbb; padding: 9px 12px; text-align: left;
                      background: #f2f2f2; font-size: 13px; font-weight: 700; color: #111111; width: 33%;">
            Details
          </th>
          <th style="border: 1px solid #bbbbbb; padding: 9px 12px; text-align: left;
                      background: #f2f2f2; font-size: 13px; font-weight: 700; color: #111111; width: 33%;">
            Amount
          </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="border: 1px solid #bbbbbb; padding: 9px 12px; font-size: 13px; color: #333333;">
            Base Salary
          </td>
          <td style="border: 1px solid #bbbbbb; padding: 9px 12px; font-size: 13px; color: #333333;">
            {{ $baseSalaryDetails ?? '' }}
          </td>
          <td style="border: 1px solid #bbbbbb; padding: 9px 12px; font-size: 13px; color: #333333;">
            {{ $baseSalary ?? '' }}
          </td>
        </tr>
        <tr>
          <td style="border: 1px solid #bbbbbb; padding: 9px 12px; font-size: 13px; color: #333333;">
            Overtime Pay
          </td>
          <td style="border: 1px solid #bbbbbb; padding: 9px 12px; font-size: 13px; color: #333333;">
            {{ $overtimeDetails ?? '' }}
          </td>
          <td style="border: 1px solid #bbbbbb; padding: 9px 12px; font-size: 13px; color: #333333;">
            {{ $overtimePay ?? '' }}
          </td>
        </tr>
        <tr>
          <td style="border: 1px solid #bbbbbb; padding: 9px 12px; font-size: 13px; color: #111111; font-weight: 700;">
            Gross Salary
          </td>
          <td style="border: 1px solid #bbbbbb; padding: 9px 12px; font-size: 13px; color: #333333;">
            &nbsp;
          </td>
          <td style="border: 1px solid #bbbbbb; padding: 9px 12px; font-size: 13px; color: #333333;">
            {{ $grossSalary ?? '' }}
          </td>
        </tr>
      </tbody>
    </table>

    <!-- ===== DEDUCTIONS TABLE ===== -->
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 16px;">
      <thead>
        <tr>
          <th style="border: 1px solid #bbbbbb; padding: 9px 12px; text-align: left;
                      background: #f2f2f2; font-size: 13px; font-weight: 700; color: #111111; width: 34%;">
            Deductions
          </th>
          <th style="border: 1px solid #bbbbbb; padding: 9px 12px; text-align: left;
                      background: #f2f2f2; font-size: 13px; font-weight: 700; color: #111111; width: 33%;">
            Details
          </th>
          <th style="border: 1px solid #bbbbbb; padding: 9px 12px; text-align: left;
                      background: #f2f2f2; font-size: 13px; font-weight: 700; color: #111111; width: 33%;">
            Amount
          </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="border: 1px solid #bbbbbb; padding: 9px 12px; font-size: 13px; color: #333333;">
            Taxes
          </td>
          <td style="border: 1px solid #bbbbbb; padding: 9px 12px; font-size: 13px; color: #333333;">
            {{ $taxesDetails ?? '' }}
          </td>
          <td style="border: 1px solid #bbbbbb; padding: 9px 12px; font-size: 13px; color: #333333;">
            {{ $taxes ?? '' }}
          </td>
        </tr>
        <tr>
          <td style="border: 1px solid #bbbbbb; padding: 9px 12px; font-size: 13px; color: #333333;">
            Late Penalties
          </td>
          <td style="border: 1px solid #bbbbbb; padding: 9px 12px; font-size: 13px; color: #333333;">
            {{ $latePenaltiesDetails ?? '' }}
          </td>
          <td style="border: 1px solid #bbbbbb; padding: 9px 12px; font-size: 13px; color: #333333;">
            {{ $latePenalties ?? '' }}
          </td>
        </tr>
        <tr>
          <td style="border: 1px solid #bbbbbb; padding: 9px 12px; font-size: 13px; color: #333333;">
            Insurances
          </td>
          <td style="border: 1px solid #bbbbbb; padding: 9px 12px; font-size: 13px; color: #333333;">
            {{ $insurancesDetails ?? '' }}
          </td>
          <td style="border: 1px solid #bbbbbb; padding: 9px 12px; font-size: 13px; color: #333333;">
            {{ $insurances ?? '' }}
          </td>
        </tr>
        <tr>
          <td style="border: 1px solid #bbbbbb; padding: 9px 12px; font-size: 13px; color: #333333;">
            Absences
          </td>
          <td style="border: 1px solid #bbbbbb; padding: 9px 12px; font-size: 13px; color: #333333;">
            {{ $absencesDetails ?? '' }}
          </td>
          <td style="border: 1px solid #bbbbbb; padding: 9px 12px; font-size: 13px; color: #333333;">
            {{ $absences ?? '' }}
          </td>
        </tr>
        <tr>
          <td style="border: 1px solid #bbbbbb; padding: 9px 12px; font-size: 13px; color: #111111; font-weight: 700;">
            Total Deductions
          </td>
          <td style="border: 1px solid #bbbbbb; padding: 9px 12px; font-size: 13px; color: #333333;">
            &nbsp;
          </td>
          <td style="border: 1px solid #bbbbbb; padding: 9px 12px; font-size: 13px; color: #333333;">
            {{ $totalDeductions ?? '' }}
          </td>
        </tr>
      </tbody>
    </table>

    <!-- ===== NET PAY ===== -->
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 28px;">
      <tbody>
        <tr>
          <td style="border: 1px solid #bbbbbb; padding: 9px 12px; font-size: 13px;
                      color: #111111; font-weight: 700; width: 67%;">
            Net Pay
          </td>
          <td style="border: 1px solid #bbbbbb; padding: 9px 12px; font-size: 13px; color: #333333; width: 33%;">
            {{ $netPay ?? '' }}
          </td>
        </tr>
      </tbody>
    </table>

    <!-- ===== FOOTER ===== -->
    <p style="font-size: 12px; color: #666666; margin: 0;">
      For inquiries, please feel free to contact [Your Name] at [Your Email].
    </p>

  </div>

</body>
</html>
