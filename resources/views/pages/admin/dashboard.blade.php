@extends('layouts.admin')

@section('title', 'Admin Dashboard Overview')
@section('header_title', 'Executive Analytics & Performance')

@section('content')
<!-- Metric Stat Cards Row -->
<div class="row g-4 mb-4">
    <!-- Stat 1: Total Tours -->
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card p-4 bg-white">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="text-muted fs-7 fw-bold text-uppercase">Tour Packages</span>
                <span class="p-2 bg-success bg-opacity-10 text-success rounded-3"><i class="fas fa-map-marked-alt"></i></span>
            </div>
            <h2 class="display-6 fw-bold mb-1 text-dark">{{ $stats['total_tours'] }}</h2>
            <span class="text-muted fs-8"><i class="fas fa-check text-success me-1"></i> {{ $stats['active_tours'] }} Active Publicly</span>
        </div>
    </div>

    <!-- Stat 2: Inbound Bookings -->
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card p-4 bg-white">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="text-muted fs-7 fw-bold text-uppercase">Total Inquiries</span>
                <span class="p-2 bg-primary bg-opacity-10 text-primary rounded-3"><i class="fas fa-calendar-check"></i></span>
            </div>
            <h2 class="display-6 fw-bold mb-1 text-dark">{{ $stats['total_bookings'] }}</h2>
            <span class="badge badge-pending px-2 py-1 fs-8">{{ $stats['pending_bookings'] }} Pending Action</span>
        </div>
    </div>

    <!-- Stat 3: Destinations -->
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card p-4 bg-white">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="text-muted fs-7 fw-bold text-uppercase">Destinations</span>
                <span class="p-2 bg-info bg-opacity-10 text-info rounded-3"><i class="fas fa-globe-asia"></i></span>
            </div>
            <h2 class="display-6 fw-bold mb-1 text-dark">{{ $stats['total_destinations'] }}</h2>
            <span class="text-muted fs-8">Bangladesh &amp; International</span>
        </div>
    </div>

    <!-- Stat 4: Contact Messages -->
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card p-4 bg-white">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="text-muted fs-7 fw-bold text-uppercase">Contact Messages</span>
                <span class="p-2 bg-warning bg-opacity-10 text-warning rounded-3"><i class="fas fa-envelope"></i></span>
            </div>
            <h2 class="display-6 fw-bold mb-1 text-dark">{{ $stats['total_messages'] }}</h2>
            <span class="text-danger fs-8 fw-semibold">{{ $stats['unread_messages'] }} Unread Messages</span>
        </div>
    </div>
</div>

<!-- Quick Actions Banner -->
<div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
            <h5 class="fw-bold mb-1">Administrative Quick Actions</h5>
            <p class="text-muted fs-7 mb-0">Create new tour packages, adjust destination itineraries, or review inbound leads.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.tours.create') }}" class="btn btn-success rounded-pill px-4">
                <i class="fas fa-plus me-1"></i> Add New Tour Package
            </a>
            <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-dark rounded-pill px-3">
                <i class="fas fa-calendar-alt me-1"></i> View Inquiries
            </a>
        </div>
    </div>
</div>

<!-- Recent Inbound Bookings Table -->
<div class="row g-4">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-4 bg-white p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0">Recent Customer Inquiries</h5>
                <a href="{{ route('admin.bookings.index') }}" class="text-success fs-7 fw-bold text-decoration-none">View All</a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light fs-8 text-uppercase text-muted">
                        <tr>
                            <th>Ref #</th>
                            <th>Customer</th>
                            <th>Tour / Destination</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="fs-7">
                        @forelse($recentBookings as $b)
                            <tr>
                                <td class="fw-bold text-dark">{{ $b->booking_reference }}</td>
                                <td>
                                    <div class="fw-bold">{{ $b->customer_name }}</div>
                                    <span class="text-muted fs-8">{{ $b->customer_phone }}</span>
                                </td>
                                <td>{{ Str::limit($b->destination_interest ?? ($b->tour->title ?? 'Custom Inquiry'), 22) }}</td>
                                <td>
                                    <span class="badge px-2 py-1 rounded-pill 
                                        @if($b->status === 'confirmed') badge-confirmed 
                                        @elseif($b->status === 'cancelled') badge-cancelled 
                                        @else badge-pending @endif">
                                        {{ ucfirst($b->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-sm btn-light border rounded-pill">
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
        </div>
    </div>

    <!-- Recent Contact Messages -->
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm rounded-4 bg-white p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0">Recent Contact Messages</h5>
                <a href="{{ route('admin.messages.index') }}" class="text-success fs-7 fw-bold text-decoration-none">View All</a>
            </div>

            <div class="d-flex flex-column gap-3">
                @forelse($recentMessages as $msg)
                    <div class="p-3 border rounded-3 bg-light position-relative">
                        <div class="d-flex justify-content-between align-items-start mb-1">
                            <span class="fw-bold fs-7 text-dark">{{ $msg->name }}</span>
                            <span class="fs-8 text-muted">{{ $msg->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-muted fs-8 mb-2">{{ Str::limit($msg->message, 80) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fs-8 text-muted"><i class="far fa-envelope me-1"></i> {{ $msg->email }}</span>
                            @if(!$msg->is_read)
                                <span class="badge bg-danger rounded-pill fs-8">New</span>
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
