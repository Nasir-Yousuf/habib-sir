@extends('layouts.public')

@section('title', $tour->title . ' | Bongo Tanbo Travels')
@section('meta_description', Str::limit(strip_tags($tour->overview), 160))
@section('meta_image', asset($tour->featured_image ?? 'assets/images/package-1.webp'))

@section('extra_css')
<!-- JSON-LD Structured Data for Tour -->
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "TouristTrip",
  "name": "{{ $tour->title }}",
  "description": "{{ Str::limit(strip_tags($tour->overview), 160) }}",
  "touristType": "{{ $tour->category->name ?? 'General' }}",
  "offers": {
    "@@type": "Offer",
    "price": "{{ $tour->starting_price ?? 'Contact for price' }}",
    "priceCurrency": "BDT"
  }
}
</script>
@endsection

@section('content')
<!-- Page Banner Header -->
<div class="page-banner bg-dark text-white py-5 position-relative" style="background: linear-gradient(rgba(14,27,39,0.85), rgba(14,27,39,0.85)), url('{{ asset($tour->featured_image ?? 'assets/images/sundorbon.png') }}') center/cover;">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-lg-8">
                @if($tour->badge_text)
                    <span class="badge px-3 py-2 rounded-pill fs-7 fw-bold mb-2 text-white" style="background-color: #809e40;">{{ $tour->badge_text }}</span>
                @endif
                <h1 class="display-6 fw-bold text-white mb-3">{{ $tour->title }}</h1>
                <div class="d-flex flex-wrap gap-4 text-white-50 fs-7">
                    <span><i class="far fa-clock text-success me-1"></i> {{ $tour->duration_days }} Days @if($tour->duration_nights)/ {{ $tour->duration_nights }} Nights @endif</span>
                    <span><i class="fas fa-map-marker-alt text-danger me-1"></i> {{ $tour->places_count }} Key Destinations</span>
                    <span><i class="fas fa-mountain text-warning me-1"></i> Difficulty: {{ $tour->difficulty }}</span>
                    @if($tour->category)
                        <span><i class="fas fa-tag text-info me-1"></i> {{ $tour->category->name }}</span>
                    @endif
                </div>
            </div>
            <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                @if($tour->starting_price)
                    <div class="bg-white p-3 rounded-4 shadow-sm d-inline-block text-dark text-center">
                        <span class="text-muted fs-7 d-block">Starting from</span>
                        <span class="fs-4 fw-bold text-success">৳{{ number_format($tour->starting_price) }}</span>
                        <span class="fs-8 text-muted d-block">per person</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Tour Details Body -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="row g-5">
            <!-- Left Main Column -->
            <div class="col-lg-8">
                <!-- Overview Card -->
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white mb-4">
                    <h3 class="fw-bold mb-3"><i class="fas fa-info-circle text-success me-2"></i> Tour Overview</h3>
                    <div class="text-muted leading-relaxed fs-6">
                        {!! nl2br(e($tour->overview)) !!}
                    </div>
                </div>

                <!-- Day-by-Day Itinerary Accordion -->
                @if($tour->itineraries->count() > 0)
                    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white mb-4">
                        <h3 class="fw-bold mb-4"><i class="fas fa-route text-success me-2"></i> Day-by-Day Itinerary</h3>
                        <div class="accordion" id="itineraryAccordion">
                            @foreach($tour->itineraries as $index => $item)
                                <div class="accordion-item border rounded-3 mb-3 overflow-hidden shadow-none">
                                    <h2 class="accordion-header" id="heading{{ $item->id }}">
                                        <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }} fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $item->id }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $item->id }}">
                                            <span class="badge bg-success bg-opacity-10 text-success me-3 px-2 py-1">Day {{ $item->day_number }}</span>
                                            {{ $item->title }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $item->id }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="heading{{ $item->id }}" data-bs-parent="#itineraryAccordion">
                                        <div class="accordion-body text-muted leading-relaxed">
                                            <p class="mb-3">{{ $item->description }}</p>
                                            <div class="d-flex flex-wrap gap-4 pt-2 border-top fs-7 text-dark">
                                                @if($item->accommodation)
                                                    <div><i class="fas fa-hotel text-success me-1"></i> <b>Stay:</b> {{ $item->accommodation }}</div>
                                                @endif
                                                @if($item->meals)
                                                    <div><i class="fas fa-utensils text-success me-1"></i> <b>Meals:</b> {{ $item->meals }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Inclusions & Exclusions -->
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white mb-4">
                    <h3 class="fw-bold mb-4"><i class="fas fa-clipboard-check text-success me-2"></i> Inclusions &amp; Exclusions</h3>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <h5 class="fw-bold text-success mb-3"><i class="fas fa-check-circle me-1"></i> What's Included</h5>
                            <ul class="list-unstyled ps-0 mb-0">
                                @if(is_array($tour->inclusions))
                                    @foreach($tour->inclusions as $inc)
                                        <li class="mb-2 text-muted d-flex align-items-start">
                                            <i class="fas fa-check text-success me-2 mt-1"></i> {{ $inc }}
                                        </li>
                                    @endforeach
                                @else
                                    <li class="text-muted">Standard transportation, licensed guide, accommodation, entry tickets.</li>
                                @endif
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h5 class="fw-bold text-danger mb-3"><i class="fas fa-times-circle me-1"></i> What's Excluded</h5>
                            <ul class="list-unstyled ps-0 mb-0">
                                @if(is_array($tour->exclusions))
                                    @foreach($tour->exclusions as $exc)
                                        <li class="mb-2 text-muted d-flex align-items-start">
                                            <i class="fas fa-times text-danger me-2 mt-1"></i> {{ $exc }}
                                        </li>
                                    @endforeach
                                @else
                                    <li class="text-muted">International flights, personal expenses, alcoholic beverages, travel insurance.</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Sticky Sidebar -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 100px;">
                    <!-- Direct Inquiry / Booking Card -->
                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
                        <h4 class="fw-bold mb-3 text-dark">Book / Inquire Tour</h4>
                        <p class="text-muted fs-7 mb-3">Submit your preferred dates and our specialist will confirm availability and custom requests.</p>

                        <form action="{{ route('bookings.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="tour_id" value="{{ $tour->id }}">
                            <input type="hidden" name="destination_interest" value="{{ $tour->title }}">

                            <div class="mb-3">
                                <label class="form-label fs-7 fw-bold text-muted">Your Full Name *</label>
                                <input type="text" name="customer_name" class="form-control rounded-3" placeholder="John Doe" required value="{{ old('customer_name') }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fs-7 fw-bold text-muted">Email Address *</label>
                                <input type="email" name="customer_email" class="form-control rounded-3" placeholder="name@domain.com" required value="{{ old('customer_email') }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fs-7 fw-bold text-muted">Phone / WhatsApp *</label>
                                <input type="text" name="customer_phone" class="form-control rounded-3" placeholder="+8801..." required value="{{ old('customer_phone') }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fs-7 fw-bold text-muted">Departure Date</label>
                                <input type="date" name="departure_date" class="form-control rounded-3" value="{{ old('departure_date') }}">
                            </div>

                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <label class="form-label fs-7 fw-bold text-muted">Adults</label>
                                    <input type="number" name="adults_count" class="form-control rounded-3" min="1" max="50" value="{{ old('adults_count', 1) }}">
                                </div>
                                <div class="col-6">
                                    <label class="form-label fs-7 fw-bold text-muted">Children</label>
                                    <input type="number" name="children_count" class="form-control rounded-3" min="0" max="50" value="{{ old('children_count', 0) }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fs-7 fw-bold text-muted">Special Requests / Questions</label>
                                <textarea name="special_requests" class="form-control rounded-3" rows="3" placeholder="Dietary needs, hotel preference...">{{ old('special_requests') }}</textarea>
                            </div>

                            <button type="submit" class="theme-btn w-100 py-3 justify-content-center">
                                <span>Send Tour Inquiry</span> <i class="far fa-paper-plane ms-2"></i>
                            </button>
                        </form>
                    </div>

                    <!-- Direct Help Box -->
                    <div class="card border-0 shadow-sm rounded-4 p-4 text-white" style="background-color: #0e1b27;">
                        <h5 class="fw-bold text-white mb-2"><i class="fas fa-headset text-success me-2"></i> Need Instant Assistance?</h5>
                        <p class="text-white-50 fs-7 mb-3">Speak directly with our Dhaka or Fukuoka travel coordinators via WhatsApp or phone.</p>
                        <div class="d-flex flex-column gap-2 fs-7 text-white-50">
                            <div><i class="fab fa-whatsapp text-success me-2"></i> +8801577509112</div>
                            <div><i class="fas fa-phone text-success me-2"></i> +88028991482</div>
                            <div><i class="far fa-envelope text-success me-2"></i> bongotanbo@gmail.com</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Tours Row -->
        @if($relatedTours->count() > 0)
            <div class="mt-5 pt-4">
                <h3 class="fw-bold mb-4">You May Also Like</h3>
                <div class="row g-4">
                    @foreach($relatedTours as $rel)
                        <div class="col-md-4">
                            @include('components.tour-card', ['tour' => $rel])
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
