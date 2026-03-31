<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Max Trekking</title>
</head>

<body style="margin:0; padding:0; background:#f4f6f8; font-family: Arial, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f6f8; padding:20px 0;">
        <tr>
            <td align="center">

                <!-- Main Container -->
                <table width="650" cellpadding="0" cellspacing="0"
                    style="background:#ffffff; border-radius:8px; overflow:hidden;">

                    <!-- Header with Logo -->
                    <tr>
                        <td style="background: linear-gradient(90deg, #5dade2, #3498db); padding:20px; text-align:center;">
                            <img src="{{ asset('themes-assets/img/logo.jpeg') }}" width="120"
                                style="display:block; margin:auto;">
                        </td>
                    </tr>

                    <!-- Title -->
                    <tr>
                        <td style="padding:20px; text-align:center;">
                            <h2 style="margin:0; color:#333;">New Contact Inquiry</h2>
                        </td>
                    </tr>

                    <!-- Inquiry Table -->
                    <tr>
                        <td style="padding:0 20px 20px 20px;">
                            <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">

                                <tr>
                                    <td style="padding:12px; background:#f1f3f5; font-weight:bold; width:35%;">Full Name</td>
                                    <td style="padding:12px;">{{ $full_name }}</td>
                                </tr>

                                <tr>
                                    <td style="padding:12px; background:#f1f3f5; font-weight:bold;">Email</td>
                                    <td style="padding:12px;">{{ $email }}</td>
                                </tr>

                                <tr>
                                    <td style="padding:12px; background:#f1f3f5; font-weight:bold;">Phone</td>
                                    <td style="padding:12px;">{{ $number }}</td>
                                </tr>

                                <tr>
                                    <td style="padding:12px; background:#f1f3f5; font-weight:bold;">Country</td>
                                    <td style="padding:12px;">{{ $country ?? '-' }}</td>
                                </tr>

                                <tr>
                                    <td style="padding:12px; background:#f1f3f5; font-weight:bold;">Message</td>
                                    <td style="padding:12px;">{{ $comments ?? '-' }}</td>
                                </tr>

                            </table>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>
