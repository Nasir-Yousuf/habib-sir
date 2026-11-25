@extends('layouts.public')

@section('title', 'Discover Unique Travel Experiences | Bongo Tanbo Travels')
@section('meta_description', 'Bongo Tanbo Travels is a Bangladesh-Japan joint venture travel agency offering tailor-made inbound, outbound, cultural, and eco tours.')

@section('content')
<!-- ==========================================================================
   SECTION 1: HERO SLIDER SECTION
   - Bootstrap 5 Carousel
   - 4 Static iconic images: Sundarbans, Tea Garden, Kaptai Lake, Cox's Bazar
   - Floating animated planes
   - Custom long arrow controls
========================================================================== -->
<section class="hero-section" id="hero">
    <!-- Carousel Controls Arrows -->
    <div class="hero-slider-nav">
        <button class="slider-arrow-btn" id="heroPrevBtn" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev" aria-label="Previous Slide">
            <i class="fas fa-long-arrow-alt-left"></i>
        </button>
        <button class="slider-arrow-btn" id="heroNextBtn" type="button" data-bs-target="#heroCarousel" data-bs-slide="next" aria-label="Next Slide">
            <i class="fas fa-long-arrow-alt-right"></i>
        </button>
    </div>

    <!-- Carousel Container -->
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="6000">
        <!-- Indicators -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
        </div>

        <div class="carousel-inner">
            <!-- SLIDE 1: SUNDARBANS -->
            <div class="carousel-item active">
                <div class="hero-slider-item" style="background-image: url('{{ asset('assets/images/sundorbon.png') }}');">
                    <div class="plane-shape-1"><img src="{{ asset('assets/images/plane-2.png') }}" alt="Airplane"></div>
                    <div class="plane-shape-2"><img src="{{ asset('assets/images/plane-3.png') }}" alt="Airplane"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-10">
                                <div class="hero-content">
                                    <span class="hero-badge">UNESCO World Heritage Site</span>
                                    <h1 class="hero-title"><span class="shape-text">The</span> <span>Sundarbans</span></h1>
                                    <p class="hero-desc">Explore the world's largest mangrove forest, home of the majestic Royal Bengal Tiger, mystical waterways, and unspoiled wilderness.</p>
                                    <a href="{{ route('tours.index', ['destination' => 'sundarbans']) }}" class="theme-btn">
                                        <span>Explore Tours</span> <i class="fas fa-long-arrow-alt-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SLIDE 2: TEA GARDEN -->
            <div class="carousel-item">
                <div class="hero-slider-item" style="background-image: url('{{ asset('assets/images/tea-garden.png') }}');">
                    <div class="plane-shape-1"><img src="{{ asset('assets/images/plane-2.png') }}" alt="Airplane"></div>
                    <div class="plane-shape-2"><img src="{{ asset('assets/images/plane-3.png') }}" alt="Airplane"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-10">
                                <div class="hero-content">
                                    <span class="hero-badge">Emerald Rolling Hills</span>
                                    <h1 class="hero-title"><span class="shape-text">Tea</span> <span>Garden</span></h1>
                                    <p class="hero-desc">Immerse yourself in Srimangal’s lush green rolling hills, aromatic estates, indigenous cultures, and tranquil rainforest sanctuaries.</p>
                                    <a href="{{ route('tours.index', ['destination' => 'srimangal']) }}" class="theme-btn">
                                        <span>Discover Sylhet</span> <i class="fas fa-long-arrow-alt-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SLIDE 3: KAPTAI LAKE -->
            <div class="carousel-item">
                <div class="hero-slider-item" style="background-image: url('{{ asset('assets/images/kaptai-lake.png') }}');">
                    <div class="plane-shape-1"><img src="{{ asset('assets/images/plane-2.png') }}" alt="Airplane"></div>
                    <div class="plane-shape-2"><img src="{{ asset('assets/images/plane-3.png') }}" alt="Airplane"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-10">
                                <div class="hero-content">
                                    <span class="hero-badge">Serene Hill Tracts</span>
                                    <h1 class="hero-title"><span class="shape-text">Kaptai</span> <span>Lake</span></h1>
                                    <p class="hero-desc">Sail through turquoise waters embraced by emerald peaks in Rangamati, witnessing vibrant tribal lifestyle and magical sunsets.</p>
                                    <a href="{{ route('tours.index', ['destination' => 'rangamati']) }}" class="theme-btn">
                                        <span>Plan Lake Tour</span> <i class="fas fa-long-arrow-alt-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SLIDE 4: COX'S BAZAR -->
            <div class="carousel-item">
                <div class="hero-slider-item" style="background-image: url('{{ asset('assets/images/hero-coxs-bazar.jpg') }}');">
                    <div class="plane-shape-1"><img src="{{ asset('assets/images/plane-2.png') }}" alt="Airplane"></div>
                    <div class="plane-shape-2"><img src="{{ asset('assets/images/plane-3.png') }}" alt="Airplane"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-10">
                                <div class="hero-content">
                                    <span class="hero-badge">Longest Natural Sea Beach</span>
                                    <h1 class="hero-title"><span class="shape-text">Cox’s</span> <span>Bazar</span></h1>
                                    <p class="hero-desc">Feel the golden sand under your feet across 120 uninterrupted kilometers of gentle waves, coastal seafood, and marine breezes.</p>
                                    <a href="{{ route('tours.index', ['destination' => 'coxs-bazar']) }}" class="theme-btn">
                                        <span>Book Beach Escape</span> <i class="fas fa-long-arrow-alt-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
   FLOATING BOOKING & SEARCH FILTER BAR
