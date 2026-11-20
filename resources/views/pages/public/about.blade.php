@extends('layouts.public')

@section('title', 'About Us | Bangladesh & Japan Joint Venture | Bongo Tanbo Travels')
@section('meta_description', 'Discover Bongo Tanbo Travels: our Bangladesh-Japan partnership, government registered accreditation, and dedication to unforgettable travel.')

@section('content')
<!-- Page Header Banner -->
<div class="page-banner bg-dark text-white py-5 position-relative" style="background: linear-gradient(rgba(14,27,39,0.8), rgba(14,27,39,0.8)), url('{{ asset('assets/images/sundorbon.png') }}') center/cover;">
    <div class="container py-4 text-center">
        <h1 class="display-5 fw-bold text-white mb-2">About Bongo Tanbo Travels</h1>
        <p class="lead text-white-50 mb-0">A Bridge of Warm Hospitality &amp; Precision</p>
        <nav aria-label="breadcrumb" class="mt-3">
            <ol class="breadcrumb justify-content-center text-white-50">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">About Us</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Story & Joint Venture Connection -->
<section class="section-padding">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <div class="position-relative">
                    <img src="{{ asset('assets/images/about-img.webp') }}" alt="About Bongo Tanbo" class="img-fluid rounded-4 shadow-lg w-100">
                    <div class="position-absolute bottom-0 start-0 m-4 p-3 bg-white rounded-3 shadow text-center" style="max-width: 180px;">
                        <span class="fs-2 fw-bold text-success d-block">12+</span>
                        <span class="fs-7 text-muted fw-semibold">Years of Global Travel Excellence</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fs-7 fw-bold mb-2">OUR HERITAGE</span>
                <h2 class="display-6 fw-bold mb-4">Blending Bangladeshi Warmth with Japanese Excellence</h2>
                <p class="text-muted leading-relaxed">
                    Bongo Tanbo Travels was established as a premier <b>Bangladesh–Japan joint venture</b> with a clear mission: to showcase the breathtaking biodiversity, historical splendor, and cultural warmth of Bangladesh to global travelers, while providing Bangladeshi holidaymakers with meticulously planned journeys to Japan and beyond.
                </p>
                <div class="border-start border-4 border-success ps-3 my-4 py-1" style="background-color: #f1f7f1;">
                    <p class="fst-italic text-dark mb-0 fw-semibold">
                        “Bangladeshi hospitality and Japanese precision make every journey a lifetime memory.”
                    </p>
                </div>
                <p class="text-muted leading-relaxed">
                    Our dual headquarters in <b>Fukuoka, Japan</b> and <b>Uttara, Dhaka, Bangladesh</b> allow us to maintain direct relationships with airlines, top eco-resorts, local community leaders, and government agencies. We eliminate middle-agents, ensuring unmatched accountability, safety, and authenticity.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Government Verification Block -->
<section class="py-5" style="background-color: #f8fafc;">
    <div class="container">
        <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
            <div class="row align-items-center g-4">
                <div class="col-md-3 text-center">
                    <a href="https://btbregistration.gov.bd/to-company-info/Nzc/bongo-tanbo-travels" target="_blank" rel="noopener">
                        <img src="{{ asset('assets/images/btb-logo.png') }}" alt="BTB Logo" class="img-fluid" style="max-height: 100px;">
                    </a>
                </div>
                <div class="col-md-9">
                    <span class="badge bg-danger text-white px-2 py-1 mb-2">Official Government Certification</span>
                    <h3 class="fw-bold mb-2">Registered Tour Operator — Bangladesh Tourism Board (BTB)</h3>
                    <p class="text-muted mb-3">
                        Bongo Tanbo Travels is an accredited, government-licensed travel entity verified under record ID <b>Nzc</b> with the Ministry of Civil Aviation and Tourism. Your safety, financial security, and service standards are backed by official regulatory compliance.
                    </p>
                    <a href="https://btbregistration.gov.bd/to-company-info/Nzc/bongo-tanbo-travels" target="_blank" rel="noopener" class="btn btn-outline-success rounded-pill px-4">
                        <i class="fas fa-external-link-alt me-1"></i> Verify Official BTB License Record
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us Grid -->
<section class="section-padding">
    <div class="container">
        <div class="text-center mb-5">
            <span class="sub-title text-success fw-bold">OUR COMMITMENT</span>
            <h2 class="fw-bold">Why Travel With Us?</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="p-4 border rounded-4 h-100 shadow-sm hover-lift bg-white">
                    <div class="fs-1 text-success mb-3"><i class="fas fa-shield-alt"></i></div>
                    <h4 class="fs-5 fw-bold">Safety & Precision</h4>
                    <p class="text-muted mb-0">Every vehicle, vessel, hotel, and guide is rigorously vetted according to Japanese safety benchmarks.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 border rounded-4 h-100 shadow-sm hover-lift bg-white">
                    <div class="fs-1 text-success mb-3"><i class="fas fa-heart"></i></div>
                    <h4 class="fs-5 fw-bold">Genuine Local Immersion</h4>
                    <p class="text-muted mb-0">We take you beyond ordinary tourist stops into tea plucking villages, artisan potteries, and tribal hamlets.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 border rounded-4 h-100 shadow-sm hover-lift bg-white">
                    <div class="fs-1 text-success mb-3"><i class="fas fa-clock"></i></div>
                    <h4 class="fs-5 fw-bold">24/7 Dedicated Support</h4>
                    <p class="text-muted mb-0">Our bilingual customer assistance coordinators in Dhaka and Fukuoka support you at every milestone.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
