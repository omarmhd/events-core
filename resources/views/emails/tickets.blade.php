<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invitation Confirmed</title>
    <style>
        /* Reset & Basics */
        body { margin: 0; padding: 0; background-color: #F8FAFC; font-family: 'Segoe UI', Tahoma, Geneva, sans-serif; -webkit-font-smoothing: antialiased; }
        table { border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { border: 0; display: block; line-height: 100%; outline: none; text-decoration: none; }
        a { text-decoration: none; }
        @font-face {
            font-family: 'TOX-Geometric';
            src: url('/alfont_com_TOX-Geometric.otf') format('opentype');
            font-weight: normal;
            font-style: normal;
        }
        /* Typography & Colors - Updated to Brand Identity */
        .text-brand { color: #176B8E; }
        .bg-brand { background-color: #176B8E; }
        .bg-brand-light { background-color: #EDF6F9; }
        .text-dark { color: #1e293b; }
        .text-gray { color: #64748b; }

        /* Card Styles */
        .card-container {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(23, 107, 142, 0.08); /* ظل خفيف بلون الهوية */
            overflow: hidden;
            margin-bottom: 25px;
            border: 1px solid #e2e8f0;
        }

        .qr-frame {
            padding: 15px;
            background-color: #ffffff;
            border-radius: 8px;
            border: 2px dashed #176B8E; /* حدود متقطعة بلون الهوية */
            display: inline-block;
        }

        @media only screen and (max-width: 600px) {
            .mobile-center { text-align: center !important; }
            img { max-width: 100% !important; height: auto !important; }
        }
    </style>
</head>
<body style="background-color: #F8FAFC; margin: 0; padding: 40px 0;">

<center>
    <table role="presentation" width="100%" border="0" cellpadding="0" cellspacing="0" style="max-width: 600px;">

        <tr>
            <td align="center" style="padding-bottom: 30px;">

                <div style="margin-bottom: 30px; border-radius: 0 0 20px 20px; overflow: hidden;">
                    <img src="{{asset("top-banner.png")}}" alt="Event Banner" style="width: 100%; max-width: 600px; display: block;">
                </div>

                <div style="margin-bottom: 20px; padding: 0 15px;">
                    <h2 style="margin: 0; font-size: 24px; font-weight: 700; color: #1e293b; line-height: 1.4; font-family: 'Segoe UI', Tahoma, sans-serif;">
                        {{$event->title}}
                    </h2>
                </div>

                <div style="width: 60px; height: 4px; background-color: #176B8E; margin: 0 auto 30px auto; border-radius: 2px;"></div>

                <p class="text-gray" style="margin: 0; font-size: 15px; line-height: 1.6; max-width: 90%; color: #64748b;">
                    Thank you for accepting our invitation. Enclosed are your admission tickets.
                    <br>
                    <span style="color: #176B8E; font-size: 16px; font-weight: 600; font-family: Tahoma, sans-serif;">تشرفنا بقبولكم الدعوة. مرفق أدناه بطاقات الدخول الخاصة بكم.</span>
                </p>
            </td>
        </tr>

        <tr>
            <td>
                @foreach ($tickets as $ticket)

                    @if($ticket['label'] === 'Main')
                        <div class="card-container">
                            <div style="background-color: #176B8E; height: 8px; width: 100%;"></div>

                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center" style="padding: 35px 20px;">

                                        <span style="background-color: #EDF6F9; color: #176B8E; padding: 8px 18px; border-radius: 50px; font-size: 12px; font-weight: bold; letter-spacing: 1px; border: 1px solid #176B8E; text-transform: uppercase;">
                                         Main Guest
                                        </span>

                                        <h2 style="margin: 20px 0 5px 0; color: #1e293b; font-size: 24px; font-family: 'Segoe UI', Tahoma, sans-serif;">{{ $invitation->invitee_name }}</h2>
                                        @if(!empty($invitation->invitee_position))
                                            <p style="margin: 0 0 25px 0; color: #64748b; font-size: 14px;">{{ $invitation->invitee_position }}</p>
                                        @endif

                                        <table width="100%" cellpadding="0" cellspacing="0" style="margin: 0 0 25px 0; background-color: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0; max-width: 400px;">
                                            <tr>
                                                <td align="center" style="padding: 15px; border-right: 1px solid #e2e8f0; width: 50%;">
                                                    <div style="font-size: 20px; filter: hue-rotate(180deg);">📅</div>
                                                    <div style="font-size: 13px; color: #1e293b; font-weight: bold; margin-top: 5px;">{{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</div>
                                                    <div style="font-size: 12px; color: #64748b; margin-top: 2px;">{{ $event->from_time }} - {{ $event->to_time }}</div>
                                                </td>
                                                <td align="center" style="padding: 15px; width: 50%;">
                                                    <div style="font-size: 20px;">📍</div>
                                                    <div style="font-size: 13px; color: #1e293b; font-weight: bold; margin-top: 5px;">Location</div>
                                                    <div style="font-size: 12px; margin-top: 2px;">
                                                        <a href="https://maps.app.goo.gl/XSUZKrFb6HusgQpUA" style="color: #176B8E; text-decoration: none; font-weight: 600;">View Map &rarr;</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>

                                        <div class="qr-frame">
                                            <img src="{{ $message->embedData(base64_decode(explode(',', $ticket['qr'])[1]), $ticket['label'] . '.png') }}"
                                                 width="180" height="180" alt="Entrance QR Code" style="display: block;">
                                        </div>
                                        <p style="margin: 15px 0 0 0; font-size: 11px; color: #94a3b8; letter-spacing: 1px; font-weight: 600;">PLEASE SCAN AT ENTRANCE</p>

                                    </td>
                                </tr>
                            </table>
                        </div>

                    @else
                        <div class="card-container" style="border-top: 0; max-width: 480px; margin-left: auto; margin-right: auto;">
                            <div style="background-color: #6fa7be; height: 6px; width: 100%;"></div>

                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center" style="padding: 25px 20px;">

                                        <h3 style="margin: 0 0 15px 0; color: #64748b; font-size: 14px; letter-spacing: 1px; text-transform: uppercase;">
                                            <span style="color: #176B8E;">Guest Ticket {{ $loop->iteration }}</span> / مرافق
                                        </h3>

                                        <div class="qr-frame" style="border-color: #cbd5e1; border-style: solid; padding: 10px;">
                                            <img src="{{ $message->embedData(base64_decode(explode(',', $ticket['qr'])[1]), $ticket['label'] . '.png') }}"
                                                 width="140" height="140" alt="Guest QR Code" style="display: block;">
                                        </div>

                                        <p style="margin: 10px 0 0 0; font-size: 12px; color: #94a3b8;">Guest # {{ $loop->iteration }}</p>

                                    </td>
                                </tr>
                            </table>
                        </div>
                    @endif

                @endforeach
            </td>
        </tr>

        <tr>
            <td align="center" style="padding: 30px 15px 40px 15px; border-top: 1px solid #e2e8f0; margin-top: 20px;">

                <p style="margin: 0; font-size: 13px; color: #64748b; font-weight: 600;">
                    This invitation was sent via Maan Event Management Platform
                </p>
                <p style="margin: 5px 0 0 0; font-size: 13px; color: #64748b; font-weight: 600;" dir="rtl">
                    تم إرسال هذه الدعوة عبر منصة معاً لإدارة الفعاليات
                </p>

                <p style="margin: 10px 0 0 0; font-size: 11px; color: #94a3b8; line-height: 1.5;">
                    © {{ date('Y') }} Maan Platform. All rights reserved.<br>
                    <span dir="rtl">جميع الحقوق محفوظة لدى منصة
                        <span style="font-family:'TOX-Geometric' ">معا</span>
                        ً</span>
                </p>
            </td>
        </tr>

    </table>
</center>
</body>
</html>
