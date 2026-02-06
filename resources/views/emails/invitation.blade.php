<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invitation Response</title>
    <style>
        /* Basics */
        body { margin: 0; padding: 0; background-color: #F8FAFC; font-family: 'Segoe UI', Tahoma, Geneva, sans-serif; -webkit-font-smoothing: antialiased; color: #333333; }
        table { border-collapse: collapse; }
        a { text-decoration: none; }

        /* Brand Colors */
        .bg-brand { background-color: #176B8E; }
        .text-brand { color: #176B8E; }

        /* Button Style */
        .btn-main {
            background-color: #176B8E; /* تم تحديث اللون */
            color: #ffffff !important;
            padding: 14px 35px;
            border-radius: 8px;
            font-weight: 600;
            display: inline-block;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(23, 107, 142, 0.25);
            transition: all 0.3s ease;
            text-align: center;
            text-decoration: none;
            border: 1px solid #176B8E;
        }

        .btn-main:hover {
            background-color: #125570;
            box-shadow: 0 6px 20px rgba(23, 107, 142, 0.35);
        }

        /* Card */
        .main-card {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.06);
            border-top: 6px solid #176B8E; /* تم تحديث اللون */
            overflow: hidden;
            max-width: 600px;
            margin: 0 auto;
        }

        .footer-link {
            color: #176B8E;
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>
<body style="margin: 0; padding: 40px 0; background-color: #F8FAFC;">

<center>

    <div class="main-card">
        <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td style="padding: 45px 30px; text-align: center;">

                    <div style="max-width: 600px; margin: 0 auto; text-align: center; padding: 10px;">
                        <div style="margin-bottom: 35px;">
                            <img src="{{asset('top-banner.png')}}" alt="Event Banner" style="width: 100%; max-width: 500px; border-radius: 4px;">
                        </div>

                        <div style="margin-bottom: 25px;">
                            <h2 style="margin: 0; font-size: 24px; font-weight: 700; color: #1e293b; line-height: 1.4;">
                                {{$event->title}}
                            </h2>
                        </div>

                        <div style="width: 60px; height: 4px; background-color: #176B8E; margin: 0 auto 30px auto; border-radius: 10px;"></div>

                        <div style="margin-bottom: 15px;">
                            <h3 style="margin: 0; font-size: 20px; font-weight: 600; color: #334155;">
                                Dear, {{$invitation->invitee_name}}
                            </h3>
                        </div>

                        <div style="margin-bottom: 15px;" dir="ltr">
                            <p style="margin: 0; font-size: 16px; line-height: 1.6; color: #64748b;">
                                {{$event->description_en}}
                            </p>
                        </div>

                        <div style="margin-bottom: 25px;" dir="rtl">
                            <p style="margin: 0; font-size: 16px; line-height: 1.7; color: #176B8E; font-weight: 500;">
                                {{$event->description}}
                            </p>
                        </div>

                    </div>

                    <div style="background-color: #f8fafc; padding: 20px; border-radius: 8px; margin-bottom: 30px;">
                        <p style="margin: 0 0 10px 0; font-size: 15px; line-height: 1.6; color: #475569;">
                            Please click the button below to <strong>accept</strong> or <strong>decline</strong>.
                        </p>
                        <p style="margin: 0; font-size: 15px; line-height: 1.6; color: #475569;" dir="rtl">
                            نرجو النقر على الزر أدناه لتأكيد الحضور أو الاعتذار.
                        </p>
                    </div>

                    <div style="margin-bottom: 35px;">
                        <a href="{{ $invitationLink }}" class="btn-main">
                            Respond to Invitation
                            <br><span style="font-weight: normal; font-size: 14px;">الرد على الدعوة</span>
                        </a>
                    </div>

                    <p style="margin: 0 0 40px 0; font-size: 12px; color: #94a3b8;">
                        If the button doesn't work, please use this link:<br>
                        <a href="{{ $invitationLink }}" style="color: #176B8E; text-decoration: underline; word-break: break-all;">
                            {{ $invitationLink }}
                        </a>
                    </p>

                    <div style="border-top: 1px solid #e2e8f0; padding-top: 25px; margin-top: 20px;">
                        <p style="margin: 0; font-size: 13px; color: #64748b; font-weight: 600;">
                            This invitation was sent via Maan Event Management Platform
                        </p>
                        <p style="margin: 5px 0 0 0; font-size: 13px; color: #64748b; font-weight: 600;" dir="rtl">
                            تم إرسال هذه الدعوة عبر منصة معاً لإدارة الفعاليات
                        </p>
                    </div>

                </td>
            </tr>
        </table>
    </div>

    <div style="margin-top: 25px; color: #94a3b8; font-size: 12px; line-height: 1.5;">
        &copy; {{ date('Y') }} Maan Platform. All rights reserved.<br>
        <span dir="rtl">جميع الحقوق محفوظة لدى منصة معاً</span>
    </div>

</center>
</body>
</html>
