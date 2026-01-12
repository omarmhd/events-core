<style>
    .sidebar-brand { display: flex; align-items: center; gap: 12px; padding: 1rem 1.5rem; margin-bottom: 1.5rem; background: white; border-radius: 16px; box-shadow: var(--shadow-card); }
    .brand-icon { width: 35px; height: 35px; background: var(--grad-purple); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; }
    .nav-link-custom { display: flex; align-items: center; padding: 12px 16px; color: var(--text-muted); border-radius: 12px; font-weight: 500; text-decoration: none; transition: all 0.2s; margin-bottom: 5px; }
    .nav-link-custom:hover { background: #f1f5f9; color: var(--primary-color); }
    .nav-link-custom.active { background: #eff6ff; color: var(--primary-color); font-weight: 700; }
    .nav-link-custom i { width: 24px; }
    .info-card { background: var(--grad-blue); color: white; border-radius: 20px; padding: 1.5rem; position: relative; overflow: hidden; }
</style>

<div class="sidebar-wrapper">
    <div class="sidebar-brand">
{{--        <div class="brand-icon"><i class="fas fa-layer-group"></i></div>--}}
            <div class="fw-bold fs-5 text-dark">SAMI<span style="color: #6366f1;">Event</span></div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-2">
            <small class="text-muted fw-bold px-3 py-2 d-block" style="font-size: 0.7rem;">MENU</small>

            <a href="{{ route('dashboard.index') }}" class="nav-link-custom {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                <i class="fas fa-home"></i>Home
            </a>

            <a href="{{ route('invitations.index') }}" class="nav-link-custom {{ request()->routeIs('emps') ? 'active' : '' }}">
                <i class="fas fa-ticket-alt"></i>Invitations
            </a>
            <a href="#" class="nav-link-custom">
                <i class="fas fa-qrcode"></i>QR Scanner
            </a>

{{--            <a href="#" class="nav-link-custom">--}}
{{--                <i class="fas fa-chart-pie"></i> Overview/Analytics--}}
{{--            </a>--}}
        </div>
    </div>

    @yield("infoCard")

{{--    <div class="info-card shadow-sm d-none d-md-block">--}}
{{--        <div class="d-flex align-items-center gap-2 mb-2">--}}
{{--            <i class="fas fa-info-circle fa-lg"></i>--}}
{{--            <h6 class="fw-bold mb-0">Quick Tip</h6>--}}
{{--        </div>--}}
{{--        <p class="small mb-0 opacity-75">Double-check the email. The QR ticket is sent instantly.</p>--}}
{{--    </div>--}}
{{--    <div class="info-card shadow-sm d-none d-md-block">--}}
{{--        <div class="d-flex align-items-center gap-2 mb-2">--}}
{{--            <i class="fas fa-chart-pie"></i>--}}
{{--            <h6 class="fw-bold mb-0">Overview</h6>--}}
{{--        </div>--}}
{{--        <p class="small mb-0 opacity-75">        <div class="stat-row">--}}
{{--            <span class="stat-label">Total Guests</span>--}}
{{--            <span class="stat-value">{{ $totalGuests ?? '1,240' }}</span>--}}
{{--        </div>--}}
{{--        </p>--}}
{{--    </div>--}}
</div>
