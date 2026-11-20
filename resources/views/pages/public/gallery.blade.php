@extends('layouts.public')

@section('title', 'Photo Gallery & Travel Archive | Bongo Tanbo Travels')
@section('meta_description', 'Explore moments, cultural festivals, wilderness landscapes, and traveler memories captured across Bangladesh and Japan.')

@section('content')
<div class="page-banner bg-dark text-white py-5 position-relative" style="background: linear-gradient(rgba(14,27,39,0.85), rgba(14,27,39,0.85)), url('{{ asset('assets/images/gov-bg.webp') }}') center/cover;">
    <div class="container py-4 text-center">
        <h1 class="display-5 fw-bold text-white mb-2">Travel Photo Archive</h1>
        <p class="lead text-white-50 mb-0">Moments of Discovery, Heritage, and Wilderness</p>
        <nav aria-label="breadcrumb" class="mt-3">
            <ol class="breadcrumb justify-content-center text-white-50">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Gallery</li>
            </ol>
        </nav>
    </div>
</div>

<section class="section-padding bg-light">
    <div class="container">
        <!-- Gallery Grid -->
        <div class="row g-4">
            @php
                $galleryPhotos = [
                    ['img' => 'assets/images/sundorbon.png', 'title' => 'Sundarbans Tiger Habitat', 'cat' => 'Wilderness'],
                    ['img' => 'assets/images/tea-garden.png', 'title' => 'Srimangal Green Tea Slopes', 'cat' => 'Landscape'],
                    ['img' => 'assets/images/kaptai-lake.png', 'title' => 'Kaptai Lake Blue Waters', 'cat' => 'Hill Tracts'],
                    ['img' => 'assets/images/hero-coxs-bazar.jpg', 'title' => 'Cox\'s Bazar Golden Sunset', 'cat' => 'Beach'],
                    ['img' => 'assets/images/gov-waterfalls.webp', 'title' => 'Rainforest Cascades', 'cat' => 'Waterfalls'],
                    ['img' => 'assets/images/gov-beach.webp', 'title' => 'Bay of Bengal Coastline', 'cat' => 'Beach'],
                    ['img' => 'assets/images/gov-food.webp', 'title' => 'Authentic Bengali Gastronomy', 'cat' => 'Culture'],
                    ['img' => 'assets/images/gov-history.webp', 'title' => 'Medieval Terracotta Heritage', 'cat' => 'Heritage'],
                    ['img' => 'assets/images/package-1.webp', 'title' => 'Japan Traditional Shrines', 'cat' => 'Japan'],
                    ['img' => 'assets/images/package-2.jpg', 'title' => 'Singapore Marina Bay', 'cat' => 'Outbound'],
                    ['img' => 'assets/images/package-5.jpg', 'title' => 'Bandarban Cloud Peaks', 'cat' => 'Trekking'],
                    ['img' => 'assets/images/package-8.jpg', 'title' => 'Paharpur Buddhist Stupa', 'cat' => 'Archaeology'],
                ];
            @endphp

            @foreach($galleryPhotos as $photo)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden position-relative group-hover-box h-100">
                        <img src="{{ asset($photo['img']) }}" alt="{{ $photo['title'] }}" loading="lazy" class="w-100 object-fit-cover" style="height: 240px; transition: transform 0.4s ease;">
                        <div class="p-3 bg-white">
                            <span class="badge bg-light text-success fs-8 mb-1">{{ $photo['cat'] }}</span>
                            <h5 class="fs-7 fw-bold text-dark mb-0">{{ $photo['title'] }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
