@extends('layouts.public')

@section('title', 'Contact Us | Bangladesh & Japan Offices | Bongo Tanbo Travels')
@section('meta_description', 'Contact Bongo Tanbo Travels via our Dhaka or Fukuoka offices. Inquire about custom tours, group travel, visas, and holiday bookings.')

@section('content')
<!-- Page Banner -->
<div class="page-banner bg-dark text-white py-5 position-relative" style="background: linear-gradient(rgba(14,27,39,0.85), rgba(14,27,39,0.85)), url('{{ asset('assets/images/hero-coxs-bazar.jpg') }}') center/cover;">
    <div class="container py-4 text-center">
        <h1 class="display-5 fw-bold text-white mb-2">Contact Bongo Tanbo Travels</h1>
        <p class="lead text-white-50 mb-0">We Are Ready to Plan Your Lifetime Journey</p>
        <nav aria-label="breadcrumb" class="mt-3">
            <ol class="breadcrumb justify-content-center text-white-50">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Contact</li>
            </ol>
        </nav>
    </div>
</div>

<section class="section-padding bg-light">
    <div class="container">
        <!-- Dual Office Cards -->
        <div class="row g-4 mb-5">
            <!-- Bangladesh Office -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 h-100 bg-white">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <img src="{{ asset('assets/images/flag-bd.png') }}" alt="Bangladesh Flag" width="36" class="rounded shadow-sm">
                        <div>
                            <h3 class="fs-4 fw-bold mb-0">Bangladesh Liaison Office</h3>
                            <span class="text-muted fs-7">Uttara, Dhaka</span>
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-3 text-muted fs-6">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-map-marker-alt text-success me-3 mt-1 fs-5"></i>
                            <div>
                                <b>Address:</b><br />
                                Nipobon (First Floor) House No. 6, Road No. 8, Sector 11, Uttara, Dhaka 1230.
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-phone text-success me-3 fs-5"></i>
                            <div>
                                <b>Landline:</b> <a href="tel:+88028991482" class="text-decoration-none text-muted">+88028991482</a>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fab fa-whatsapp text-success me-3 fs-5"></i>
                            <div>
                                <b>WhatsApp:</b> <a href="https://wa.me/8801577509112" class="text-decoration-none text-muted">+8801612320995 | +8801577509112</a>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-envelope text-success me-3 fs-5"></i>
                            <div>
                                <b>Email:</b> <a href="mailto:bongotanbo@gmail.com" class="text-decoration-none text-muted">bongotanbo@gmail.com</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Japan Office -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 h-100 bg-white">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <img src="{{ asset('assets/images/flag-jp.png') }}" alt="Japan Flag" width="36" class="rounded shadow-sm">
                        <div>
                            <h3 class="fs-4 fw-bold mb-0">Japan Headquarters</h3>
                            <span class="text-muted fs-7">Fukuoka City</span>
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-3 text-muted fs-6">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-map-marker-alt text-success me-3 mt-1 fs-5"></i>
                            <div>
                                <b>Address:</b><br />
                                Fukuoka Ken Fukuoka City Chuo-ku-Kego 2-9-10-201 Japan.
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-phone text-success me-3 fs-5"></i>
                            <div>
                                <b>Phone:</b> <span class="text-muted">81-90-714-0758</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-mobile-alt text-success me-3 fs-5"></i>
                            <div>
                                <b>Mobile / WhatsApp:</b> <a href="tel:819029324271" class="text-decoration-none text-muted">81-90-2932-4271</a>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-envelope text-success me-3 fs-5"></i>
                            <div>
                                <b>Email:</b> <a href="mailto:hyderlemon@gmail.com" class="text-decoration-none text-muted">hyderlemon@gmail.com</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Form & Map Row -->
        <div class="row g-5">
            <!-- Left: Interactive Form -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                    <h3 class="fw-bold mb-2">Send Us a Message</h3>
                    <p class="text-muted fs-7 mb-4">Have questions about an itinerary, visa assistance, or custom family quote? Fill out the form below.</p>

                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fs-7 fw-bold text-muted">Your Name *</label>
                                <input type="text" name="name" class="form-control rounded-3" placeholder="John Doe" required value="{{ old('name') }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fs-7 fw-bold text-muted">Email Address *</label>
                                <input type="email" name="email" class="form-control rounded-3" placeholder="name@domain.com" required value="{{ old('email') }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fs-7 fw-bold text-muted">Phone Number</label>
                                <input type="text" name="phone" class="form-control rounded-3" placeholder="+8801..." value="{{ old('phone') }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fs-7 fw-bold text-muted">Subject / Preferred Tour</label>
                                <input type="text" name="subject" class="form-control rounded-3" placeholder="e.g. Sundarbans Family Tour" value="{{ old('subject') }}">
                            </div>

                            <div class="col-12">
                                <label class="form-label fs-7 fw-bold text-muted">Your Message *</label>
                                <textarea name="message" class="form-control rounded-3" rows="5" placeholder="Tell us about your travel dates, number of people, or questions..." required>{{ old('message') }}</textarea>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="theme-btn py-3 px-4">
                                    <span>Submit Message</span> <i class="far fa-paper-plane ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right: Office Map Embed -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 bg-white">
                    <div class="p-4 border-bottom">
                        <h4 class="fw-bold mb-1">Our Location in Dhaka</h4>
                        <p class="text-muted fs-7 mb-0">Sector 11, Uttara, Dhaka 1230</p>
                    </div>
                    <div class="ratio ratio-4x3 h-100">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3648.3378415712175!2d90.38459467605923!3d23.87760638387088!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c4779836a991%3A0xc34579d4791a82d7!2sSector%2011%2C%20Uttara%2C%20Dhaka%201230!5e0!3m2!1sen!2sbd!4v1700000000000!5m2!1sen!2sbd" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Bongo Tanbo Travels Dhaka Office Location">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
