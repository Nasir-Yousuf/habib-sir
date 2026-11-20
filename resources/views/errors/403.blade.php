@extends('layouts.public')

@section('title', 'Access Denied (403) | Bongo Tanbo Travels')

@section('content')
<section class="py-5 my-5 text-center">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="display-1 fw-bold text-danger mb-3">403</div>
                <h2 class="fw-bold mb-3">Access Restricted</h2>
                <p class="text-muted fs-6 mb-4">
                    You do not have administrative privileges to access this secure resource. If you believe this is an error, please contact your systems administrator.
                </p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="{{ route('home') }}" class="theme-btn">
                        <i class="fas fa-home me-2"></i> Return Home
                    </a>
                    <a href="{{ route('login') }}" class="theme-btn btn-black">
                        <i class="fas fa-user-lock me-2"></i> Admin Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
