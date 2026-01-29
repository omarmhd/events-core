@extends('layouts.app')

@section('title', 'Staff Directory')

@push('styles')
    <style>
        /* --- General Layout --- */
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; }

        /* --- Buttons & Inputs --- */
        .btn-action { background: var(--grad-purple); color: white; border: none; padding: 10px 24px; border-radius: 10px; font-weight: 600; box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3); transition: 0.3s; }
        .btn-action:hover { transform: translateY(-2px); box-shadow: 0 6px 15px rgba(99, 102, 241, 0.4); color: white; }

        .search-container { position: relative; max-width: 400px; }
        .search-input { border: 1px solid #e2e8f0; background: #f8fafc; border-radius: 12px; padding: 12px 15px 12px 45px; width: 100%; font-size: 0.95rem; transition: 0.3s; }
        .search-input:focus { background: white; border-color: var(--primary-color); outline: none; box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1); }
        .search-icon { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #94a3b8; }

        /* --- Card & Table --- */
        .custom-card { background: white; border-radius: 24px; border: 1px solid #f1f5f9; box-shadow: var(--shadow-card); overflow: hidden; min-height: 400px;}
        .table-custom thead th { background: #f8fafc; color: var(--text-muted); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 700; padding: 16px; border-bottom: 1px solid #e2e8f0; }
        .table-custom tbody td { padding: 16px; vertical-align: middle; border-bottom: 1px solid #f1f5f9; font-size: 0.9rem; }

        /* --- Avatar --- */
        .avatar-initials { width: 40px; height: 40px; border-radius: 10px; font-weight: 700; font-size: 0.9rem; display: flex; align-items: center; justify-content: center; color: var(--primary-color); background: #eff6ff; margin-right: 12px; }

        /* --- Badges --- */
        .badge-soft { padding: 6px 12px; border-radius: 8px; font-size: 0.75rem; font-weight: 600; }
        .badge-success { background: #dcfce7; color: #166534; }
        .badge-danger { background: #fee2e2; color: #991b1b; }
        .badge-warning { background: #fef3c7; color: #92400e; }
        .badge-neutral { background: #f1f5f9; color: #64748b; }

        /* --- New Action Buttons Styling --- */
        .btn-icon {
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            border: 1px solid transparent;
            transition: all 0.2s;
            color: #64748b;
            background: #f8fafc;
            text-decoration: none;
        }
        .btn-icon:hover {
            background: #e2e8f0;
            color: #334155;
            transform: translateY(-1px);
        }
        .btn-icon-primary:hover { background: #eff6ff; color: #3b82f6; border-color: #dbeafe; }

        /* --- Dropdown Styling --- */
        .dropdown-menu-custom {
            border: 1px solid #f1f5f9;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            padding: 6px;
            min-width: 200px;
        }
        .dropdown-item {
            border-radius: 6px;
            padding: 8px 12px;
            font-size: 0.85rem;
            font-weight: 500;
            color: #475569;
        }
        .dropdown-item:hover {
            background-color: #f8fafc;
            color: var(--primary-color);
        }
        .dropdown-item.text-danger:hover {
            background-color: #fef2f2;
            color: #dc2626;
        }
        .dropdown-divider {
            margin: 4px 0;
            border-top-color: #f1f5f9;
        }
    </style>
@endpush

@section('content')
    <div class="page-header">
        <div>
            <h3 class="fw-bold text-dark mb-1">Invitations</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}" class="text-decoration-none text-muted">Home</a></li>
                    <li class="breadcrumb-item active text-primary">Invitations</li>
                </ol>
            </nav>
        </div>

        <a href="{{route("invitations.create")}}" class="btn-action text-decoration-none">
            <i class="fas fa-paper-plane me-2"></i> Send New Invitation
        </a>
    </div>

    <div class="custom-card">
        <div class="card-body p-0">

            <div class="p-4 border-bottom bg-white d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">

                <form action="{{ route('invitations.index') }}" method="get" class="w-100" style="max-width: 500px;">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text"
                               name="searchInput"
                               class="form-control border-start-0 ps-0"
                               placeholder="Search by name, email, phone, job, status"
                               value="{{ request('searchInput') }}">
                        <button class="btn btn-primary px-4" type="submit">
                            Search
                        </button>
                    </div>
                </form>

                <div>
                    <a href="{{route("invitations.export")}}" class="btn btn-light border text-muted btn-sm rounded-3 px-3 fw-bold">
                        <i class="fas fa-download me-1"></i> Export CSV
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-custom mb-0">
                    <thead>
                    <tr>
                        <th class="ps-4">Employee Details</th>
                        <th>Job Title</th>
                        <th class="text-center">Guests</th>
                        <th class="text-center">Status</th>
                        <th>Sent Date</th>
                        <th>Responded Date</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($rows as $row)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-initials">
                                        {{ strtoupper(substr($row->invitee_name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark">{{ $row->invitee_name }}</div>
                                        <div class="small text-muted" style="font-size: 0.8rem;">{{ $row->invitee_email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-bold text-dark fs-6">{{ $row->invitee_position ?: '-' }}</div>
                            </td>
                            <td class="text-center">
                                @if($row->selected_guests > 0)
                                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3">{{ $row->selected_guests }}</span>
                                @else
                                    <span class="text-muted opacity-25">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @php
                                    $statusClass = match($row->status) {
                                        'accepted' => 'badge-success',
                                        'declined' => 'badge-danger',
                                        'pending' => 'badge-warning',
                                        default => 'badge-neutral'
                                    };
                                @endphp
                                <span class="badge-soft {{ $statusClass }}">{{ ucfirst($row->status) }}</span>
                            </td>
                            <td>
                                <div class="small fw-bold text-dark">{{ \Carbon\Carbon::parse($row->created_at)->format('M d, Y') }}</div>
                            </td>
                            <td>
                                <div class="small fw-bold text-dark">
                                    {{ $row->responded_at ? \Carbon\Carbon::parse($row->responded_at)->format('M d, Y') : "-" }}
                                </div>
                            </td>

                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end align-items-center gap-2">
                                    @php
                                        $invitationLink = route('rsvp.show',$row->invitation_token);
                                        $ticketsLink = route('downloadPdf', $row->invitation_token);

                                        $whatsappMessageTickets =  "{$row->invitee_name},\n\n" .
                                                                  "Thank you for accepting the invitation.\n\n" .
                                                                  "You can download your tickets here:\n" .
                                                                  "{$ticketsLink}";

                                        $descEn = strip_tags($event->description_en);
                                        $descAr = strip_tags($event->description);

                                        $whatsappMessage =  "{$row->invitee_name},\n\n" .
                                                            "{$descAr}\n\n" .
                                                            "{$descEn}\n\n" .
                                                            "للاطلاع على تفاصيل الدعوة / View invitation details:\n" .
                                                            "{$invitationLink}";
                                    @endphp

                                    {{-- Edit --}}
                                    <a href="{{ route('invitations.edit', $row->id) }}"
                                       class="btn-icon btn-icon-primary"
                                       title="Edit Invitation">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>

                                    {{-- Copy Invitation --}}
                                    <button type="button"
                                            class="btn-icon"
                                            onclick="copyToClipboard(this, `{{ $whatsappMessage }}`)"
                                            title="Copy Invite Message">
                                        <i class="fas fa-copy"></i>
                                    </button>

                                    {{-- More Actions Dropdown --}}
                                    <div class="dropdown">
                                        <button class="btn-icon" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="More Options">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-custom">

                                            @if($row->status != "pending")
                                                <li>
                                                    <button class="dropdown-item d-flex align-items-center gap-2"
                                                            onclick="copyToClipboard(this, `{{ $whatsappMessageTickets }}`)">
                                                        <i class="fas fa-ticket-alt text-warning"></i> Copy Tickets Link
                                                    </button>
                                                </li>
                                                <li><hr class="dropdown-divider"></li>
                                            @endif

                                            <li>
                                                <form action="{{ route('invitations.resend') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $row->id }}">
                                                    <button class="dropdown-item d-flex align-items-center gap-2"
                                                            type="submit"
                                                            onclick="return confirm('Regenerate and resend ticket?');">
                                                        <i class="fas fa-sync-alt text-info"></i> Resend Email
                                                    </button>
                                                </form>
                                            </li>

                                            <li><hr class="dropdown-divider"></li>

                                            <li>
                                                <form action="{{ route('invitations.destroy', $row->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item d-flex align-items-center gap-2 text-danger"
                                                            type="submit"
                                                            onclick="return confirm('Are you sure you want to delete this invitation?\nAll related data will be removed.');">
                                                        <i class="fas fa-trash-alt"></i> Delete Invitation
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center py-5 text-muted">No invitations found.</td></tr>
                    @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-4">
                    {{ $rows->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section("infoCard")
    <div class="stats-card d-none d-md-block">
        <div class="d-flex align-items-center gap-2 mb-3">
            <i class="fas fa-chart-pie"></i>
            <h6 class="fw-bold mb-0">Overview</h6>
        </div>

        <div class="stat-row">
            <span class="stat-label">Total Sent</span>
            <span class="stat-value">{{ $stats["all"] ?? '0' }}</span>
        </div>
        <hr class="my-2 opacity-25">
        <div class="stat-row">
            <span class="stat-label"><i class="fas fa-circle text-warning small me-1"></i> Pending</span>
            <span class="stat-value">{{ $stats["pending"] ?? '0' }}</span>
        </div>
        <div class="stat-row">
            <span class="stat-label"><i class="fas fa-circle text-success small me-1"></i> Accepted</span>
            <span class="stat-value">{{ $stats["accepted"] ?? '0' }}</span>
        </div>
        <div class="stat-row">
            <span class="stat-label"><i class="fas fa-circle text-danger small me-1"></i> Declined</span>
            <span class="stat-value">{{ $stats["declined"] ?? '0' }}</span>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Copy function with visual feedback
        function copyToClipboard(button, text) {
            navigator.clipboard.writeText(text).then(function() {
                // Check if element is a button or an anchor inside a dropdown
                let icon = button.querySelector('i');
                let originalClass = icon.className;

                // Change icon to checkmark
                icon.className = 'fas fa-check text-success';

                // Revert back after 2 seconds
                setTimeout(() => {
                    icon.className = originalClass;
                }, 2000);

            }, function(err) {
                console.error('Could not copy text: ', err);
                alert('Failed to copy to clipboard.');
            });
        }

        // Initialize Bootstrap Tooltips (If using Bootstrap 5)
        document.addEventListener("DOMContentLoaded", function(){
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
@endpush
