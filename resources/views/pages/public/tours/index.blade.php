@extends('layouts.public')

@section('title', 'Tour Packages & Curated Itineraries | Bongo Tanbo Travels')
@section('meta_description', 'Browse our wide range of inbound, outbound, cultural, trekking, and heritage tour packages across Bangladesh and Japan.')

@section('content')
<!-- Page Banner -->
<div class="page-banner bg-dark text-white py-5 position-relative" style="background: linear-gradient(rgba(14,27,39,0.85), rgba(14,27,39,0.85)), url('{{ asset('assets/images/tea-garden.png') }}') center/cover;">
    <div class="container py-4 text-center">
        <h1 class="display-5 fw-bold text-white mb-2">Our Tour Packages</h1>
        <p class="lead text-white-50 mb-0">Discover Handcrafted Itineraries Tailored to Your Dreams</p>
        <nav aria-label="breadcrumb" class="mt-3">
            <ol class="breadcrumb justify-content-center text-white-50">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Tour Packages</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Main Catalog Section -->
<section class="section-padding bg-light">
    <div class="container">
        <!-- Filter Controls Form -->
        <div class="card border-0 shadow-sm rounded-4 p-4 mb-5 bg-white">
            <form action="{{ route('tours.index') }}" method="GET" class="row g-3 align-items-end">
                <!-- Search Keyword -->
                <div class="col-md-3">
                    <label class="form-label fs-7 fw-bold text-muted">Search Tours</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-start-0 shadow-none" placeholder="Keyword..." value="{{ request('search') }}">
                    </div>
                </div>

                <!-- Category -->
                <div class="col-md-3">
                    <label class="form-label fs-7 fw-bold text-muted">Category</label>
                    <select name="category" class="form-select shadow-none">
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Destination -->
                <div class="col-md-2">
                    <label class="form-label fs-7 fw-bold text-muted">Destination</label>
                    <select name="destination" class="form-select shadow-none">
                        <option value="">All Destinations</option>
                        @foreach($destinations as $dest)
                            <option value="{{ $dest->slug }}" {{ request('destination') == $dest->slug ? 'selected' : '' }}>{{ $dest->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Duration -->
                <div class="col-md-2">
                    <label class="form-label fs-7 fw-bold text-muted">Duration</label>
                    <select name="duration" class="form-select shadow-none">
                        <option value="">Any Duration</option>
                        <option value="3-days" {{ request('duration') == '3-days' ? 'selected' : '' }}>Up to 3 Days</option>
                        <option value="5-days" {{ request('duration') == '5-days' ? 'selected' : '' }}>5 Days</option>
                        <option value="7-days" {{ request('duration') == '7-days' ? 'selected' : '' }}>7 Days</option>
                        <option value="8-days" {{ request('duration') == '8-days' ? 'selected' : '' }}>8 Days</option>
                        <option value="10-days" {{ request('duration') == '10-days' ? 'selected' : '' }}>10 Days</option>
                        <option value="12-days" {{ request('duration') == '12-days' ? 'selected' : '' }}>12+ Days</option>
                    </select>
                </div>

                <!-- Filter Actions -->
                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="theme-btn w-100 py-2 justify-content-center">
                        <i class="fas fa-filter me-1"></i> Filter
                    </button>
                    @if(request()->anyFilled(['search', 'category', 'destination', 'duration', 'sort']))
                        <a href="{{ route('tours.index') }}" class="btn btn-outline-secondary rounded-pill py-2 px-3" title="Clear Filters">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Tours Grid -->
        <div class="row g-4">
            @forelse($tours as $tour)
                <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                    @include('components.tour-card', ['tour' => $tour])
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="p-5 bg-white rounded-4 shadow-sm">
                        <i class="fas fa-map-signs text-muted display-4 mb-3"></i>
                        <h3 class="fw-bold">No Tours Found Matching Your Filter</h3>
                        <p class="text-muted">Try adjusting your destination, category, or duration criteria.</p>
                        <a href="{{ route('tours.index') }}" class="theme-btn mt-2"><span>View All Packages</span></a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-5">
            {{ $tours->links('pagination::bootstrap-5') }}
        </div>
    </div>
</section>
@endsection