========================================================================== -->
@include('components.booking-filter')

<!-- ==========================================================================
   SECTION 2: BANGLADESH SHOWCASE ("A RIVERINE COUNTRY")
========================================================================== -->
<section class="bdt-intro-section" id="riverine-section">
    <div class="container">
        <div class="bdt-intro-inner">
            <div class="bdt-intro-label">
                <span class="bd-flag-icon"></span>
                <span>Bangladesh</span>
            </div>

            <h2 class="bdt-intro-heading">
                <span class="bdt-title-main">A Riverine</span><br />
                <span class="bdt-title-cursive">Country</span>
            </h2>

            <p class="bdt-intro-text">
                Bangladesh, located in South Asia, is a beautiful riverine country blessed with natural diversity and cultural richness. Surrounded by India and Myanmar and bordered by the Bay of Bengal, it covers about <b>147,570 square kilometers</b> and is home to over <b>170 million people</b>. The capital, Dhaka, is a bustling hub of business and culture. Bangladesh is known for its green landscape, fertile plains, vibrant traditions, and friendly people.
            </p>

            <!-- 3 Stat Cards -->
            <div class="bdt-intro-stats">
                <div class="bdt-intro-stat-card">
                    <div class="bdt-intro-stat-icon"><i class="fas fa-map-marked-alt"></i></div>
                    <div>
                        <div class="bdt-intro-stat-val">147,570 km²</div>
                        <div class="bdt-intro-stat-lbl">Total area</div>
                    </div>
                </div>

                <div class="bdt-intro-stat-card">
                    <div class="bdt-intro-stat-icon"><i class="fas fa-users"></i></div>
                    <div>
                        <div class="bdt-intro-stat-val">170 Million+</div>
                        <div class="bdt-intro-stat-lbl">Population</div>
                    </div>
                </div>

                <div class="bdt-intro-stat-card">
                    <div class="bdt-intro-stat-icon"><i class="fas fa-city"></i></div>
                    <div>
                        <div class="bdt-intro-stat-val">Dhaka</div>
                        <div class="bdt-intro-stat-lbl">Capital city</div>
                    </div>
                </div>
            </div>

            <!-- Tags & CTA -->
            <div class="bdt-intro-bottom">
                <div class="bdt-intro-tags">
                    <span class="bdt-intro-tag">Green Landscape</span>
                    <span class="bdt-intro-tag">Fertile Plains</span>
                    <span class="bdt-intro-tag">Bay of Bengal</span>
                    <span class="bdt-intro-tag">Vibrant Culture</span>
                    <span class="bdt-intro-tag">Friendly People</span>
                </div>

                <a href="{{ route('about') }}" class="bdt-intro-btn">
                    <span>Read More</span> <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
   SECTION 3: ABOUT US SECTION
