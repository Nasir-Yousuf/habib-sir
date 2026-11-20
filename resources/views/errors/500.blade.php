@extends('layouts.public')

@section('title', 'Server Error (500) | Bongo Tanbo Travels')

@section('content')
<section class="py-5 my-5 text-center">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="display-1 fw-bold text-secondary mb-3">500</div>
                <h2 class="fw-bold mb-3">System Temporarily Unavailable</h2>
                <p class="text-muted fs-6 mb-4">
                    We are currently experiencing a temporary server hiccup. Our technical operations team has been notified. Please try again shortly or contact our liaison offices directly.
                </p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="{{ route('home') }}" class="theme-btn">
                        <i class="fas fa-home me-2"></i> Return Home
                    </a>
                    <a href="{{ route('contact.index') }}" class="theme-btn btn-black">
                        <i class="fas fa-envelope me-2"></i> Contact Offices
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
