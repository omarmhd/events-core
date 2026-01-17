@extends('layouts.abstract')

@section('title', 'SAMI Event Dashboard')

@section('content')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        :root {
            --primary-bg: #F8FAFC;
            --card-bg: rgba(255, 255, 255, 0.8);
            --text-main: #0F172A;
            --text-muted: #64748B;

            /* Gradients */
            --grad-purple: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            --grad-blue: linear-gradient(135deg, #3b82f6 0%, #06b6d4 100%);
            --grad-green: linear-gradient(135deg, #10b981 0%, #34d399 100%);
            --grad-orange: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);
            --grad-dark: linear-gradient(135deg, #1e293b 0%, #334155 100%);

            --shadow-card: 0 10px 30px -10px rgba(0, 0, 0, 0.05);
            --shadow-hover: 0 20px 40px -10px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--primary-bg);
            color: var(--text-main);
            overflow-x: hidden;
        }

        /* Ambient Background */
        .ambient-bg {
            position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; z-index: -1;
            background: var(--primary-bg); overflow: hidden;
        }
        .ambient-orb {
            position: absolute; border-radius: 50%; filter: blur(80px); opacity: 0.4;
            animation: floatOrb 10s infinite ease-in-out alternate;
        }
        .orb-1 { top: -10%; left: -10%; width: 500px; height: 500px; background: #6366f1; }
        .orb-2 { bottom: -10%; right: -10%; width: 600px; height: 600px; background: #3b82f6; animation-delay: -5s; }
        @keyframes floatOrb { 0% { transform: translate(0, 0); } 100% { transform: translate(30px, 50px); } }

        /* --- LOGO SECTION --- */
        .brand-section {
            display: inline-flex; align-items: center; gap: 12px; margin-bottom: 1.5rem;
            padding: 10px 25px; background: white; border-radius: 50px; box-shadow: var(--shadow-card);
        }
        .brand-icon {
            width: 40px; height: 40px; background: var(--grad-purple); border-radius: 12px;
            display: flex; align-items: center; justify-content: center; color: white; font-size: 1.2rem;
        }
        .brand-text { font-size: 1.5rem; font-weight: 800; color: var(--text-main); letter-spacing: -0.5px; }
        .brand-text span { color: #6366f1; }

        .dashboard-header { padding: 2rem 0 3rem 0; }
        .welcome-text { font-size: 1.1rem; color: var(--text-muted); font-weight: 500; }

        /* --- Main Cards --- */
        .dashboard-card {
            background: var(--card-bg);
            backdrop-filter: blur(12px);
            border-radius: 24px;
            padding: 2.5rem 1.5rem; /* مساحة أكبر للأيقونة */
            height: 100%;
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: var(--shadow-card);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            text-decoration: none;
        }

        .dashboard-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-hover);
            border-color: rgba(99, 102, 241, 0.3);
        }
        .disabled-card {
            pointer-events: none;
            opacity: 0.5;
            filter: grayscale(100%);
            cursor: not-allowed;
        }
        /* Icon Container (Big Center) */
        .icon-container {
            width: 80px; height: 80px; border-radius: 24px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 1.5rem; color: white; font-size: 2rem;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.4s ease;
        }
        .dashboard-card:hover .icon-container { transform: scale(1.1) rotate(5deg); }

        .card-label { font-size: 1.25rem; font-weight: 700; color: var(--text-main); margin-bottom: 0.5rem; }
        .card-desc { font-size: 0.9rem; color: var(--text-muted); line-height: 1.5; }

        /* --- Small Stat Badge --- */
        .stat-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid #f1f5f9;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--text-muted);
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            display: flex; align-items: center; gap: 5px;
            transition: 0.3s;
        }
        .dashboard-card:hover .stat-badge { background: white; color: var(--text-main); transform: scale(1.05); }

        /* Feature Card */
        .feature-card {
            background: white; border-radius: 24px; padding: 2rem;
            border: 1px solid rgba(255,255,255,0.8);
            box-shadow: var(--shadow-card);
            transition: all 0.3s ease;
        }
        .feature-card:hover { transform: scale(1.01); box-shadow: var(--shadow-hover); }

        /* Gradients Helper */
        .bg-grad-purple { background: var(--grad-purple); }
        .bg-grad-blue { background: var(--grad-blue); }
        .bg-grad-green { background: var(--grad-green); }
        .bg-grad-orange { background: var(--grad-orange); }
        .bg-grad-dark { background: var(--grad-dark); }

        .btn-logout {
            padding: 0.6rem 2rem; border-radius: 50px; font-weight: 600; font-size: 0.9rem;
            color: #ef4444; background: white; border: 1px solid #fee2e2;
            transition: 0.3s; display: inline-flex; align-items: center; gap: 8px;
        }
        .btn-logout:hover { background: #fee2e2; color: #dc2626; }
    </style>

    <div class="ambient-bg">
        <div class="ambient-orb orb-1"></div>
        <div class="ambient-orb orb-2"></div>
    </div>

    <div class="container pb-5">

        <header class="dashboard-header text-center animate__animated animate__fadeInDown">
            <div class="brand-section">
                <div class="brand-text">SAMI<span>Event</span></div>
            </div>
            <h2 class="fw-bold mb-2">Welcome Back, Admin</h2>
            <p class="welcome-text">Select a module to manage your event.</p>
        </header>

        <div class="row g-4 mb-5">

            <div class="col-12 col-md-6 col-lg-3 animate__animated animate__fadeInUp delay-1">
                <a href="{{ route('invitations.index') }}" class="dashboard-card">
{{--                    <div class="stat-badge" title="Manual Check-ins">--}}
{{--                        <i class="fas fa-pen-fancy text-xs opacity-50"></i> {{ $manual_checkins ?? 'N/A' }}--}}
{{--                    </div>--}}

                    <div class="icon-container bg-grad-purple">
                        <i class="fas fa-envelope-open-text"></i>
                    </div>
                    <h3 class="card-label">Invitation Management</h3>
                    <p class="card-desc">Send and resend invitations, view invitees, and track the status</p>
                </a>
            </div>

            <div class="col-12 col-md-6 col-lg-3 animate__animated animate__fadeInUp delay-2">
                <a href="{{ route('qr') }}" class="dashboard-card">
{{--                    <div class="stat-badge" title="Total Scans Today">--}}
{{--                        <i class="fas fa-qrcode text-xs opacity-50"></i> {{ $scans_today ?? '1.2k' }}--}}
{{--                    </div>--}}

                    <div class="icon-container bg-grad-blue">
                        <i class="fas fa-qrcode"></i>
                    </div>
                    <h3 class="card-label">QR Scanner</h3>
                    <p class="card-desc">Instant digital ticket validation</p>
                </a>
            </div>

            <div class="col-12 col-md-6 col-lg-3 animate__animated animate__fadeInUp delay-3">
                <a href="{{ route('attendance_list') }}" class="dashboard-card">
{{--                    <div class="stat-badge text-success" title="Checked In">--}}
{{--                        <span class="spinner-grow spinner-grow-sm me-1" style="width: 8px; height: 8px;" role="status"></span>--}}
{{--                        {{ $checked_in_count ?? '842' }}--}}
{{--                    </div>--}}

                    <div class="icon-container bg-grad-green">
                        <i class="fas fa-ticket"></i>
                    </div>
                    <h3 class="card-label">Tickets</h3>
                    <p class="card-desc">View tickets and record attendance for invitees, whether main invitations or accompanying guests.</p>
                </a>
            </div>

            <div class="col-12 col-md-6 col-lg-3 animate__animated animate__fadeInUp delay-4">
                <a href="{{ route('statistics') }}" class="dashboard-card">
{{--                    <div class="stat-badge" title="Completion Rate">--}}
{{--                        <i class="fas fa-chart-line text-xs opacity-50"></i> 92%--}}
{{--                    </div>--}}

                    <div class="icon-container bg-grad-orange">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <h3 class="card-label">Analytics</h3>
                    <p class="card-desc">Data insights</p>
                </a>
            </div>
        </div>

{{--        <div class="row mb-5 animate__animated animate__fadeInUp animate__delay-1s">--}}
{{--            <div class="col-12">--}}
{{--                <a href="{{ route('emps') }}" class="text-decoration-none text-dark">--}}
{{--                    <div class="feature-card d-flex align-items-center justify-content-between flex-wrap gap-4">--}}
{{--                        <div class="d-flex align-items-center gap-4">--}}
{{--                            <div class="icon-container bg-grad-dark mb-0" style="width: 60px; height: 60px; font-size: 1.5rem;">--}}
{{--                                <i class="fas fa-users-gear"></i>--}}
{{--                            </div>--}}
{{--                            <div>--}}
{{--                                <h4 class="fw-bold mb-1">Staff Management Hub</h4>--}}
{{--                                <p class="mb-0 text-muted">Manage {{ $total_staff ?? 'all' }} employees and invitations.</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">--}}
{{--                            <i class="fas fa-arrow-right"></i>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="text-center animate__animated animate__fadeIn animate__delay-2s">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout shadow-sm">
                    <i class="fas fa-power-off"></i> Sign Out
                </button>
            </form>
        </div>
    </div>
@endsection