========================================================================== -->
<section class="about-section" id="about-section">
    <div class="about-shape-bg d-none d-lg-block">
        <img src="{{ asset('assets/images/about-shape.webp') }}" alt="Background shape" loading="lazy" decoding="async">
    </div>

    <div class="container">
        <div class="row g-5 align-items-center">
            <!-- Left Column: Photo & Experience Counter -->
            <div class="col-lg-5">
                <div class="about-image-wrapper">
                    <img src="{{ asset('assets/images/about-img.webp') }}" alt="Bongo Tanbo Travels Journey" class="main-about-img" loading="lazy" decoding="async">
                    <div class="about-experience-box">
                        <h2><span class="counter-value" data-count="12">12</span>+</h2>
                        <p>Years of Experience</p>
                    </div>
                </div>
            </div>

            <!-- Right Column: Story & Features -->
            <div class="col-lg-7">
                <div class="about-content-wrapper">
                    <div class="section-title mb-3">
                        <span class="sub-title">About Us</span>
                        <h2>A Bridge of Warm Hospitality &amp; Precision</h2>
                    </div>

                    <p class="text-muted">
                        Bongo Tanbo Travels established as a <b>Bangladesh–Japan joint venture</b> is a trusted name in the travel and tourism industry. We combine global expertise, cultural understanding, and professional excellence to deliver seamless travel experiences across Bangladesh, Japan, and beyond.
                    </p>

                    <div class="about-tagline-quote">
                        <h5>“Bangladeshi hospitality and Japanese precision make every journey a lifetime memory.”</h5>
                    </div>

                    <!-- Checklist -->
                    <div class="row">
                        <div class="col-sm-6">
                            <ul class="about-features-list">
                                <li>
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M23.1 4.5L13.9 13.8C13.3 14.3 12.6 14.6 11.8 14.6C11.7 14.6 11.7 14.6 11.7 14.6C10.9 14.6 10.1 14.2 9.6 13.6L7 10.3C6.7 9.9 6.8 9.3 7.2 8.9C7.6 8.6 8.2 8.7 8.5 9.1L11.1 12.3C11.3 12.5 11.5 12.7 11.8 12.7C12 12.7 12.3 12.6 12.5 12.4L21.7 3.2C22.1 2.8 22.8 2.8 23.1 3.2C23.5 3.5 23.5 4.2 23.1 4.5Z" fill="#809e40"/><path d="M20.1 12.8C19.9 15.3 18.7 17.6 16.9 19.2C15.2 20.8 12.9 21.8 10.4 21.8C5 21.8 0.6 17.4 0.6 12C0.6 6.6 5 2.2 10.4 2.2C12.6 2.2 14.9 3.1 16.6 4.5C17 4.9 17.1 5.5 16.8 5.9C16.4 6.3 15.8 6.4 15.4 6C12.1 3.3 7.1 3.7 4.4 7C1.6 10.3 2 15.2 5.3 18C8.7 20.8 13.6 20.3 16.3 17C17.4 15.8 18 14.3 18.1 12.7C18.2 12.1 18.6 11.7 19.2 11.8C19.7 11.8 20.1 12.3 20.1 12.8Z" fill="#809e40"/></svg>
                                    <span>Trusted local travel experts</span>
                                </li>
                                <li>
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M23.1 4.5L13.9 13.8C13.3 14.3 12.6 14.6 11.8 14.6C11.7 14.6 11.7 14.6 11.7 14.6C10.9 14.6 10.1 14.2 9.6 13.6L7 10.3C6.7 9.9 6.8 9.3 7.2 8.9C7.6 8.6 8.2 8.7 8.5 9.1L11.1 12.3C11.3 12.5 11.5 12.7 11.8 12.7C12 12.7 12.3 12.6 12.5 12.4L21.7 3.2C22.1 2.8 22.8 2.8 23.1 3.2C23.5 3.5 23.5 4.2 23.1 4.5Z" fill="#809e40"/><path d="M20.1 12.8C19.9 15.3 18.7 17.6 16.9 19.2C15.2 20.8 12.9 21.8 10.4 21.8C5 21.8 0.6 17.4 0.6 12C0.6 6.6 5 2.2 10.4 2.2C12.6 2.2 14.9 3.1 16.6 4.5C17 4.9 17.1 5.5 16.8 5.9C16.4 6.3 15.8 6.4 15.4 6C12.1 3.3 7.1 3.7 4.4 7C1.6 10.3 2 15.2 5.3 18C8.7 20.8 13.6 20.3 16.3 17C17.4 15.8 18 14.3 18.1 12.7C18.2 12.1 18.6 11.7 19.2 11.8C19.7 11.8 20.1 12.3 20.1 12.8Z" fill="#809e40"/></svg>
                                    <span>Many years of experience</span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <ul class="about-features-list">
                                <li>
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M23.1 4.5L13.9 13.8C13.3 14.3 12.6 14.6 11.8 14.6C11.7 14.6 11.7 14.6 11.7 14.6C10.9 14.6 10.1 14.2 9.6 13.6L7 10.3C6.7 9.9 6.8 9.3 7.2 8.9C7.6 8.6 8.2 8.7 8.5 9.1L11.1 12.3C11.3 12.5 11.5 12.7 11.8 12.7C12 12.7 12.3 12.6 12.5 12.4L21.7 3.2C22.1 2.8 22.8 2.8 23.1 3.2C23.5 3.5 23.5 4.2 23.1 4.5Z" fill="#809e40"/><path d="M20.1 12.8C19.9 15.3 18.7 17.6 16.9 19.2C15.2 20.8 12.9 21.8 10.4 21.8C5 21.8 0.6 17.4 0.6 12C0.6 6.6 5 2.2 10.4 2.2C12.6 2.2 14.9 3.1 16.6 4.5C17 4.9 17.1 5.5 16.8 5.9C16.4 6.3 15.8 6.4 15.4 6C12.1 3.3 7.1 3.7 4.4 7C1.6 10.3 2 15.2 5.3 18C8.7 20.8 13.6 20.3 16.3 17C17.4 15.8 18 14.3 18.1 12.7C18.2 12.1 18.6 11.7 19.2 11.8C19.7 11.8 20.1 12.3 20.1 12.8Z" fill="#809e40"/></svg>
                                    <span>Flexible, hassle-free booking</span>
                                </li>
                                <li>
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M23.1 4.5L13.9 13.8C13.3 14.3 12.6 14.6 11.8 14.6C11.7 14.6 11.7 14.6 11.7 14.6C10.9 14.6 10.1 14.2 9.6 13.6L7 10.3C6.7 9.9 6.8 9.3 7.2 8.9C7.6 8.6 8.2 8.7 8.5 9.1L11.1 12.3C11.3 12.5 11.5 12.7 11.8 12.7C12 12.7 12.3 12.6 12.5 12.4L21.7 3.2C22.1 2.8 22.8 2.8 23.1 3.2C23.5 3.5 23.5 4.2 23.1 4.5Z" fill="#809e40"/><path d="M20.1 12.8C19.9 15.3 18.7 17.6 16.9 19.2C15.2 20.8 12.9 21.8 10.4 21.8C5 21.8 0.6 17.4 0.6 12C0.6 6.6 5 2.2 10.4 2.2C12.6 2.2 14.9 3.1 16.6 4.5C17 4.9 17.1 5.5 16.8 5.9C16.4 6.3 15.8 6.4 15.4 6C12.1 3.3 7.1 3.7 4.4 7C1.6 10.3 2 15.2 5.3 18C8.7 20.8 13.6 20.3 16.3 17C17.4 15.8 18 14.3 18.1 12.7C18.2 12.1 18.6 11.7 19.2 11.8C19.7 11.8 20.1 12.3 20.1 12.8Z" fill="#809e40"/></svg>
                                    <span>Real-time itinerary updates</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- CTA -->
                    <div class="about-bottom-cta d-flex align-items-center gap-4 mt-4">
                        <a href="{{ route('about') }}" class="theme-btn">
                            <span>Read More</span> <i class="fas fa-long-arrow-alt-right ms-1"></i>
                        </a>
                        <div class="client-group">
                            <img src="{{ asset('assets/images/client-avatars.webp') }}" alt="Satisfied Travelers" width="135" loading="lazy" decoding="async">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
   SECTION 4: WHY CHOOSE US
