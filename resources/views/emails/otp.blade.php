<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Your verification code</title>
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
                        <p style="margin:0 0 24px; font-size:15px; line-height:1.6; color:#1F2937;">
                            Use the verification code below to confirm your email address and activate your Finvora Digital account.
                        </p>
                    </td>
                </tr>

                <tr>
                    <td align="center" style="padding:0 32px 24px;">
                        <table role="presentation" cellpadding="0" cellspacing="0" style="background-color:#FBF4DF; border:1px solid #EFB90B; border-radius:10px;">
                            <tr>
                                <td style="padding:18px 40px; font-size:32px; font-weight:700; letter-spacing:10px; color:#8A6A05; font-family:'Courier New', monospace;">
                                    {{ $code }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td style="padding:0 32px 32px;">
                        <p style="margin:0 0 12px; font-size:14px; line-height:1.6; color:#6B7280;">
                            This code will expire in <strong>10 minutes</strong>.
                        </p>
                        <p style="margin:0; font-size:14px; line-height:1.6; color:#6B7280;">
                            If you did not create an account with Finvora Digital, you can safely ignore this email.
                        </p>
                    </td>
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
