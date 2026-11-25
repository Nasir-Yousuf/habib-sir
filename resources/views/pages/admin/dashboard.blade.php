@extends('layouts.admin')

@section('title', 'Admin Dashboard Overview')
@section('header_title', 'Executive Analytics & Performance')

@section('content')
<!-- Metric Stat Cards Row (2-up grid on mobile phones, 4-up on desktop) -->
<div class="row g-3 g-md-4 mb-4">
    <!-- Stat 1: Total Tours -->
    <div class="col-6 col-xl-3">
        <div class="card stat-card p-3 p-md-4 bg-white h-100">
            <div class="d-flex justify-content-between align-items-center mb-2 gap-1">
                <span class="text-muted small fw-bold text-uppercase text-truncate">Tours</span>
                <span class="p-2 bg-success bg-opacity-10 text-success rounded-3 flex-shrink-0"><i class="fas fa-map-marked-alt"></i></span>
            </div>
            <h2 class="fs-2 fw-bold mb-1 text-dark">{{ $stats['total_tours'] }}</h2>
            <span class="text-muted small"><i class="fas fa-check text-success me-1"></i> {{ $stats['active_tours'] }} Active</span>
        </div>
    </div>

    <!-- Stat 2: Inbound Bookings -->
    <div class="col-6 col-xl-3">
        <div class="card stat-card p-3 p-md-4 bg-white h-100">
            <div class="d-flex justify-content-between align-items-center mb-2 gap-1">
                <span class="text-muted small fw-bold text-uppercase text-truncate">Inquiries</span>
                <span class="p-2 bg-primary bg-opacity-10 text-primary rounded-3 flex-shrink-0"><i class="fas fa-calendar-check"></i></span>
            </div>
            <h2 class="fs-2 fw-bold mb-1 text-dark">{{ $stats['total_bookings'] }}</h2>
            <span class="badge badge-pending px-2 py-1 small">{{ $stats['pending_bookings'] }} Pending</span>
        </div>
    </div>

    <!-- Stat 3: Destinations -->
    <div class="col-6 col-xl-3">
        <div class="card stat-card p-3 p-md-4 bg-white h-100">
            <div class="d-flex justify-content-between align-items-center mb-2 gap-1">
                <span class="text-muted small fw-bold text-uppercase text-truncate">Destinations</span>
                <span class="p-2 bg-info bg-opacity-10 text-info rounded-3 flex-shrink-0"><i class="fas fa-globe-asia"></i></span>
            </div>
            <h2 class="fs-2 fw-bold mb-1 text-dark">{{ $stats['total_destinations'] }}</h2>
            <span class="text-muted small">BD &amp; Global</span>
        </div>
    </div>

    <!-- Stat 4: Contact Messages -->
    <div class="col-6 col-xl-3">
        <div class="card stat-card p-3 p-md-4 bg-white h-100">
            <div class="d-flex justify-content-between align-items-center mb-2 gap-1">
                <span class="text-muted small fw-bold text-uppercase text-truncate">Messages</span>
                <span class="p-2 bg-warning bg-opacity-10 text-warning rounded-3 flex-shrink-0"><i class="fas fa-envelope"></i></span>
            </div>
            <h2 class="fs-2 fw-bold mb-1 text-dark">{{ $stats['total_messages'] }}</h2>
            <span class="text-danger small fw-semibold">{{ $stats['unread_messages'] }} Unread</span>
        </div>
    </div>
</div>

<!-- Quick Actions Banner -->
<div class="card border-0 shadow-sm rounded-4 p-3 p-md-4 mb-4 bg-white">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
        <div>
            <h5 class="fw-bold mb-1">Administrative Quick Actions</h5>
            <p class="text-muted small mb-0">Create new tour packages, adjust destination itineraries, or review inbound leads.</p>
        </div>
        <div class="d-flex flex-wrap gap-2 w-100 w-md-auto justify-content-md-end">
            <a href="{{ route('admin.tours.create') }}" class="btn btn-success rounded-pill px-4 flex-grow-1 flex-md-grow-0 btn-touch">
                <i class="fas fa-plus me-1"></i> Add Tour Package
            </a>
            <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-dark rounded-pill px-3 flex-grow-1 flex-md-grow-0 btn-touch">
                <i class="fas fa-calendar-alt me-1"></i> View Inquiries
            </a>
        </div>
    </div>
