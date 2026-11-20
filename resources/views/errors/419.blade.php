@extends('layouts.public')

@section('title', 'Session Expired (419) | Bongo Tanbo Travels')

@section('content')
<section class="py-5 my-5 text-center">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="display-1 fw-bold text-warning mb-3">419</div>
                <h2 class="fw-bold mb-3">Security Token Expired</h2>
                <p class="text-muted fs-6 mb-4">
                    Your browsing session or security token timed out due to inactivity. Please refresh the page to obtain a fresh CSRF token and proceed safely.
                </p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <button onclick="window.location.reload();" class="theme-btn">
                        <i class="fas fa-redo me-2"></i> Refresh Page
                    </button>
                    <a href="{{ route('home') }}" class="theme-btn btn-black">
                        <i class="fas fa-home me-2"></i> Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