========================================================================== -->
<section class="choose-us-section-custom section-padding" id="choose-us" style="background-image: url('{{ asset('assets/images/bg-choose-us.webp') }}');">
    <div class="container">
        <div class="section-title-custom text-center mb-5">
            <span>Bongo Tanbo Travels</span>
            <h2>Why Choose <span>Us</span>?</h2>
            <p>Because you deserve more than just a trip—you deserve an experience that stays with you for a lifetime.</p>
        </div>

        <div class="row g-4">
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="choose-card" data-number="01">
                    <div class="card-icon"><i class="fas fa-user-tie"></i></div>
                    <h4>Experienced Travel Experts Who Care</h4>
                    <p>Our passionate and highly skilled team goes beyond basic planning. We pay attention to every detail, ensuring your journey is smooth, personalized, and unforgettable.</p>
                </div>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="choose-card" data-number="02">
                    <div class="card-icon"><i class="fas fa-globe-americas"></i></div>
                    <h4>A Trusted Global Network</h4>
                    <p>With strong partnerships around the world, we guarantee reliability, quality service, and seamless coordination—no matter where you travel.</p>
                </div>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="choose-card" data-number="03">
                    <div class="card-icon"><i class="fas fa-tags"></i></div>
                    <h4>Exceptional Value for Every Budget</h4>
                    <p>We believe great travel should be accessible. That’s why we offer premium services at competitive prices—giving you the best without compromise.</p>
                </div>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="choose-card" data-number="04">
                    <div class="card-icon"><i class="fas fa-map-marked-alt"></i></div>
                    <h4>Tailor-Made Experiences</h4>
                    <p>Your journey is unique—and it should feel that way. We design customized itineraries that reflect your interests, preferences, and dreams.</p>
                </div>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="choose-card" data-number="05">
                    <div class="card-icon"><i class="fas fa-hiking"></i></div>
                    <h4>Professional Guides Who Enrich Your Journey</h4>
                    <p>Our knowledgeable and friendly guides don’t just show destinations—they bring them to life with stories, insights, and local expertise.</p>
                </div>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="choose-card" data-number="06">
                    <div class="card-icon"><i class="fas fa-headset"></i></div>
                    <h4>End-to-End Travel Support</h4>
                    <p>Travel with confidence knowing we are always just a call away. Anytime, anywhere—we’re here to support you at every single step.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
   SECTION 5: OUR TOUR PACKAGES (DYNAMIC FROM MYSQL)
