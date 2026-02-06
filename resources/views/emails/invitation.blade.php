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
        @font-face {
            font-family: 'TOX-Geometric';
            src: url('/alfont_com_TOX-Geometric.otf') format('opentype');
            font-weight: normal;
            font-style: normal;
        }
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
                            تم إرسال هذه الدعوة عبر منصة                         <span style="font-family:'TOX-Geometric' ">معا</span>
                            لإدارة الفعاليات
                        </p>
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="2000" zoomAndPan="magnify" viewBox="0 0 1500 1499.999933" height="2000" preserveAspectRatio="xMidYMid meet" version="1.0"><defs><g/><clipPath id="6cb851f317"><rect x="0" width="1352" y="0" height="1374"/></clipPath></defs><g transform="matrix(1, 0, 0, 1, 97, 126)"><g clip-path="url(#6cb851f317)"><g fill="#000000" fill-opacity="1"><g transform="translate(22.162371, 86.818014)"><g><path d="M 0 0 C 0 0 11.722656 0 35.171875 0 C 58.617188 0 93.648438 0 140.265625 0 C 140.265625 0 140.265625 -2.316406 140.265625 -6.953125 C 140.265625 -11.585938 140.265625 -18.675781 140.265625 -28.21875 C 140.265625 -28.21875 128.609375 -28.21875 105.296875 -28.21875 C 81.992188 -28.21875 46.894531 -28.21875 0 -28.21875 C 0 -28.21875 0 -25.898438 0 -21.265625 C 0 -16.640625 0 -9.550781 0 0 Z M 0 -56.015625 C 0 -56.015625 11.722656 -56.015625 35.171875 -56.015625 C 58.617188 -56.015625 93.648438 -56.015625 140.265625 -56.015625 C 140.265625 -56.015625 140.265625 -58.332031 140.265625 -62.96875 C 140.265625 -67.601562 140.265625 -74.691406 140.265625 -84.234375 C 140.265625 -84.234375 128.609375 -84.234375 105.296875 -84.234375 C 81.992188 -84.234375 46.894531 -84.234375 0 -84.234375 C 0 -84.234375 0 -81.914062 0 -77.28125 C 0 -72.65625 0 -65.566406 0 -56.015625 Z M 0 -56.015625 "/></g></g></g><g fill="#000000" fill-opacity="1"><g transform="translate(1.029317, 983.498645)"><g><path d="M 44.21875 0 C 44.21875 0 55.941406 0 79.390625 0 C 102.835938 0 137.867188 0 184.484375 0 C 184.484375 0 184.484375 -70.195312 184.484375 -210.59375 C 184.484375 -351 184.484375 -561.601562 184.484375 -842.40625 C 184.484375 -842.40625 172.828125 -842.40625 149.515625 -842.40625 C 126.210938 -842.40625 91.113281 -842.40625 44.21875 -842.40625 C 44.21875 -842.40625 44.21875 -772.203125 44.21875 -631.796875 C 44.21875 -491.398438 44.21875 -280.800781 44.21875 0 Z M 44.21875 0 "/></g></g></g><g fill="#000000" fill-opacity="1"><g transform="translate(185.092539, 983.498645)"><g><path d="M -0.421875 0 C -0.421875 0 46.328125 0 139.828125 0 C 233.335938 0 373.742188 0 561.046875 0 C 561.046875 0 561.046875 -11.722656 561.046875 -35.171875 C 561.046875 -58.617188 561.046875 -93.648438 561.046875 -140.265625 C 561.046875 -140.265625 549.390625 -140.265625 526.078125 -140.265625 C 502.773438 -140.265625 467.675781 -140.265625 420.78125 -140.265625 C 420.78125 -166.097656 427.097656 -189.546875 439.734375 -210.609375 C 452.367188 -232.222656 469.5 -249.347656 491.125 -261.984375 C 512.1875 -274.617188 535.492188 -280.9375 561.046875 -280.9375 C 561.046875 -280.9375 561.046875 -292.660156 561.046875 -316.109375 C 561.046875 -339.554688 561.046875 -374.585938 561.046875 -421.203125 C 519.765625 -421.203125 481.015625 -412.78125 444.796875 -395.9375 C 408.285156 -379.082031 376.832031 -355.773438 350.4375 -326.015625 C 324.320312 -355.773438 293.015625 -379.082031 256.515625 -395.9375 C 220.003906 -412.78125 181.113281 -421.203125 139.84375 -421.203125 C 139.84375 -421.203125 139.84375 -409.546875 139.84375 -386.234375 C 139.84375 -362.929688 139.84375 -327.832031 139.84375 -280.9375 C 165.394531 -280.9375 188.703125 -274.617188 209.765625 -261.984375 C 231.378906 -249.347656 248.503906 -232.222656 261.140625 -210.609375 C 274.054688 -189.828125 280.515625 -166.378906 280.515625 -140.265625 C 280.515625 -140.265625 257.140625 -140.265625 210.390625 -140.265625 C 163.640625 -140.265625 93.367188 -140.265625 -0.421875 -140.265625 C -0.421875 -140.265625 -0.421875 -128.609375 -0.421875 -105.296875 C -0.421875 -81.992188 -0.421875 -46.894531 -0.421875 0 Z M -0.421875 0 "/></g></g></g><g fill="#000000" fill-opacity="1"><g transform="translate(745.70607, 983.498645)"><g><path d="M 280.515625 -140.265625 C 280.515625 -140.265625 280.515625 -151.988281 280.515625 -175.4375 C 280.515625 -198.882812 280.515625 -234.050781 280.515625 -280.9375 C 280.515625 -280.9375 292.238281 -280.9375 315.6875 -280.9375 C 339.132812 -280.9375 374.164062 -280.9375 420.78125 -280.9375 C 420.78125 -255.101562 414.460938 -231.660156 401.828125 -210.609375 C 389.191406 -188.984375 372.0625 -171.851562 350.4375 -159.21875 C 329.375 -146.582031 306.066406 -140.265625 280.515625 -140.265625 Z M -0.421875 0 C -0.421875 0 22.953125 0 69.703125 0 C 116.460938 0 186.734375 0 280.515625 0 C 331.347656 0 378.242188 -12.632812 421.203125 -37.90625 C 464.441406 -63.175781 498.421875 -97.296875 523.140625 -140.265625 C 548.410156 -183.222656 561.046875 -230.113281 561.046875 -280.9375 C 561.046875 -280.9375 561.046875 -292.660156 561.046875 -316.109375 C 561.046875 -339.554688 561.046875 -374.585938 561.046875 -421.203125 C 561.046875 -421.203125 525.941406 -421.203125 455.734375 -421.203125 C 385.535156 -421.203125 280.238281 -421.203125 139.84375 -421.203125 C 139.84375 -421.203125 139.84375 -397.820312 139.84375 -351.0625 C 139.84375 -304.3125 139.84375 -234.046875 139.84375 -140.265625 C 139.84375 -140.265625 128.1875 -140.265625 104.875 -140.265625 C 81.570312 -140.265625 46.472656 -140.265625 -0.421875 -140.265625 C -0.421875 -140.265625 -0.421875 -128.609375 -0.421875 -105.296875 C -0.421875 -81.992188 -0.421875 -46.894531 -0.421875 0 Z M -0.421875 0 "/></g></g></g></g></g></svg>
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
