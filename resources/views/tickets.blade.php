<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Event Tickets</title>
    <style>
        /* --- Fonts & General Reset --- */
        body {
            /* Using standard clean fonts for English */
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #F8FAFC;
            margin: 0;
            padding: 0;
            color: #1e293b;
            line-height: 1.5;
        }

        @page { margin: 0px; padding: 0px; }

        .container {
            padding: 40px;
            max-width: 700px;
            margin: 0 auto;
        }

        /* --- Brand Colors --- */
        .text-brand { color: #176B8E; }
        .bg-brand { background-color: #176B8E; color: white; }
        .bg-gray { background-color: #f1f5f9; color: #64748b; }

        /* --- Banner Image Fix --- */
        .header-banner {
            width: 100%;
            /* Removed fixed height to prevent stretching */
            background-color: #e2e8f0; /* Placeholder color */
            margin-bottom: 30px;
            line-height: 0; /* Removes tiny space below image */
        }
        .header-banner img {
            width: 100%;
            height: auto; /* Ensures the image scales proportionally */
            display: block;
        }

        /* --- Headings --- */
        .page-heading {
            text-align: center;
            margin-bottom: 40px;
        }
        .page-heading h2 { margin: 0; font-size: 26px; color: #176B8E; font-weight: 700; }
        .page-heading h3 { margin: 8px 0 0; font-size: 16px; color: #64748b; font-weight: normal; }

        /* --- Ticket Card Style --- */
        .ticket-card {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            margin-bottom: 35px;
            overflow: hidden;
            page-break-inside: avoid;
            position: relative;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .ticket-header {
            padding: 15px 20px;
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .ticket-body {
            padding: 30px;
            text-align: center;
        }

        /* --- Attendee Details --- */
        .attendee-name {
            font-size: 24px;
            font-weight: bold;
            margin: 10px 0 5px;
            color: #1e293b;
        }
        .attendee-position {
            font-size: 15px;
            color: #64748b;
            margin-bottom: 25px;
        }

        /* --- Info Table --- */
        .info-table {
            width: 100%;
            margin-bottom: 25px;
            border-collapse: separate;
            border-spacing: 12px;
        }
        .info-cell {
            background-color: #F8FAFC;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            width: 50%;
            vertical-align: top;
        }
        .info-label { font-size: 11px; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; }
        .info-value { font-size: 13px; font-weight: bold; color: #334155; margin-top: 6px; line-height: 1.4; }

        /* --- Ticket Divider Effect --- */
        .ticket-divider {
            border-top: 2px dashed #cbd5e1;
            margin: 0 20px;
            position: relative;
        }
        .ticket-divider:before, .ticket-divider:after {
            content: "";
            position: absolute;
            top: -10px;
            width: 20px;
            height: 20px;
            background-color: #F8FAFC;
            border-radius: 50%;
        }
        .ticket-divider:before { left: -30px; }
        .ticket-divider:after { right: -30px; }

        /* --- QR Section --- */
        .qr-section {
            padding: 25px;
            text-align: center;
            background-color: #fff;
        }
        .qr-border {
            display: inline-block;
            padding: 12px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #fff;
        }
        .qr-img { width: 150px; height: 150px; display: block; }
        .scan-text { font-size: 11px; color: #94a3b8; margin-top: 12px; letter-spacing: 1px; font-weight: 600; text-transform: uppercase; }

        /* --- Footer --- */
        .footer {
            text-align: center;
            margin-top: 50px;
            padding-top: 25px;
            border-top: 1px solid #e2e8f0;
            color: #64748b;
            font-size: 11px;
        }
        .footer-brand { color: #176B8E; font-weight: bold; }

    </style>
</head>
<body>

<div class="header-banner">
    <img src="{{ public_path('top-banner.png') }}" alt="Event Banner">
</div>

<div class="container">

    <div class="page-heading">
        <h2>Invitation Confirmed</h2>
        <h3>Your entry tickets are included below</h3>
    </div>

    @foreach ($tickets as $ticket)
        <div class="ticket-card">

            @if($ticket['label'] === 'Main')
                <div class="ticket-header bg-brand">
                    Main Guest Ticket
                </div>
            @else
                <div class="ticket-header bg-gray">
                    Guest Ticket #{{ $loop->iteration }}
                </div>
            @endif

            <div class="ticket-body">
                @if($ticket['label'] === 'Main')
                    <div class="attendee-name">{{ $invitation->invitee_name }}</div>
                    @if(!empty($invitation->invitee_position))
                        <div class="attendee-position">{{ $invitation->invitee_position }}</div>
                    @endif

                    <table class="info-table">
                        <tr>
                            <td class="info-cell">
                                <div class="info-label">Date & Time</div>
                                <div class="info-value">
                                    {{ $event->date }} <br>
                                    <span style="font-weight: normal; font-size: 12px; color: #64748b;">{{ $event->from_time }}</span>
                                </div>
                            </td>
                            <td class="info-cell">
                                <div class="info-label">Location</div>
                                <div class="info-value"><a href="{{$invitation->map_link}}">view map</a></div>
                            </td>
                        </tr>
                    </table>
                @else
                    <div style="padding: 25px 0;">
                        <div style="font-size: 20px; color: #334155; font-weight: 600;">Companion Entry</div>
                        <div style="font-size: 14px; color: #94a3b8; margin-top: 5px;">Admit One</div>
                    </div>
                @endif
            </div>

            <div class="ticket-divider"></div>

            <div class="qr-section">
                <div class="qr-border">
                    <img src="{{ $ticket['qr'] }}" class="qr-img" alt="QR Code">
                </div>
                <div class="scan-text">Please scan at entrance</div>
            </div>
        </div>
    @endforeach

    <div class="footer">
        <p style="margin-bottom: 10px;">With regards, <span class="footer-brand">Maan Event Management Platform</span></p>

        <p>
            &copy; {{ date('Y') }} Maan Platform. All rights reserved.
        </p>
    </div>

</div>

</body>
</html>