========================================================================== -->
<section class="tour-section section-padding" id="tour-packages">
    <div class="container-fluid px-lg-5">
        <div class="section-title text-center mb-5">
            <span class="sub-title">Explore Best Offers</span>
            <h2>Our Tour Packages</h2>
        </div>

        <div class="row g-4">
            @forelse($featuredTours as $tour)
                <div class="col-6 col-md-4 col-lg-3">
                    @include('components.tour-card', ['tour' => $tour])
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">
                    <p>No featured tours currently available. Check back soon!</p>
                </div>
            @endforelse
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('tours.index') }}" class="theme-btn">
                <span>View All Tour Packages</span> <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</section>

<!-- ==========================================================================
   PROMOTIONAL DEALS & DISCOUNT BANNERS
========================================================================== -->
<section class="promo-deals-area" style="background-image: url('{{ asset('assets/images/deal-bg.webp') }}');">
    <div class="container">
        <div class="row g-4">
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="tour-box-items-3" style="background-image: url('{{ asset('assets/images/deal-1.webp') }}');">
                    <div class="tour-content">
                        <h3>Explore <br />Destinations <br />Save More Every Trip</h3>
                    </div>
                    <div class="percent-image"><img src="{{ asset('assets/images/badge-1.webp') }}" alt="Special Discount Badge" loading="lazy" decoding="async"></div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="tour-box-items-3" style="background-image: url('{{ asset('assets/images/deal-2.webp') }}');">
                    <div class="tour-content">
                        <h3>Plan Ahead, <br />Travel Smart <br />Save Big On Vacations</h3>
                    </div>
                    <div class="percent-image"><img src="{{ asset('assets/images/badge-2.webp') }}" alt="Special Discount Badge" loading="lazy" decoding="async"></div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="tour-box-items-3" style="background-image: url('{{ asset('assets/images/deal-3.webp') }}');">
                    <div class="tour-content">
                        <h3>Experience <br />The Best Trips <br />At Best Rates</h3>
                    </div>
                    <div class="percent-image"><img src="{{ asset('assets/images/badge-3.webp') }}" alt="Special Discount Badge" loading="lazy" decoding="async"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
   SECTION 6: TOP DESTINATION PACKAGES & HIGHLIGHT CTA
