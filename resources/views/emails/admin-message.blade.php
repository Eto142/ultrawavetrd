<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $subjectLine }}</title>
</head>
<body style="margin:0; padding:0; background-color:#F1F2F4; font-family:'Segoe UI', Helvetica, Arial, sans-serif;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#F1F2F4; padding:32px 16px;">
    <tr>
        <td align="center">
            <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="max-width:600px; width:100%; background-color:#FFFFFF; border-radius:12px; overflow:hidden; border:1px solid #E5E7EB;">

                <tr>
                    <td align="center" style="background-color:#0D0F14; padding:28px 24px;">
                        <img src="{{ asset('wp-content/uploads/2026/03/Asset-4651finvora-1024x127.png') }}" alt="Finvora Digital" style="height:32px; width:auto; display:block;">
                    </td>
                </tr>

                <tr>
                    <td style="padding:36px 32px 8px;">
                        <p style="margin:0 0 16px; font-size:15px; line-height:1.6; color:#1F2937;">Hi {{ $name }},</p>
                        <p style="margin:0; font-size:15px; line-height:1.7; color:#1F2937; white-space:pre-line;">{{ $body }}</p>
                    </td>
                </tr>

                <tr>
                    <td style="padding:20px 32px 32px;"></td>
                </tr>

                <tr>
                    <td style="padding:20px 32px; background-color:#F9FAFB; border-top:1px solid #E5E7EB;">
                        <p style="margin:0; font-size:12px; line-height:1.6; color:#9CA3AF; text-align:center;">
                            &copy; {{ date('Y') }} Finvora Digital. All rights reserved.
                        </p>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>
</body>
</html>
