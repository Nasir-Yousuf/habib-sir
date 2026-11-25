@extends('layouts.admin')

@section('title', 'Booking Inquiries Management')
@section('header_title', 'Customer Booking Inquiries & Leads')

@section('content')
<!-- Filter & Export Bar -->
<div class="card border-0 shadow-sm rounded-4 p-3 p-md-4 bg-white mb-4">
    <div class="row g-3 align-items-center">
        <div class="col-12 col-lg-8">
            <form action="{{ route('admin.bookings.index') }}" method="GET" class="row g-2 align-items-center">
                <div class="col-12 col-sm-5">
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" class="form-control" placeholder="Ref, Name, Email, Phone..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-outline-secondary" aria-label="Search"><i class="fas fa-search"></i></button>
                    </div>
                </div>

                <div class="col-8 col-sm-4">
                    <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="contacted" {{ request('status') == 'contacted' ? 'selected' : '' }}>Contacted</option>
                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                @if(request()->anyFilled(['search', 'status']))
                    <div class="col-4 col-sm-3">
                        <a href="{{ route('admin.bookings.index') }}" class="btn btn-sm btn-outline-danger w-100 btn-touch">Reset</a>
                    </div>
                @endif
            </form>
        </div>

        <div class="col-12 col-lg-4 d-flex justify-content-between justify-content-lg-end align-items-center gap-2">
            <span class="text-muted small">{{ $bookings->total() }} Inquiries</span>
            <a href="{{ route('admin.bookings.export', request()->only(['search', 'status'])) }}" class="btn btn-sm btn-outline-success rounded-pill px-3 btn-touch">
                <i class="fas fa-file-csv me-1"></i> Export CSV
            </a>
        </div>
    </div>
</div>

<!-- Desktop Bookings Table (md and up) -->
<div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden d-none d-md-block">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light small text-uppercase text-muted">
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
            <tbody class="small">
                @forelse($bookings as $b)
                    @php
                        $tourTitle = $b->destination_interest ?? ($b->tour->title ?? 'Custom Inquiry');
                        $waPhone = preg_replace('/[^0-9]/', '', $b->customer_phone);
                        $waText = urlencode("Hello {$b->customer_name}, thank you for your booking inquiry ({$b->booking_reference}) with Bongo Tanbo Travels regarding {$tourTitle}.");
                    @endphp
                    <tr>
                        <td class="fw-bold text-dark font-monospace">{{ $b->booking_reference }}</td>
                        <td>
                            <div class="fw-bold text-dark">{{ $b->customer_name }}</div>
                            <div class="text-muted"><i class="far fa-envelope me-1"></i> {{ $b->customer_email }}</div>
                            <div class="text-muted"><i class="fas fa-phone me-1"></i> {{ $b->customer_phone }}</div>
                        </td>
                        <td>
                            <span class="fw-semibold text-dark">{{ $tourTitle }}</span>
                            @if($b->special_requests)
                                <div class="text-muted mt-1 text-truncate" style="max-width: 240px;" title="{{ $b->special_requests }}">
                                    <b>Note:</b> {{ $b->special_requests }}
                                </div>
                            @endif
                        </td>
                        <td>
                            @if($b->departure_date)
                                <span class="text-dark">{{ $b->departure_date->format('M d, Y') }}</span>
                                <span class="d-block text-muted">{{ $b->time_slot }}</span>
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
                        <td class="text-end text-nowrap">
                            <button type="button"
                                class="btn btn-sm btn-outline-secondary rounded-pill me-1 view-booking-btn"
                                data-bs-toggle="modal"
                                data-bs-target="#bookingDetailModal"
                                data-ref="{{ $b->booking_reference }}"
                                data-name="{{ $b->customer_name }}"
                                data-email="{{ $b->customer_email }}"
                                data-phone="{{ $b->customer_phone }}"
                                data-tour="{{ $tourTitle }}"
                                data-date="{{ $b->departure_date ? $b->departure_date->format('M d, Y') : 'Flexible' }}"
                                data-slot="{{ $b->time_slot ?? 'Flexible Schedule' }}"
                                data-guests="{{ $b->adults_count }} Adults{{ $b->children_count ? ', ' . $b->children_count . ' Children' : '' }}"
                                data-status="{{ ucfirst($b->status) }}"
                                data-notes="{{ $b->special_requests ?? 'No special requests provided.' }}"
                                title="View Full Details">
                                <i class="fas fa-eye"></i>
                            </button>
                            <a href="https://wa.me/{{ $waPhone }}?text={{ $waText }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-success rounded-pill me-1" title="WhatsApp Customer">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="{{ route('bookings.voucher', $b->booking_reference) }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill me-1" title="View Voucher">
                                <i class="fas fa-file-invoice"></i>
                            </a>
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

