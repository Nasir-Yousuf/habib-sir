@extends('layouts.public')

@section('title', 'Travel Blog & Destination Guides | Bongo Tanbo Travels')
@section('meta_description', 'Read authentic travel insights, wildlife sanctuary guides, and traveler stories from Bongo Tanbo Travels.')

@section('content')
<div class="page-banner bg-dark text-white py-5 position-relative" style="background: linear-gradient(rgba(14,27,39,0.85), rgba(14,27,39,0.85)), url('{{ asset('assets/images/blog-bg.webp') }}') center/cover;">
    <div class="container py-4 text-center">
        <h1 class="display-5 fw-bold text-white mb-2">Travel Insights &amp; Guides</h1>
        <p class="lead text-white-50 mb-0">Stories, Experiences, and Local Recommendations</p>
        <nav aria-label="breadcrumb" class="mt-3">
            <ol class="breadcrumb justify-content-center text-white-50">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Blog</li>
            </ol>
        </nav>
    </div>
</div>

<section class="section-padding bg-light">
    <div class="container">
        <div class="row g-4">
            @forelse($blogs as $post)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 bg-white">
                        <div class="overflow-hidden" style="height: 220px;">
                            <img src="{{ asset($post->featured_image ?? 'assets/images/blog-1.webp') }}" alt="{{ $post->title }}" loading="lazy" class="w-100 h-100 object-fit-cover" style="transition: transform 0.4s ease;">
                        </div>
                        <div class="card-body p-4 d-flex flex-column justify-content-between">
                            <div>
                                <span class="badge bg-light text-success mb-2">{{ $post->category }}</span>
                                <h3 class="fs-5 fw-bold mb-2">
                                    <a href="{{ route('blog.show', $post->slug) }}" class="text-dark text-decoration-none">
                                        {{ $post->title }}
                                    </a>
                                </h3>
                                <p class="text-muted fs-7 mb-3">{{ Str::limit($post->excerpt, 110) }}</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                <span class="text-muted fs-8"><i class="far fa-calendar-alt text-success me-1"></i> {{ $post->published_at ? $post->published_at->format('M d, Y') : 'Recent' }}</span>
                                <a href="{{ route('blog.show', $post->slug) }}" class="theme-btn py-1 px-3 fs-7">
                                    <span>Read</span> <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">No blog articles published yet.</p>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $blogs->links('pagination::bootstrap-5') }}
        </div>
    </div>
</section>
@endsection
