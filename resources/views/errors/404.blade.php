@extends('layouts.public')

@section('title', 'Page Not Found (404) | Bongo Tanbo Travels')

@section('content')
<section class="py-5 my-5 text-center">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="display-1 fw-bold text-success mb-3" style="color: #809e40 !important;">404</div>
                <h2 class="fw-bold mb-3">Destination Not Found</h2>
                <p class="text-muted fs-6 mb-4">
                    The page or tour package you are looking for may have been moved, renamed, or is temporarily unavailable. Let us guide you back to our curated journeys.
                </p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="{{ route('home') }}" class="theme-btn">
                        <i class="fas fa-home me-2"></i> Return to Homepage
                    </a>
                    <a href="{{ route('tours.index') }}" class="theme-btn btn-black">
                        <i class="fas fa-map-marked-alt me-2"></i> Explore Tours
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
