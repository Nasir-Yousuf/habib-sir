@extends('layouts.public')

@section('title', 'Explore Destinations | Bongo Tanbo Travels')
@section('meta_description', 'Discover iconic travel destinations in Bangladesh and Japan, from the mangrove waterways of Sundarbans to the neon skylines of Tokyo.')

@section('content')
<div class="page-banner bg-dark text-white py-5 position-relative" style="background: linear-gradient(rgba(14,27,39,0.85), rgba(14,27,39,0.85)), url('{{ asset('assets/images/kaptai-lake.png') }}') center/cover;">
    <div class="container py-4 text-center">
        <h1 class="display-5 fw-bold text-white mb-2">Featured Destinations</h1>
        <p class="lead text-white-50 mb-0">From Riverine Deltas &amp; Hill Tracts to Modern Japan</p>
        <nav aria-label="breadcrumb" class="mt-3">
            <ol class="breadcrumb justify-content-center text-white-50">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Destinations</li>
            </ol>
        </nav>
    </div>
</div>

<section class="section-padding bg-light">
    <div class="container">
        <div class="row g-4">
            @foreach($destinations as $dest)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 bg-white">
                        <div class="position-relative overflow-hidden" style="height: 220px;">
                            <img src="{{ asset($dest->banner_image ?? 'assets/images/sundorbon.png') }}" alt="{{ $dest->name }}" loading="lazy" class="w-100 h-100 object-fit-cover" style="transition: transform 0.4s ease;">
                            <span class="position-absolute top-0 end-0 m-3 badge bg-dark bg-opacity-75 text-white px-2 py-1 fs-7">
                                {{ $dest->country }}
                            </span>
                        </div>
                        <div class="card-body p-4 d-flex flex-column justify-content-between">
                            <div>
                                <h3 class="fs-5 fw-bold mb-1">
                                    <a href="{{ route('destinations.show', $dest->slug) }}" class="text-dark text-decoration-none">
                                        {{ $dest->name }}
                                    </a>
                                </h3>
                                @if($dest->tagline)
                                    <p class="text-success fs-7 fw-semibold mb-2">{{ $dest->tagline }}</p>
                                @endif
                                <p class="text-muted fs-7 mb-3">{{ Str::limit($dest->description, 110) }}</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                <span class="text-muted fs-7"><i class="fas fa-route text-success me-1"></i> {{ $dest->tours_count }} Tour Packages</span>
                                <a href="{{ route('destinations.show', $dest->slug) }}" class="theme-btn py-1 px-3 fs-7">
                                    <span>Explore</span> <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
