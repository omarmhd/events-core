@extends('layouts.app')

@section('title', 'Event Analytics')

@push('styles')
    <style>
        /* Custom Stats Styling */
        .stat-card {
            background: white; border-radius: 20px; border: 1px solid #f1f5f9;
            padding: 24px; position: relative; overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }
        .stat-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }

        .stat-icon-bg { position: absolute; top: -10px; right: -10px; width: 100px; height: 100px; border-radius: 50%; opacity: 0.1; }
        .stat-value { font-size: 2rem; font-weight: 800; color: #1e293b; line-height: 1.2; }
        .stat-label { font-size: 0.85rem; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; }

        .progress-slim { height: 8px; border-radius: 10px; background-color: #f1f5f9; margin-top: 10px; }
        .progress-bar { border-radius: 10px; }

        /* Comparison Pill */
        .comp-pill {
            background: #f8fafc; border-radius: 12px; padding: 16px; /* Increased padding */
            display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;
        }
    </style>
@endpush

@section('content')

    <div class="page-header mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Event Analytics</h3>
            <p class="text-muted small mb-0">Real-time overview of invitations and attendance.</p>
        </div>
        <div>
            <span class="badge bg-white text-dark border shadow-sm py-2 px-3 rounded-pill">
                <i class="fas fa-clock text-primary me-1"></i> Last updated: {{ now()->format('h:i A') }}
            </span>
        </div>
    </div>

    {{-- 1. HERO STATS (Top Row) --}}
    <div class="row g-3 mb-4">
        <div class="col-12 col-md-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon-bg bg-primary"></div>
                <div class="stat-label mb-2">Total Invitations</div>
                <div class="stat-value">{{ number_format($invitationStats->total) }}</div>
                <div class="d-flex align-items-center mt-3 text-success small fw-bold">
                    <i class="fas fa-paper-plane me-1"></i> Sent Successfully
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon-bg bg-success"></div>
                <div class="stat-label mb-2">Confirmed Seats</div>
                <div class="stat-value text-success">
                    {{ number_format($invitationStats->accepted + $invitationStats->total_guests_confirmed) }}
                </div>
                <div class="progress progress-slim">
                    <div class="progress-bar bg-success" style="width: {{ $responseRate }}%"></div>
                </div>
                <div class="d-flex justify-content-between mt-2 small">
                    <span class="text-muted">Response Rate</span>
                    <span class="fw-bold text-dark">{{ $responseRate }}%</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon-bg bg-purple" style="background-color: #8b5cf6;"></div>
                <div class="stat-label mb-2">Actual Attendance</div>
                <div class="stat-value" style="color: #6366f1">
                    {{ number_format($ticketStats->total_checked_in) }}
                    <span class="fs-6 text-muted fw-normal">/ {{ $ticketStats->total_issued }}</span>
                </div>
                <div class="progress progress-slim">
                    <div class="progress-bar" style="background: linear-gradient(135deg, #6366f1, #8b5cf6); width: {{ $attendanceRate }}%"></div>
                </div>
                <div class="d-flex justify-content-between mt-2 small">
                    <span class="text-muted">Check-in Rate</span>
                    <span class="fw-bold text-dark">{{ $attendanceRate }}%</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon-bg bg-warning"></div>
                <div class="stat-label mb-2">Pending Action</div>
                <div class="stat-value text-warning">{{ number_format($invitationStats->pending) }}</div>
                <div class="d-flex align-items-center mt-3 text-muted small">
                    <i class="fas fa-clock me-1"></i> Waiting for response
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">

        {{-- 2. INVITATION STATUS BREAKDOWN (Expanded to col-lg-6) --}}
        <div class="col-md-12 col-lg-6">
            <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <h6 class="fw-bold mb-0">Response Breakdown</h6>
                </div>
                <div class="card-body px-4 pb-4">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="small fw-bold text-dark">Accepted</span>
                            <span class="small text-muted">{{ $invitationStats->accepted }}</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-success" style="width: {{ $invitationStats->total ? ($invitationStats->accepted / $invitationStats->total * 100) : 0 }}%"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="small fw-bold text-dark">Declined</span>
                            <span class="small text-muted">{{ $invitationStats->declined }}</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-danger" style="width: {{ $invitationStats->total ? ($invitationStats->declined / $invitationStats->total * 100) : 0 }}%"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="small fw-bold text-dark">Maybe</span>
                            <span class="small text-muted">{{ $invitationStats->maybe }}</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-info" style="width: {{ $invitationStats->total ? ($invitationStats->maybe / $invitationStats->total * 100) : 0 }}%"></div>
                        </div>
                    </div>

                    <div class="mb-0">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="small fw-bold text-dark">Pending</span>
                            <span class="small text-muted">{{ $invitationStats->pending }}</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-warning" style="width: {{ $invitationStats->total ? ($invitationStats->pending / $invitationStats->total * 100) : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 3. TICKET USAGE COMPARISON (Expanded to col-lg-6) --}}
        <div class="col-md-12 col-lg-6">
            <div class="card border-0 shadow-sm h-100 rounded-4">
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <h6 class="fw-bold mb-0">Ticket Usage Analysis</h6>
                </div>
                <div class="card-body px-4 py-4 d-flex flex-column justify-content-center">

                    {{-- Main Invitees --}}
                    <div class="comp-pill">
                        <div>
                            <div class="small fw-bold text-dark"><i class="fas fa-user-tie text-primary me-2"></i> Main Invitees</div>
                            <div class="small text-muted ps-4">Checked-in</div>
                        </div>
                        <div class="text-end">
                            <div class="fw-bold fs-4 text-dark">{{ $ticketStats->main_checked_in }} <span class="text-muted fs-6 fw-normal">/ {{ $ticketStats->main_issued }}</span></div>
                            @php $mainPercent = $ticketStats->main_issued ? round(($ticketStats->main_checked_in / $ticketStats->main_issued) * 100) : 0; @endphp
                            <div class="small {{ $mainPercent > 50 ? 'text-success' : 'text-warning' }} fw-bold">{{ $mainPercent }}%</div>
                        </div>
                    </div>

                    {{-- Guests --}}
                    <div class="comp-pill mb-0">
                        <div>
                            <div class="small fw-bold text-dark"><i class="fas fa-users text-info me-2"></i> Accompanying Guests</div>
                            <div class="small text-muted ps-4">Checked-in</div>
                        </div>
                        <div class="text-end">
                            <div class="fw-bold fs-4 text-dark">{{ $ticketStats->guest_checked_in }} <span class="text-muted fs-6 fw-normal">/ {{ $ticketStats->guest_issued }}</span></div>
                            @php $guestPercent = $ticketStats->guest_issued ? round(($ticketStats->guest_checked_in / $ticketStats->guest_issued) * 100) : 0; @endphp
                            <div class="small {{ $guestPercent > 50 ? 'text-success' : 'text-warning' }} fw-bold">{{ $guestPercent }}%</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
