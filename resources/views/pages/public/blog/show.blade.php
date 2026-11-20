@extends('layouts.public')

@section('title', $blog->title . ' | Bongo Tanbo Travels')
@section('meta_description', Str::limit(strip_tags($blog->excerpt), 160))
@section('meta_image', asset($blog->featured_image ?? 'assets/images/blog-1.webp'))

@section('content')
<div class="page-banner bg-dark text-white py-5 position-relative" style="background: linear-gradient(rgba(14,27,39,0.85), rgba(14,27,39,0.85)), url('{{ asset($blog->featured_image ?? 'assets/images/blog-bg.webp') }}') center/cover;">
    <div class="container py-4">
        <span class="badge bg-success px-3 py-1 rounded-pill mb-2">{{ $blog->category }}</span>
        <h1 class="display-6 fw-bold text-white mb-2" style="max-width: 850px;">{{ $blog->title }}</h1>
        <div class="text-white-50 fs-7 mt-2">
            <span><i class="far fa-calendar-alt text-success me-1"></i> {{ $blog->published_at ? $blog->published_at->format('F d, Y') : 'Recent' }}</span>
            <span class="ms-3"><i class="far fa-user text-success me-1"></i> Bongo Tanbo Editorial</span>
        </div>
        <nav aria-label="breadcrumb" class="mt-3">
            <ol class="breadcrumb text-white-50">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('blog.index') }}" class="text-white-50 text-decoration-none">Blog</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">{{ Str::limit($blog->title, 30) }}</li>
            </ol>
        </nav>
    </div>
</div>

<section class="section-padding bg-light">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <article class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                    <img src="{{ asset($blog->featured_image ?? 'assets/images/blog-1.webp') }}" alt="{{ $blog->title }}" class="img-fluid rounded-4 mb-4 w-100" style="max-height: 420px; object-fit: cover;">
                    <div class="text-dark leading-relaxed fs-6">
                        {!! nl2br(e($blog->content)) !!}
                    </div>
                </article>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
                    <h5 class="fw-bold mb-3">Recent Stories</h5>
                    <div class="d-flex flex-column gap-3">
                        @foreach($recentBlogs as $rb)
                            <div class="d-flex gap-3 align-items-center">
                                <img src="{{ asset($rb->featured_image ?? 'assets/images/blog-1.webp') }}" alt="{{ $rb->title }}" class="rounded-3 object-fit-cover" width="70" height="70">
                                <div>
                                    <h6 class="fs-7 fw-bold mb-1">
                                        <a href="{{ route('blog.show', $rb->slug) }}" class="text-dark text-decoration-none">
                                            {{ Str::limit($rb->title, 45) }}
                                        </a>
                                    </h6>
                                    <span class="fs-8 text-muted">{{ $rb->published_at ? $rb->published_at->format('M d, Y') : '' }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4 text-white" style="background-color: #809e40;">
                    <h5 class="fw-bold text-white mb-2">Plan Your Custom Journey</h5>
                    <p class="text-white-50 fs-7 mb-3">Looking for a tailored tour based on this guide? Inquire now with our advisors.</p>
                    <a href="{{ route('contact.index') }}" class="btn btn-light text-success fw-bold rounded-pill w-100">
                        Inquire Today
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
