@props(['tour'])

<div class="tour-box-items">
    <div class="thumb position-relative overflow-hidden">
        <a href="{{ route('tours.show', $tour->slug) }}">
            <img src="{{ asset($tour->featured_image ?? 'assets/images/package-1.webp') }}" 
                 alt="{{ $tour->title }}" 
                 loading="lazy" 
                 width="320" 
                 height="210" 
                 class="w-100 object-fit-cover" 
                 style="height: 200px; transition: transform 0.4s ease;">
        </a>
        @if($tour->badge_text)
            <span class="position-absolute top-0 start-0 m-2 px-2 py-1 text-white fw-bold rounded-pill" style="background-color: #809e40; font-size: 11px;">
                {{ $tour->badge_text }}
            </span>
        @endif
        @if($tour->starting_price)
            <span class="position-absolute bottom-0 end-0 m-2 px-2 py-1 text-white fw-bold rounded-pill" style="background-color: #fb5b32; font-size: 12px;">
                From ৳{{ number_format($tour->starting_price) }}
            </span>
        @endif
    </div>
    <div class="content p-3">
        <h4 class="fs-6 mb-2">
            <a href="{{ route('tours.show', $tour->slug) }}" class="text-dark fw-bold text-decoration-none">
                {{ $tour->title }}
            </a>
        </h4>
        <ul class="list d-flex justify-content-between align-items-center ps-0 mb-0 text-muted fs-7">
            <li><i class="far fa-calendar text-success me-1"></i> {{ $tour->duration_days }} Days @if($tour->duration_nights)/ {{ $tour->duration_nights }}N @endif</li>
            <li><i class="far fa-flag text-danger me-1"></i> {{ $tour->places_count }} places</li>
        </ul>
    </div>
</div>