</div>

<!-- Recent Inbound Bookings & Messages -->
<div class="row g-4">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-4 bg-white p-3 p-md-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3 mb-md-4">
                <h5 class="fw-bold mb-0">Recent Customer Inquiries</h5>
                <a href="{{ route('admin.bookings.index') }}" class="text-success small fw-bold text-decoration-none">View All <i class="fas fa-arrow-right ms-1"></i></a>
            </div>

            <!-- Desktop Table -->
            <div class="table-responsive d-none d-md-block">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light small text-uppercase text-muted">
                        <tr>
                            <th>Ref #</th>
                            <th>Customer</th>
                            <th>Tour / Destination</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="small">
                        @forelse($recentBookings as $b)
                            <tr>
                                <td class="fw-bold text-dark font-monospace">{{ $b->booking_reference }}</td>
                                <td>
                                    <div class="fw-bold">{{ $b->customer_name }}</div>
                                    <span class="text-muted">{{ $b->customer_phone }}</span>
                                </td>
                                <td>{{ Str::limit($b->destination_interest ?? ($b->tour->title ?? 'Custom Inquiry'), 24) }}</td>
                                <td>
                                    <span class="badge px-2 py-1 rounded-pill 
                                        @if($b->status === 'confirmed') badge-confirmed 
                                        @elseif($b->status === 'cancelled') badge-cancelled 
                                        @else badge-pending @endif">
                                        {{ ucfirst($b->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.bookings.index', ['search' => $b->booking_reference]) }}" class="btn btn-sm btn-light border rounded-pill">
                                        Manage
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">No inquiries received yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Cards -->
            <div class="d-flex flex-column gap-2 d-md-none">
                @forelse($recentBookings as $b)
                    <div class="p-3 border rounded-3 bg-light">
                        <div class="d-flex justify-content-between align-items-center mb-1 gap-2">
                            <span class="badge bg-dark font-monospace">{{ $b->booking_reference }}</span>
                            <span class="badge px-2 py-1 rounded-pill 
                                @if($b->status === 'confirmed') badge-confirmed 
                                @elseif($b->status === 'cancelled') badge-cancelled 
                                @else badge-pending @endif">
                                {{ ucfirst($b->status) }}
                            </span>
                        </div>
                        <div class="fw-bold text-dark">{{ $b->customer_name }}</div>
                        <div class="text-muted small mb-2">{{ Str::limit($b->destination_interest ?? ($b->tour->title ?? 'Custom Inquiry'), 45) }}</div>
                        <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                            <a href="tel:{{ $b->customer_phone }}" class="text-success small text-decoration-none fw-semibold">
                                <i class="fas fa-phone me-1"></i> {{ $b->customer_phone }}
                            </a>
                            <a href="{{ route('admin.bookings.index', ['search' => $b->booking_reference]) }}" class="btn btn-sm btn-white border rounded-pill px-3">
                                Manage
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-muted py-4">No inquiries received yet.</div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Recent Contact Messages -->
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm rounded-4 bg-white p-3 p-md-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3 mb-md-4">
                <h5 class="fw-bold mb-0">Recent Contact Messages</h5>
                <a href="{{ route('admin.messages.index') }}" class="text-success small fw-bold text-decoration-none">View All <i class="fas fa-arrow-right ms-1"></i></a>
            </div>

            <div class="d-flex flex-column gap-3">
                @forelse($recentMessages as $msg)
                    <div class="p-3 border rounded-3 bg-light position-relative">
                        <div class="d-flex justify-content-between align-items-start mb-1 gap-2">
                            <span class="fw-bold small text-dark">{{ $msg->name }}</span>
                            <span class="small text-muted flex-shrink-0">{{ $msg->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-muted small mb-2">{{ Str::limit($msg->message, 80) }}</p>
                        <div class="d-flex justify-content-between align-items-center gap-2">
                            <a href="mailto:{{ $msg->email }}" class="small text-muted text-decoration-none text-truncate"><i class="far fa-envelope me-1"></i> {{ $msg->email }}</a>
                            @if(!$msg->is_read)
                                <span class="badge bg-danger rounded-pill small flex-shrink-0">New</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center text-muted py-4">No contact messages received.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