========================================================================== -->
<section class="top-destination-section" id="top-destinations">
    <div class="container">
        <div class="section-title-area d-flex justify-content-between align-items-end flex-wrap gap-3 mb-4">
            <div class="section-title mb-0">
                <span class="sub-title">Our Top Destination Packages</span>
                <h2>Inspiration For Future Travel</h2>
                <p class="text-muted mt-2 mb-0">Our curated destination passes save you more than individual tickets for your tailored holiday experience.</p>
            </div>
            <a href="{{ route('tours.index') }}" class="theme-btn theme-btn-2">
                <span>Tailor-made Packages</span> <i class="fas fa-long-arrow-alt-right ms-1"></i>
            </a>
        </div>

        <div class="row g-3">
            @foreach($categories as $cat)
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="{{ route('tours.index', ['category' => $cat->slug]) }}" class="text-decoration-none">
                        <div class="destination-feature-box">
                            <div class="icon">
                                <img class="topCatImg" src="{{ asset($cat->icon ?? 'assets/images/cat-specialized.webp') }}" alt="{{ $cat->name }}" loading="lazy" width="45" height="45">
                            </div>
                            <div class="content">
                                <h5 class="text-dark">{{ $cat->name }}</h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Travel Highlight CTA -->
        <div class="cta-wrapper-4 mt-5" style="background-image: url('{{ asset('assets/images/cta-bg.webp') }}');">
            <div class="section-title text-center mb-4">
                <span class="sub-title text-white bg-dark bg-opacity-50">Travel Highlight</span>
                <h2 class="text-white">Dream Trip Starts Here <br />Tailored Trips For You</h2>
            </div>
            <a href="#heroBookingForm" class="theme-btn">
                <span>Book Now</span> <i class="fas fa-long-arrow-alt-right ms-1"></i>
            </a>
            <div class="discount-shape"><img src="{{ asset('assets/images/discount-shape.webp') }}" alt="Discount Shape" loading="lazy" decoding="async"></div>
            <div class="bag-shape"><img src="{{ asset('assets/images/bag-shape.webp') }}" alt="Suitcase Shape" loading="lazy" decoding="async"></div>
            <div class="plane-shape"><img src="{{ asset('assets/images/plane-shape.png') }}" alt="Airplane Shape" loading="lazy" decoding="async"></div>
        </div>
    </div>
</section>

<!-- ==========================================================================
   POPULAR IN BANGLADESH (RECOMMENDATION COLLAGE)