<!-- Mobile Bookings Cards (< 768px) -->
<div class="d-md-none d-flex flex-column gap-3">
    @forelse($bookings as $b)
        @php
            $tourTitle = $b->destination_interest ?? ($b->tour->title ?? 'Custom Inquiry');
            $waPhone = preg_replace('/[^0-9]/', '', $b->customer_phone);
            $waText = urlencode("Hello {$b->customer_name}, thank you for your booking inquiry ({$b->booking_reference}) with Bongo Tanbo Travels regarding {$tourTitle}.");
        @endphp
        <div class="admin-mobile-card">
            <!-- Card Top: Ref & Created Date -->
            <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                <span class="badge bg-dark font-monospace px-2 py-1">{{ $b->booking_reference }}</span>
                <span class="text-muted small">{{ $b->created_at->format('M d, Y') }}</span>
            </div>

            <!-- Customer & Tour Info -->
            <h6 class="fw-bold text-dark mb-1">{{ $b->customer_name }}</h6>
            <div class="text-success fw-semibold small mb-2">{{ $tourTitle }}</div>

            <div class="d-flex flex-wrap gap-3 small text-muted mb-3">
                <span><i class="far fa-calendar-check me-1 text-primary"></i> {{ $b->departure_date ? $b->departure_date->format('M d, Y') : 'Flexible' }}</span>
                <span><i class="fas fa-users me-1 text-info"></i> {{ $b->adults_count }}A{{ $b->children_count ? ' / ' . $b->children_count . 'C' : '' }}</span>
            </div>

            <div class="d-flex flex-wrap gap-2 mb-3 small">
                <a href="tel:{{ $b->customer_phone }}" class="badge bg-light text-dark border text-decoration-none py-2 px-2">
                    <i class="fas fa-phone text-success me-1"></i> {{ $b->customer_phone }}
                </a>
                <a href="mailto:{{ $b->customer_email }}" class="badge bg-light text-dark border text-decoration-none py-2 px-2 text-truncate" style="max-width: 100%;">
                    <i class="far fa-envelope text-primary me-1"></i> {{ $b->customer_email }}
                </a>
            </div>

            @if($b->special_requests)
                <div class="p-2 rounded bg-light border-start border-3 border-success small text-muted mb-3">
                    {{ Str::limit($b->special_requests, 90) }}
                </div>
            @endif

            <!-- Status Selector -->
            <form action="{{ route('admin.bookings.updateStatus', $b->id) }}" method="POST" class="mb-3">
                @csrf
                @method('PATCH')
                <label class="form-label small fw-bold text-muted mb-1">Update Status</label>
                <select name="status" class="form-select form-select-sm rounded-3 fw-bold 
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

            <!-- Touch Action Buttons -->
            <div class="d-flex gap-2">
                <button type="button"
                    class="btn btn-sm btn-outline-secondary rounded-pill flex-grow-1 btn-touch view-booking-btn"
                    data-bs-toggle="modal"
                    data-bs-target="#bookingDetailModal"
                    data-ref="{{ $b->booking_reference }}"
                    data-name="{{ $b->customer_name }}"
                    data-email="{{ $b->customer_email }}"
                    data-phone="{{ $b->customer_phone }}"
                    data-tour="{{ $tourTitle }}"
                    data-date="{{ $b->departure_date ? $b->departure_date->format('M d, Y') : 'Flexible' }}"
                    data-slot="{{ $b->time_slot ?? 'Flexible Schedule' }}"
                    data-guests="{{ $b->adults_count }} Adults{{ $b->children_count ? ', ' . $b->children_count . ' Children' : '' }}"
                    data-status="{{ ucfirst($b->status) }}"
                    data-notes="{{ $b->special_requests ?? 'No special requests provided.' }}">
                    <i class="fas fa-eye me-1"></i> Details
                </button>
                <a href="https://wa.me/{{ $waPhone }}?text={{ $waText }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-success rounded-pill px-3 btn-touch" title="WhatsApp">
                    <i class="fab fa-whatsapp"></i>
                </a>
                <a href="{{ route('bookings.voucher', $b->booking_reference) }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3 btn-touch" title="Voucher">
                    <i class="fas fa-file-invoice"></i>
                </a>
                <form action="{{ route('admin.bookings.destroy', $b->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this inquiry?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 btn-touch" title="Delete">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="admin-mobile-card text-center text-muted py-5">
            No booking inquiries found matching criteria.
        </div>
    @endforelse

    @if($bookings->hasPages())
        <div class="pt-2">
            {{ $bookings->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

<!-- Booking Details Modal -->
<div class="modal fade" id="bookingDetailModal" tabindex="-1" aria-labelledby="bookingDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-bottom p-3 p-md-4">
                <div>
                    <span class="badge bg-dark font-monospace mb-1" id="detailRef"></span>
                    <h5 class="modal-title fw-bold mb-0" id="bookingDetailModalLabel">Booking Inquiry Details</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3 p-md-4">
                <div class="row g-3 small">
                    <div class="col-6">
                        <div class="text-muted fw-bold text-uppercase">Traveler</div>
                        <div class="fw-bold text-dark fs-6" id="detailName"></div>
                    </div>
                    <div class="col-6">
                        <div class="text-muted fw-bold text-uppercase">Status</div>
                        <div class="fw-bold text-success fs-6" id="detailStatus"></div>
                    </div>
                    <div class="col-6">
                        <div class="text-muted fw-bold text-uppercase">Phone</div>
                        <a href="#" id="detailPhoneLink" class="fw-semibold text-decoration-none"></a>
                    </div>
                    <div class="col-6">
                        <div class="text-muted fw-bold text-uppercase">Email</div>
                        <a href="#" id="detailEmailLink" class="fw-semibold text-decoration-none text-break"></a>
                    </div>
                    <div class="col-12">
                        <div class="text-muted fw-bold text-uppercase">Tour / Destination</div>
                        <div class="fw-bold text-dark" id="detailTour"></div>
                    </div>
                    <div class="col-6">
                        <div class="text-muted fw-bold text-uppercase">Departure Date</div>
                        <div class="fw-semibold text-dark" id="detailDate"></div>
                    </div>
                    <div class="col-6">
                        <div class="text-muted fw-bold text-uppercase">Party Size</div>
                        <div class="fw-semibold text-dark" id="detailGuests"></div>
                    </div>
                    <div class="col-12">
                        <div class="text-muted fw-bold text-uppercase mb-1">Special Requests</div>
                        <div class="p-3 bg-light rounded-3 text-dark" id="detailNotes"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top p-3">
                <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra_js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const detailBtns = document.querySelectorAll('.view-booking-btn');
    detailBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            document.getElementById('detailRef').textContent = this.dataset.ref;
            document.getElementById('detailName').textContent = this.dataset.name;
            document.getElementById('detailStatus').textContent = this.dataset.status;
            document.getElementById('detailTour').textContent = this.dataset.tour;
            document.getElementById('detailDate').textContent = this.dataset.date + ' (' + this.dataset.slot + ')';
            document.getElementById('detailGuests').textContent = this.dataset.guests;
            document.getElementById('detailNotes').textContent = this.dataset.notes;

            const phoneEl = document.getElementById('detailPhoneLink');
            phoneEl.textContent = this.dataset.phone;
            phoneEl.href = 'tel:' + this.dataset.phone;

            const emailEl = document.getElementById('detailEmailLink');
            emailEl.textContent = this.dataset.email;
            emailEl.href = 'mailto:' + this.dataset.email;
        });
    });
});
</script>
@endsection
