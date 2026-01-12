<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invitation Response</title>
    <style>
        /* Basics */
        body { margin: 0; padding: 0; background-color: #FDFBF7; font-family: 'Segoe UI', Tahoma, Geneva, sans-serif; -webkit-font-smoothing: antialiased; color: #333333; }
        table { border-collapse: collapse; }
        a { text-decoration: none; }

        /* Colors */
        .text-gold { color: #C5A065; }
        .text-gray { color: #718096; }

        /* Button Style */
        .btn-gold {
            background-color: #C5A065;
            color: #ffffff !important;
            padding: 14px 30px;
            border-radius: 6px;
            font-weight: bold;
            display: inline-block;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 10px rgba(197, 160, 101, 0.3);
            transition: all 0.3s ease;
            text-align: center;
        }

        /* Card */
        .main-card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            border-top: 5px solid #C5A065;
            overflow: hidden;
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body style="margin: 0; padding: 40px 0; background-color: #FDFBF7;">

<div style="display:none;font-size:1px;color:#333333;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;">
    Action Required: Please accept or decline the invitation for {{ $event->name ?? 'our event' }}.
</div>

<center>

    <div class="main-card">
        <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td style="padding: 40px 30px; text-align: center;">

                    <h1 style="margin: 0 0 15px 0; font-size: 22px; color: #2D3748;">Hello, {{ $invitation->invitee_name }}</h1>

                    <p style="margin: 0 0 25px 0; font-size: 15px; line-height: 1.6; color: #718096;">
                        We are pleased to invite you to an exclusive experience. Your presence would honor us.
                        <br>
                        <span style="color: #C5A065; font-size: 14px;">يسرنا دعوتكم لحضور فعاليتنا المميزة. حضوركم تشريف لنا.</span>
                    </p>

                    <div style="background-color: #FAFAFA; border: 1px dashed #E2E8F0; border-radius: 8px; padding: 20px; margin-bottom: 25px;">
                        <p style="margin: 0 0 10px 0; font-size: 12px; color: #A0AEC0; text-transform: uppercase; letter-spacing: 1px;">Event Name</p>
                        <h3 style="margin: 0; font-size: 18px; color: #2D3748;">{{ $event->title_en ?? 'Upcoming Event' }}</h3>
                    </div>

                    <p style="margin: 0 0 20px 0; font-size: 14px; line-height: 1.6; color: #4A5568;">
                        Please click the button below to <strong>accept</strong> or <strong>decline</strong> the invitation.
                        <br>
                        <span style="color: #C5A065; font-size: 14px;">نرجو النقر على الزر أدناه للموافقة على الدعوة أو الاعتذار.</span>
                    </p>

                    <div style="margin-bottom: 30px;">
                        <a href="{{ $invitationLink }}" class="btn-gold">
                            Respond to Invitation
                            <br><span style="font-weight: normal; font-size: 13px;">الرد على الدعوة</span>
                        </a>
                    </div>

                    <p style="margin: 0; font-size: 12px; color: #CBD5E0;">
                        If the button doesn't work, please use this link:<br>
                        <a href="{{ $invitationLink }}" style="color: #A0AEC0; text-decoration: underline; word-break: break-all;">
                            {{ $invitationLink }}
                        </a>
                    </p>

                </td>
            </tr>
        </table>
    </div>

    <div style="margin-top: 25px; color: #A0AEC0; font-size: 12px;">
        &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
    </div>

</center>
</body>
</html>
