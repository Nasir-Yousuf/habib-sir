@extends('layouts.public')

@section('title', $destination->name . ' Tours & Travel Guide | Bongo Tanbo Travels')
@section('meta_description', Str::limit(strip_tags($destination->description), 160))

@section('content')
<div class="page-banner bg-dark text-white py-5 position-relative" style="background: linear-gradient(rgba(14,27,39,0.85), rgba(14,27,39,0.85)), url('{{ asset($destination->banner_image ?? 'assets/images/sundorbon.png') }}') center/cover;">
    <div class="container py-4 text-center">
        <span class="badge bg-success px-3 py-1 rounded-pill mb-2">{{ $destination->country }}</span>
        <h1 class="display-5 fw-bold text-white mb-2">{{ $destination->name }}</h1>
        @if($destination->tagline)
            <p class="lead text-white-50 mb-0">{{ $destination->tagline }}</p>
        @endif
        <nav aria-label="breadcrumb" class="mt-3">
            <ol class="breadcrumb justify-content-center text-white-50">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('destinations.index') }}" class="text-white-50 text-decoration-none">Destinations</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">{{ $destination->name }}</li>
            </ol>
        </nav>
    </div>
</div>

<section class="section-padding bg-light">
    <div class="container">
        <!-- Destination Overview -->
        <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white mb-5">
            <h2 class="fw-bold mb-3">About {{ $destination->name }}</h2>
            <p class="text-muted leading-relaxed fs-6 mb-0">{{ $destination->description }}</p>
        </div>

        <!-- Tours in this Destination -->
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <h3 class="fw-bold mb-0">Tour Packages in {{ $destination->name }}</h3>
            <span class="text-muted fs-7">{{ $tours->total() }} Packages Available</span>
        </div>

        <div class="row g-4">
            @forelse($tours as $tour)
                <div class="col-12 col-sm-6 col-lg-4">
                    @include('components.tour-card', ['tour' => $tour])
                </div>
            @empty
                <div class="col-12 text-center py-5 bg-white rounded-4 shadow-sm">
                    <p class="text-muted mb-0">No tour packages currently listed for this destination.</p>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $tours->links('pagination::bootstrap-5') }}
        </div>
    </div>
</section>
@endsection
