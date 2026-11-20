@extends('layouts.admin')

@section('title', 'Booking Inquiries Management')
@section('header_title', 'Customer Booking Inquiries & Leads')

@section('content')
<div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
        <!-- Search & Status Filter -->
        <form action="{{ route('admin.bookings.index') }}" method="GET" class="d-flex flex-wrap gap-2">
            <div class="input-group" style="max-width: 280px;">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Ref, Name, Email..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-sm btn-outline-secondary"><i class="fas fa-search"></i></button>
            </div>

            <select name="status" class="form-select form-select-sm" style="max-width: 180px;" onchange="this.form.submit()">
                <option value="">All Statuses</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="contacted" {{ request('status') == 'contacted' ? 'selected' : '' }}>Contacted</option>
                <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>

            @if(request()->anyFilled(['search', 'status']))
                <a href="{{ route('admin.bookings.index') }}" class="btn btn-sm btn-outline-danger">Reset</a>
            @endif
        </form>

        <span class="text-muted fs-7">{{ $bookings->total() }} Inquiries Logged</span>
    </div>
</div>

<!-- Bookings Table -->
<div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light fs-8 text-uppercase text-muted">
                <tr>
                    <th>Reference</th>
                    <th>Customer Info</th>
                    <th>Tour / Destination</th>
                    <th>Travel Date</th>
                    <th>Guests</th>
                    <th>Status</th>
                    <th class="text-end">Manage</th>
                </tr>
            </thead>
            <tbody class="fs-7">
                @forelse($bookings as $b)
                    <tr>
                        <td class="fw-bold text-dark">{{ $b->booking_reference }}</td>
                        <td>
                            <div class="fw-bold text-dark">{{ $b->customer_name }}</div>
                            <div class="fs-8 text-muted"><i class="far fa-envelope me-1"></i> {{ $b->customer_email }}</div>
                            <div class="fs-8 text-muted"><i class="fas fa-phone me-1"></i> {{ $b->customer_phone }}</div>
                        </td>
                        <td>
                            <span class="fw-semibold text-dark">{{ $b->destination_interest ?? ($b->tour->title ?? 'Custom Inquiry') }}</span>
                            @if($b->special_requests)
                                <div class="fs-8 text-muted mt-1 text-truncate" style="max-width: 250px;" title="{{ $b->special_requests }}">
                                    <b>Note:</b> {{ $b->special_requests }}
                                </div>
                            @endif
                        </td>
                        <td>
                            @if($b->departure_date)
                                <span class="text-dark">{{ $b->departure_date->format('M d, Y') }}</span>
                                <span class="d-block fs-8 text-muted">{{ $b->time_slot }}</span>
                            @else
                                <span class="text-muted">Flexible</span>
                            @endif
                        </td>
                        <td>
                            <span class="text-muted">{{ $b->adults_count }} Adults @if($b->children_count)/ {{ $b->children_count }} Kids @endif</span>
                        </td>
                        <td>
                            <form action="{{ route('admin.bookings.updateStatus', $b->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="form-select form-select-sm rounded-pill fw-bold 
                                    @if($b->status === 'confirmed') text-success bg-success bg-opacity-10 
                                    @elseif($b->status === 'cancelled') text-danger bg-danger bg-opacity-10 
                                    @else text-warning bg-warning bg-opacity-10 @endif" 
                                    onchange="this.form.submit()">
                                    <option value="pending" {{ $b->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="contacted" {{ $b->status === 'contacted' ? 'selected' : '' }}>Contacted</option>
                                    <option value="confirmed" {{ $b->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="cancelled" {{ $b->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </form>
                        </td>
                        <td class="text-end">
                            <form action="{{ route('admin.bookings.destroy', $b->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this inquiry?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill" title="Delete Inquiry">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">No booking inquiries found matching criteria.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-3 border-top d-flex justify-content-center">
        {{ $bookings->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
