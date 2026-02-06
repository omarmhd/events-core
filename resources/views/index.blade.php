<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$event->title}} - RSVP</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        :root {
            /* Brand Colors */
            --brand-primary: #176B8E;
            --brand-dark: #104E68;
            --brand-light: #EDF6F9;

            --text-dark: #1e293b;
            --text-muted: #64748b;
            --bg-body: #F8FAFC;
            --white: #ffffff;
            --shadow-card: 0 10px 40px -5px rgba(23, 107, 142, 0.08);
            --radius-lg: 24px;
        }

        body { font-family: 'Poppins', sans-serif; background-color: var(--bg-body); color: var(--text-dark); margin: 0; overflow-x: hidden; }

        /* Banner */
        .banner-wrapper {
            width: 100%;
            height: 380px;
            overflow: hidden;
            border-bottom-left-radius: 40px;
            border-bottom-right-radius: 40px;
            position: relative;
            background-color: #eee;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }

        .banner-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* Title */
        .page-title-container { text-align: center; padding: 30px 15px 10px 15px; }
        .event-title-ar {
            font-family: 'Cairo', sans-serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0;
            line-height: 1.4;
        }

        @media (max-width: 576px) {
            .banner-wrapper { height: 200px; border-bottom-left-radius: 25px; border-bottom-right-radius: 25px; }
            .event-title-ar { font-size: 1.5rem; }
        }

        /* Main Card */
        .main-card-container { margin-top: 0; padding-bottom: 20px; }
        .floating-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-card);
            padding: 40px;
            border-top: 5px solid var(--brand-primary);
        }

        /* Location Card Style (Secondary) */
        .location-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-card);
            padding: 30px;
            margin-top: 25px;
            border: 1px solid #e2e8f0;
        }

        /* Meta Data */
        .event-meta { display: flex; justify-content: center; gap: 15px; flex-wrap: wrap; margin-bottom: 30px; padding-bottom: 30px; border-bottom: 1px solid #f1f5f9; }
        .meta-item {
            display: flex; align-items: center; gap: 10px;
            background: var(--brand-light);
            color: var(--brand-primary);
            padding: 12px 25px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            border: 1px solid rgba(23, 107, 142, 0.1);
            text-align: center;
        }
        .meta-item i { color: var(--brand-primary); }

        /* Description */
        .description-card {
            background: #ffffff;
            border: 1px solid rgba(23, 107, 142, 0.2);
            border-radius: 16px;
            padding: 30px 25px;
            margin: 0 auto 40px auto;
            max-width: 95%;
            position: relative;
        }
        .description-card::before, .description-card::after { content: ''; position: absolute; width: 30px; height: 30px; border: 2px solid var(--brand-primary); transition: all 0.3s ease; }
        .description-card::before { top: -1px; left: -1px; border-right: none; border-bottom: none; border-radius: 16px 0 0 0; }
        .description-card::after { bottom: -1px; right: -1px; border-left: none; border-top: none; border-radius: 0 0 16px 0; }

        .desc-en { font-family: 'Poppins', sans-serif; font-size: 1rem; color: var(--text-muted); font-weight: 500; line-height: 1.6; margin-bottom: 15px; }
        .desc-divider { display: flex; align-items: center; justify-content: center; margin: 15px 0; opacity: 0.5; }
        .desc-divider span { height: 1px; width: 40px; background-color: var(--brand-primary); }
        .desc-divider i { color: var(--brand-primary); margin: 0 10px; font-size: 8px; }
        .desc-ar { font-family: 'Cairo', sans-serif; font-size: 1.1rem; color: var(--brand-primary); font-weight: 700; line-height: 1.7; margin-bottom: 0; }

        /* Status Tiles */
        .status-options { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px; margin-top: 25px; }
        @media (max-width: 576px) { .status-options { grid-template-columns: 1fr; } }

        .status-tile {
            background: white; border: 2px solid #e2e8f0; border-radius: 16px; padding: 25px 10px;
            cursor: pointer; transition: all 0.2s ease; text-align: center;
        }
        .status-tile:hover { border-color: var(--brand-primary); transform: translateY(-3px); }
        .status-tile.active-accept { border-color: var(--brand-primary); background-color: var(--brand-light); }
        .status-tile.active-accept i { color: var(--brand-primary) !important; }
        .status-tile.active-maybe { border-color: #f59e0b; background-color: #fffbeb; }
        .status-tile.active-maybe i { color: #f59e0b !important; }
        .status-tile.active-decline { border-color: #ef4444; background-color: #fef2f2; }
        .status-tile.active-decline i { color: #ef4444 !important; }

        /* Actions */
        .action-section { display: none; background: #fff; padding: 0; margin-top: 30px; animation: slideDown 0.4s ease; }
        .btn-main {
            background-color: var(--brand-primary);
            color: white; font-weight: 600; padding: 16px; width: 100%;
            border-radius: 12px; border: none; margin-top: 20px; font-size: 1.1rem;
            box-shadow: 0 4px 12px rgba(23, 107, 142, 0.3);
            transition: all 0.3s ease;
        }
        .btn-main:hover { background-color: var(--brand-dark); box-shadow: 0 6px 15px rgba(23, 107, 142, 0.4); }

        @keyframes slideDown { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }

        /* Footer */
        .footer-section {
            text-align: center; margin-top: 50px; margin-bottom: 30px; padding-top: 25px;
            border-top: 1px solid #e2e8f0; color: var(--text-muted); font-size: 0.9rem;
        }
        .footer-brand { color: var(--brand-primary); font-weight: 700; }
        .copyright-text { font-size: 0.8rem; opacity: 0.8; margin-top: 15px; display: block; }
    </style>
</head>
<body>

@php
    $hasResponded = $guest->status !== 'pending';
    $isAccepted = $guest->status === 'accepted';
    $isMaybe = $guest->status === 'maybe';
    $bannerImage = asset("top-banner.png");
@endphp

<div class="banner-wrapper">
    <img src="{{ $bannerImage }}" alt="Event Banner" class="banner-img">
</div>

<div class="page-title-container animate__animated animate__fadeIn">
    <h1 class="event-title-ar">{{$event->title}}</h1>
</div>

<div class="container main-card-container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">

            <div class="floating-card animate__animated animate__zoomIn mb-5"
                 id="successSection"
                 style="{{ $hasResponded ? 'display: block;' : 'display: none;' }}">
                <div class="text-center py-4">
                    <div class="mb-4">
                        <i id="successIcon"
                           class="@if($isAccepted) fas fa-envelope-circle-check
                                  @elseif($isMaybe) fas fa-question-circle
                                  @else far fa-times-circle @endif"
                           style="font-size: 4rem; color: @if($isAccepted) var(--brand-primary) @elseif($isMaybe) #f59e0b @else #ef4444 @endif;"></i>
                    </div>
                    <h2 class="fw-bold mb-3" id="successTitle" style="color: var(--brand-primary);">
                        {{ $isAccepted ? 'Attendance Confirmed' : ($isMaybe ? 'Response Recorded' : 'Declined') }}
                    </h2>
                    <p class="lead mb-4 text-muted" id="successMessage" style="font-size: 1rem;">
                        @if($hasResponded)
                            @if($isAccepted or $isMaybe)

                                <a href="{{ route('downloadPdf', ['token' => $token]) }}" target="_blank" style="color:#176B8E;font-weight:bold;">
                                    Click here to download your ticket file
                                </a><br><br>
                                Please check your email for the QR Code ticket.

                            @else
                                You have declined this invitation.
                            @endif
                        @else
                            Processing...
                        @endif

                    </p>
                </div>
            </div>

            <div class="floating-card animate__animated animate__fadeInUp"
                 id="mainFormCard"
                 style="{{ $hasResponded ? 'display: none;' : 'display: block;' }}">

                <div class="event-meta">
                    <div class="meta-item w-100 justify-content-center flex-column flex-md-row">
                        <i class="far fa-calendar-alt mb-1 mb-md-0"></i>
                        <span>
                            {{ \Carbon\Carbon::parse($event->date)->format('l, j F, Y') }}
                            <span class="mx-2 opacity-25">|</span>
                            {{ \Carbon\Carbon::parse($event->date)->locale('ar')->translatedFormat('l، j F Y') }}
                        </span>
                    </div>

                    <div class="d-flex gap-3 justify-content-center w-100 flex-wrap">
                        <div class="meta-item">
                            <i class="far fa-clock"></i>
                            {{ $event->from_time }} – {{ $event->to_time }}
                        </div>

                        <div class="meta-item">
                            <i class="fa fa-location-dot"></i>
                            <a href="https://maps.app.goo.gl/PbsAQxrAnYs9JjPaA?g_st=ic" style="color: inherit; text-decoration: none;">{{$event->address}} | View Map</a>
                        </div>
                    </div>
                </div>

                <div class="text-center mb-5">
                    <div class="description-card animate__animated animate__fadeIn">
                        <p class="desc-en" style="text-align: left">{{$event->description_en}}</p>
                        <div class="desc-divider"><span></span><i class="fas fa-circle"></i><span></span></div>
                        <p class="desc-ar" style="text-align: right">{{$event->description}}</p>
                    </div>
                </div>

                <form id="rsvpForm" method="POST" action="{{ route('rsvp.submit', $guest->invitation_token) }}">
                    @csrf
                    <input type="hidden" name="response_status" id="response_status">
                    <h5 class="fw-bold text-center mb-4 text-secondary">Will you be attending?</h5>
                    <div class="status-options">
                        <div class="status-tile" id="btnAccept" onclick="selectStatus('accepted')">
                            <i class="fas fa-check-circle" style="font-size: 2.2rem; margin-bottom: 15px; display: block; color: #cbd5e1;"></i>
                            <h6 class="fw-bold">Yes, I'll Attend</h6>
                            <h6 class="fw-bold">نعم، بالتأكيد سأحضر</h6>
                        </div>
                        <div class="status-tile" id="btnMaybe" onclick="selectStatus('maybe')">
                            <i class="fas fa-question-circle" style="font-size: 2.2rem; margin-bottom: 15px; display: block; color: #cbd5e1;"></i>
                            <h6 class="fw-bold">Maybe</h6>
                            <span>من المحتمل أن أحضر</span>

                        </div>
                        <div class="status-tile" id="btnDecline" onclick="selectStatus('declined')">
                            <i class="fas fa-times-circle" style="font-size: 2.2rem; margin-bottom: 15px; display: block; color: #cbd5e1;"></i>
                            <h6 class="fw-bold">Apologize</h6>
                            <span>أعتذر عن الحضور</span>
                        </div>
                    </div>

                    <div id="guestSection" class="action-section">
                        <div class="mt-4 p-4 bg-light rounded-4 border border-1">
                            <label class="fw-bold mb-2 d-block small text-muted text-uppercase">Number of Guests/عدد المرافقين</label>
                            <select name="guests_count" class="form-select mb-3 p-3 rounded-3 border-0 shadow-sm">
                                <option value="0">Just me (No guests)</option>
                                @for($i=1;$i<=$guest->allowed_guests;$i++)
                                    <option value="{{$i}}">+{{$i}} Guest{{$i>1?'s':''}}</option>
                                @endfor
                            </select>
                            <button type="submit" class="btn-main" id="submitBtn">
                                <span class="btn-text">Confirm Attendance</span>
                                <span class="spinner-border spinner-border-sm ms-2 d-none" role="status"></span>
                            </button>
                        </div>
                    </div>

                    <div id="maybeSection" class="action-section">
                        <div class="mt-4 p-4 rounded-4 border border-warning-subtle bg-warning-subtle bg-opacity-10">
                            <p class="text-dark fw-bold text-center mb-3">Please let us know once you are sure.</p>
                            <button type="submit" class="btn btn-warning w-100 py-3 fw-bold rounded-3 text-dark" id="maybeSubmitBtn">
                                <span class="btn-text">Submit Response</span>
                                <span class="spinner-border spinner-border-sm ms-2 d-none" role="status"></span>
                            </button>
                        </div>
                    </div>

                    <div id="declineSection" class="action-section">
                        <div class="mt-4 p-4 rounded-4 border border-danger-subtle bg-danger-subtle bg-opacity-10">
                            <p class="text-danger fw-bold text-center mb-3">Are you sure you want to decline?</p>
                            <button type="submit" class="btn btn-outline-danger w-100 py-3 fw-bold rounded-3" id="declineBtn">
                                <span class="btn-text">Yes, Decline Invitation</span>
                                <span class="spinner-border spinner-border-sm ms-2 d-none" role="status"></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="location-card animate__animated animate__fadeInUp"
                 id="locationBox"
                 style="{{ $hasResponded ? 'display: none;' : 'display: block;' }}">

                <div class="d-flex align-items-center mb-3">
                    <div style="background: var(--brand-light); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                        <i class="fa fa-location-dot" style="color: var(--brand-primary);"></i>
                    </div>
                    <h5 class="fw-bold m-0" style="color: var(--text-dark);">Event Location</h5>
                </div>

                <p class="text-muted small mb-3 ps-1">{{$event->address}}</p>

                <div style="height: 300px; background: #eee; border-radius: 16px; overflow: hidden; border: 1px solid #e2e8f0;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3623.716668396074!2d46.578129684999624!3d24.736605584112475!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMjTCsDQ0JzExLjgiTiA0NsKwMzQnMzMuNCJF!5e0!3m2!1sar!2seg!4v1770384651929!5m2!1sar!2seg" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>

            <div class="footer-section animate__animated animate__fadeIn">
                <p class="mb-1">With regards, <span class="footer-brand">Maan Event Management Platform</span></p>
                <p class="mb-3" dir="rtl">مع تحيات <span class="footer-brand">منصة معاً لإدارة الفعاليات</span></p>
                <span class="copyright-text">
                    &copy; {{ date('Y') }} Maan Platform. All rights reserved.<br>
                    <span dir="rtl">جميع الحقوق محفوظة لدى منصة معاً</span>
                </span>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const btnAccept = document.getElementById('btnAccept');
    const btnMaybe = document.getElementById('btnMaybe');
    const btnDecline = document.getElementById('btnDecline');
    const guestSection = document.getElementById('guestSection');
    const maybeSection = document.getElementById('maybeSection');
    const declineSection = document.getElementById('declineSection');
    const statusInput = document.getElementById('response_status');

    function selectStatus(status) {
        statusInput.value = status;
        [btnAccept, btnMaybe, btnDecline].forEach(btn => {
            btn.className = 'status-tile';
            btn.querySelector('i').style.color = '#cbd5e1';
        });

        guestSection.style.display = 'none';
        maybeSection.style.display = 'none';
        declineSection.style.display = 'none';

        if (status === 'accepted') {
            btnAccept.classList.add('active-accept');
            btnAccept.querySelector('i').style.color = '';
            guestSection.style.display = 'block';
        } else if (status === 'maybe') {
            btnMaybe.classList.add('active-maybe');
            btnMaybe.querySelector('i').style.color = '';
            maybeSection.style.display = 'block';
        } else {
            btnDecline.classList.add('active-decline');
            btnDecline.querySelector('i').style.color = '';
            declineSection.style.display = 'block';
        }
    }

    const form = document.getElementById('rsvpForm');
    if(form){
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const status = formData.get('response_status');

            let activeBtn;
            if(status === 'accepted') activeBtn = document.getElementById('submitBtn');
            else if(status === 'maybe') activeBtn = document.getElementById('maybeSubmitBtn');
            else activeBtn = document.getElementById('declineBtn');

            const btnText = activeBtn.querySelector('.btn-text');
            const spinner = activeBtn.querySelector('.spinner-border');

            activeBtn.disabled = true;
            btnText.style.opacity = '0.5';
            spinner.classList.remove('d-none');

            fetch("{{ route('rsvp.submit', $guest->invitation_token) }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        // Hide Form AND Location Box
                        document.getElementById('mainFormCard').style.display = 'none';
                        document.getElementById('locationBox').style.display = 'none';

                        const successSection = document.getElementById('successSection');
                        const successTitle = document.getElementById('successTitle');
                        const successMsg = document.getElementById('successMessage');
                        const successIcon = document.getElementById('successIcon');
                        successSection.style.display = 'block';

                        if (status === 'accepted') {
                            successTitle.style.color = '#176B8E';
                            successTitle.innerText = "Attendance Confirmed!";
                            successMsg.innerHTML =
                                `<strong>Download your entry tickets</strong><br>
         <a href="${data.url}" target="_blank" style="color:#176B8E;font-weight:bold;">
            Click here to download the ticket file
         </a><br><br>
         Check your email for a copy of the invitation.`;
                            successIcon.className = "fas fa-envelope-circle-check";
                            successIcon.style.color = "#176B8E";

                        } else if (status === 'maybe') {
                            successTitle.style.color = '#f59e0b';
                            successTitle.innerText = "Response Recorded";
                            successMsg.innerHTML =
                                `<strong>Download your entry tickets</strong><br>
         <a href="${data.url}" target="_blank" style="color:#176B8E;font-weight:bold;">
            Click here to download the ticket file
         </a><br><br>
         Check your email for a copy of the invitation.`;
                            successIcon.className = "fas fa-question-circle";
                            successIcon.style.color = "#f59e0b";


                        }
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    activeBtn.disabled = false;
                    btnText.style.opacity = '1';
                    spinner.classList.add('d-none');
                    form.submit();
                });
        });
    }
</script>
</body>
</html>
