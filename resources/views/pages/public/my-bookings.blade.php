@extends('layouts.public')

@section('title', 'My Bookings & Inquiries | Bongo Tanbo Travels')
@section('meta_description', 'View your personalized travel reservations, itinerary schedules, booking status, and tour vouchers with Bongo Tanbo Travels.')

@section('content')
<!-- Page Header Banner -->
<div class="page-banner bg-dark text-white py-5 position-relative" style="background: linear-gradient(rgba(14,27,39,0.85), rgba(14,27,39,0.85)), url('{{ asset('assets/images/banner1.webp') }}') center/cover;">
    <div class="container py-4 text-center">
        <span class="badge px-3 py-2 rounded-pill fs-7 fw-bold mb-2 text-white" style="background-color: #809e40;">TRAVELER DASHBOARD</span>
        <h1 class="display-6 fw-bold text-white mb-2">My Bookings & Trips</h1>
        <p class="text-white-50 mb-0">Welcome back, {{ $user->name }}! Manage your tour inquiries, check confirmation status, and access your tour vouchers.</p>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <!-- Sidebar Summary Profile -->
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top: 100px; z-index: 10;">
                <div class="text-center pb-3 border-bottom mb-3">
                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center text-white fw-bold mb-3 shadow" style="width: 72px; height: 72px; background: linear-gradient(135deg, #809e40, #5c7526); font-size: 26px;">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <h5 class="fw-bold mb-1 text-dark">{{ $user->name }}</h5>
                    <p class="text-muted small mb-0"><i class="far fa-envelope me-1"></i> {{ $user->email }}</p>
                    <span class="badge bg-light text-success border border-success mt-2 px-3 py-1 rounded-pill">
                        <i class="fas fa-check-circle me-1"></i> Verified Traveler
                    </span>
                </div>
                <div class="d-flex flex-column gap-2 text-muted small">
                    <div class="d-flex justify-content-between py-1">
                        <span>Total Bookings:</span>
                        <strong class="text-dark">{{ $bookings->total() }}</strong>
                    </div>
                    <div class="d-flex justify-content-between py-1">
                        <span>Member Since:</span>
                        <strong class="text-dark">{{ $user->created_at->format('M Y') }}</strong>
                    </div>
                </div>

                <hr>

                <div class="d-grid gap-2">
                    <a href="{{ route('tours.index') }}" class="btn btn-outline-success rounded-pill fw-semibold py-2">
                        <i class="fas fa-compass me-1"></i> Explore More Tours
                    </a>
                    <a href="{{ route('contact.index') }}" class="btn btn-light rounded-pill fw-semibold py-2 text-muted">
                        <i class="far fa-comment-dots me-1"></i> Need Assistance?
                    </a>
                </div>
            </div>
        </div>

        <!-- Bookings List -->
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold text-dark mb-0">Booking Inquiries</h4>
                <span class="text-muted small">Showing {{ $bookings->count() }} of {{ $bookings->total() }}</span>
            </div>

            @if($bookings->isEmpty())
                <div class="card border-0 shadow-sm rounded-4 text-center p-5">
                    <div class="py-4">
                        <div class="display-3 text-muted mb-3 opacity-50"><i class="fas fa-suitcase-rolling"></i></div>
                        <h4 class="fw-bold text-dark">No Tour Bookings Yet</h4>
                        <p class="text-muted mx-auto mb-4" style="max-width: 480px;">
                            You haven't requested any tour bookings yet. Explore our premier Bangladesh–Japan travel packages and start your adventure today!
                        </p>
                        <a href="{{ route('tours.index') }}" class="btn theme-btn px-4 py-2">
                            Browse Tour Packages <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            @else
                <div class="d-flex flex-column gap-3">
                    @foreach($bookings as $booking)
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                            <div class="card-body p-4">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                                            <span class="badge bg-dark px-2 py-1 rounded font-monospace" style="letter-spacing: 0.5px;">{{ $booking->booking_reference }}</span>
                                            
                                            @if($booking->status === 'confirmed')
                                                <span class="badge bg-success text-white px-2 py-1 rounded-pill"><i class="fas fa-check-circle me-1"></i> Confirmed</span>
                                            @elseif($booking->status === 'cancelled')
                                                <span class="badge bg-danger text-white px-2 py-1 rounded-pill"><i class="fas fa-times-circle me-1"></i> Cancelled</span>
                                            @elseif($booking->status === 'contacted')
                                                <span class="badge bg-info text-white px-2 py-1 rounded-pill"><i class="fas fa-phone-alt me-1"></i> In Discussion</span>
                                            @else
                                                <span class="badge bg-warning text-dark px-2 py-1 rounded-pill"><i class="fas fa-hourglass-half me-1"></i> Under Review</span>
                                            @endif

                                            <span class="text-muted small ms-auto d-none d-sm-inline">
                                                <i class="far fa-calendar-alt me-1"></i> Booked {{ $booking->created_at->format('d M, Y') }}
                                            </span>
                                        </div>

                                        <h5 class="fw-bold mb-2">
                                            @if($booking->tour)
                                                <a href="{{ route('tours.show', $booking->tour->slug) }}" class="text-dark text-decoration-none hover-primary">
                                                    {{ $booking->tour->title }}
                                                </a>
                                            @else
                                                <span class="text-dark">{{ $booking->destination_interest ?? 'Custom Tour Request' }}</span>
                                            @endif
                                        </h5>

                                        <div class="d-flex flex-wrap gap-3 text-muted small mt-2">
                                            @if($booking->departure_date)
                                                <span><i class="far fa-calendar-check text-success me-1"></i> Departs: <strong>{{ \Carbon\Carbon::parse($booking->departure_date)->format('d M, Y') }}</strong></span>
                                            @endif
                                            <span><i class="fas fa-user-friends text-primary me-1"></i> {{ $booking->adults_count }} Adult{{ $booking->adults_count > 1 ? 's' : '' }} @if($booking->children_count > 0), {{ $booking->children_count }} Child{{ $booking->children_count > 1 ? 'ren' : '' }} @endif</span>
                                            @if($booking->tour && $booking->tour->starting_price)
                                                <span><i class="fas fa-tag text-warning me-1"></i> ৳{{ number_format($booking->tour->starting_price * max(1, $booking->adults_count)) }} est.</span>
                                            @endif
                                        </div>

                                        @if($booking->special_requests)
                                            <p class="text-muted small mt-2 mb-0 bg-light p-2 rounded border-start border-3 border-success">
                                                <em>"{{ Str::limit($booking->special_requests, 100) }}"</em>
                                            </p>
                                        @endif
                                    </div>

                                    <div class="col-md-4 text-md-end mt-3 mt-md-0 border-top border-md-top-0 pt-3 pt-md-0">
                                        <div class="d-flex flex-column gap-2">
                                            <a href="{{ route('bookings.voucher', $booking->booking_reference) }}" class="btn btn-outline-success btn-sm rounded-pill py-2 px-3 fw-bold" target="_blank">
                                                <i class="fas fa-file-invoice me-1"></i> Tour Voucher
                                            </a>
                                            <a href="https://wa.me/+8801577509112?text={{ urlencode('Hello Bongo Tanbo, I am inquiring regarding my booking reference: ' . $booking->booking_reference) }}" target="_blank" rel="noopener" class="btn btn-sm btn-light border rounded-pill py-2 px-3 text-success fw-semibold">
                                                <i class="fab fa-whatsapp me-1"></i> WhatsApp Support
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $bookings->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<!-- @endsection -->