========================================================================== -->
<section class="government-style-area" id="popular-section" style="background-image: url('{{ asset('assets/images/gov-bg.webp') }}');">
    <div class="container text-center mb-4">
        <div class="section-title mb-0">
            <p class="gov-sub">Our Recommendations</p>
            <h2 class="gov-main">Popular In Bangladesh</h2>
        </div>
    </div>

    <div class="container">
        <div class="gov-collage-wrapper">
            <div class="gov-item item-1">
                <a href="{{ route('tours.index') }}" class="gov-link">
                    <div class="gov-img-box">
                        <img src="{{ asset('assets/images/gov-waterfalls.webp') }}" alt="Waterfalls in Bangladesh" loading="lazy">
                        <div class="gov-overlay"></div>
                        <div class="gov-content"><span class="gov-tag">Charming</span><h3 class="gov-title">Waterfalls</h3></div>
                    </div>
                </a>
            </div>

            <div class="gov-item item-2">
                <a href="{{ route('tours.index') }}" class="gov-link">
                    <div class="gov-img-box">
                        <img src="{{ asset('assets/images/gov-beach.webp') }}" alt="Beach in Bangladesh" loading="lazy">
                        <div class="gov-overlay"></div>
                        <div class="gov-content"><span class="gov-tag">Beautiful</span><h3 class="gov-title">Beach</h3></div>
                    </div>
                </a>
            </div>

            <div class="gov-item item-3">
                <a href="{{ route('tours.index') }}" class="gov-link">
                    <div class="gov-img-box">
                        <img src="{{ asset('assets/images/gov-food.webp') }}" alt="Bangladeshi Cuisine" loading="lazy">
                        <div class="gov-overlay"></div>
                        <div class="gov-content"><span class="gov-tag">Tasty</span><h3 class="gov-title">Food</h3></div>
                    </div>
                </a>
            </div>

            <div class="gov-item item-4">
                <a href="{{ route('tours.index') }}" class="gov-link">
                    <div class="gov-img-box">
                        <img src="{{ asset('assets/images/gov-green.webp') }}" alt="Green Tourism" loading="lazy">
                        <div class="gov-overlay"></div>
                        <div class="gov-content"><span class="gov-tag">Attractive</span><h3 class="gov-title">Green</h3></div>
                    </div>
                </a>
            </div>

            <div class="gov-item item-5">
                <a href="{{ route('tours.index') }}" class="gov-link">
                    <div class="gov-img-box">
                        <img src="{{ asset('assets/images/gov-history.webp') }}" alt="Historical Heritage" loading="lazy">
                        <div class="gov-overlay"></div>
                        <div class="gov-content"><span class="gov-tag">Heritage Tour</span><h3 class="gov-title">Historical</h3></div>
                    </div>
                </a>
            </div>

            <div class="gov-item item-6">
                <a href="{{ route('tours.index') }}" class="gov-link">
                    <div class="gov-img-box">
                        <img src="{{ asset('assets/images/gov-luxury.webp') }}" alt="Luxury Comfort" loading="lazy">
                        <div class="gov-overlay"></div>
                        <div class="gov-content"><span class="gov-tag">Luxury</span><h3 class="gov-title">Comfort</h3></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
   SECTION 7: LATEST TRAVEL INSIGHTS & BLOG
========================================================================== -->
<section class="news-section section-padding" id="blog-section" style="background-image: url('{{ asset('assets/images/blog-bg.webp') }}');">
    <div class="container-fluid px-lg-5">
        <div class="section-title text-center mb-5">
            <span class="sub-title">Latest Blog &amp; Experience</span>
            <h2>Latest Travel Insights and<br />Destination Guides</h2>
        </div>

        <div class="row g-4">
            @foreach($latestBlogs as $blog)
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="news-card-items h-100 d-flex flex-column bg-white shadow-sm rounded-4 overflow-hidden">
                        <div class="news-image overflow-hidden" style="height: 200px;">
                            <img src="{{ asset($blog->featured_image ?? 'assets/images/blog-1.webp') }}" alt="{{ $blog->title }}" loading="lazy" class="w-100 h-100 object-fit-cover">
                        </div>
                        <div class="news-content p-4 flex-grow-1 d-flex flex-column justify-content-between">
                            <div>
                                <span class="badge bg-light text-success mb-2">{{ $blog->category }}</span>
                                <h4 class="fs-6 fw-bold mb-2">
                                    <a href="{{ route('blog.show', $blog->slug) }}" class="text-dark text-decoration-none">
                                        {{ Str::limit($blog->title, 55) }}
                                    </a>
                                </h4>
                                <p class="text-muted fs-7 mb-3">{{ Str::limit($blog->excerpt, 100) }}</p>
                            </div>
                            <a href="{{ route('blog.show', $blog->slug) }}" class="theme-btn py-2 px-3 fs-7 align-self-start">
                                <span>Read More</span> <i class="fas fa-long-arrow-alt-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
