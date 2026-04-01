<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
</head>

<body style="margin:0; padding:0; background:#eef2f5; font-family: 'Segoe UI', Arial, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#eef2f5; padding:40px 0;">
<tr>
<td align="center">

    <table width="620" cellpadding="0" cellspacing="0" style="max-width:620px; width:100%;">

        <!-- Merged header: logo left, confirmed text right -->
        <tr>
            <td style="background: linear-gradient(90deg, #0d2233 0%, #0d2233 42%, #1a6690 42%, #1f80b0 100%); padding:22px 36px; border-radius:6px 6px 0 0;">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="width:50%; vertical-align:middle;">
                            <img src="{{ asset('themes-assets/img/logo.jpeg') }}" height="44" style="display:block;">
                        </td>
                        <td style="width:50%; vertical-align:middle; text-align:right; padding-left:20px;">
                            <p style="margin:0; font-size:18px; font-weight:700; color:#ffffff; letter-spacing:-0.2px;">Booking Confirmed</p>
                            <p style="margin:4px 0 0; font-size:12px; color:rgba(255,255,255,0.75);">Your request has been received successfully</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- White card body -->
        <tr>
            <td style="background:#ffffff; padding:32px 36px 0 36px;">
                <p style="margin:0 0 6px; font-size:15px; color:#444; line-height:1.6;">
                    Dear <strong style="color:#0d2233;">{{ $name }}</strong>,
                </p>
                <p style="margin:0 0 28px; font-size:15px; color:#555; line-height:1.7;">
                    Thank you for choosing <strong>{{ $site_name ?? 'Max Trekking' }}</strong> for your Himalayan adventure.
                    Your booking request has been received and our team will contact you within <strong style="color:#1a6690;">24 hours</strong> to confirm all details.
                </p>
            </td>
        </tr>

        <!-- Section label -->
        <tr>
            <td style="background:#ffffff; padding:0 36px 12px 36px;">
                <p style="margin:0; font-size:11px; font-weight:700; letter-spacing:1.6px; text-transform:uppercase; color:#7a9baf;">Booking Details</p>
                <div style="height:1px; background:#dde6ec; margin-top:10px;"></div>
            </td>
        </tr>

        <!-- Details table -->
        <tr>
            <td style="background:#ffffff; padding:0 36px 28px 36px;">
                <table width="100%" cellpadding="0" cellspacing="0">

                    <tr>
                        <td style="padding:11px 14px; background:#f0f6fa; font-size:13px; font-weight:600; color:#1a5276; width:38%; border-bottom:1px solid #e2ecf2;">Trip</td>
                        <td style="padding:11px 14px; font-size:14px; color:#2c2c2c; border-bottom:1px solid #e2ecf2;">{{ $trip_title ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding:11px 14px; background:#f0f6fa; font-size:13px; font-weight:600; color:#1a5276; border-bottom:1px solid #e2ecf2;">Full Name</td>
                        <td style="padding:11px 14px; font-size:14px; color:#2c2c2c; border-bottom:1px solid #e2ecf2;">{{ $name }}</td>
                    </tr>
                    <tr>
                        <td style="padding:11px 14px; background:#f0f6fa; font-size:13px; font-weight:600; color:#1a5276; border-bottom:1px solid #e2ecf2;">Email</td>
                        <td style="padding:11px 14px; font-size:14px; color:#2c2c2c; border-bottom:1px solid #e2ecf2;">{{ $email }}</td>
                    </tr>
                    <tr>
                        <td style="padding:11px 14px; background:#f0f6fa; font-size:13px; font-weight:600; color:#1a5276; border-bottom:1px solid #e2ecf2;">Phone</td>
                        <td style="padding:11px 14px; font-size:14px; color:#2c2c2c; border-bottom:1px solid #e2ecf2;">{{ $contact }}</td>
                    </tr>
                    <tr>
                        <td style="padding:11px 14px; background:#f0f6fa; font-size:13px; font-weight:600; color:#1a5276; border-bottom:1px solid #e2ecf2;">Country</td>
                        <td style="padding:11px 14px; font-size:14px; color:#2c2c2c; border-bottom:1px solid #e2ecf2;">{{ $country ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding:11px 14px; background:#f0f6fa; font-size:13px; font-weight:600; color:#1a5276; border-bottom:1px solid #e2ecf2;">Start Date</td>
                        <td style="padding:11px 14px; font-size:14px; color:#2c2c2c; border-bottom:1px solid #e2ecf2;">{{ $start_date ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding:11px 14px; background:#f0f6fa; font-size:13px; font-weight:600; color:#1a5276; border-bottom:1px solid #e2ecf2;">End Date</td>
                        <td style="padding:11px 14px; font-size:14px; color:#2c2c2c; border-bottom:1px solid #e2ecf2;">{{ $end_date ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding:11px 14px; background:#f0f6fa; font-size:13px; font-weight:600; color:#1a5276; border-bottom:1px solid #e2ecf2;">No. of People</td>
                        <td style="padding:11px 14px; font-size:14px; color:#2c2c2c; border-bottom:1px solid #e2ecf2;">{{ $num_ppl ?? '-' }}</td>
                    </tr>
                    @if(!empty($message_text))
                    <tr>
                        <td style="padding:11px 14px; background:#f0f6fa; font-size:13px; font-weight:600; color:#1a5276; vertical-align:top;">Message</td>
                        <td style="padding:11px 14px; font-size:14px; color:#555; line-height:1.6;">{{ $message_text }}</td>
                    </tr>
                    @endif

                </table>
            </td>
        </tr>

        <!-- CTA button -->
        <tr>
            <td style="background:#ffffff; padding:4px 36px 32px 36px; text-align:center;">
                <a href="{{ url('/') }}"
                   style="display:inline-block; background:#1a6690; color:#ffffff; text-decoration:none; font-size:14px; font-weight:600; padding:13px 34px; border-radius:3px; letter-spacing:0.3px;">
                    Visit Our Website →
                </a>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="background:#0d2233; padding:20px 36px; border-radius:0 0 6px 6px;">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="font-size:13px; color:rgba(255,255,255,0.6); line-height:1.6;">
                            We look forward to seeing you in Nepal 🇳🇵<br>
                            <strong style="color:rgba(255,255,255,0.85);">{{ $site_name ?? 'Max Trekking' }}</strong>
                        </td>
                        <td style="text-align:right; font-size:12px; color:rgba(255,255,255,0.4); vertical-align:bottom;">
                            © {{ date('Y') }} All rights reserved.
                        </td>
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
