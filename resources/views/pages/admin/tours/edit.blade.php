@extends('layouts.admin')

@section('title', 'Edit Tour Package')
@section('header_title', 'Edit Tour: ' . $tour->title)

@section('content')
<div class="card border-0 shadow-sm rounded-4 p-3 p-md-5 bg-white">
    <form action="{{ route('admin.tours.update', $tour->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-4">
            <!-- Basic Details -->
            <div class="col-md-8">
                <label class="form-label fs-7 fw-bold text-muted">Tour Title *</label>
                <input type="text" name="title" class="form-control rounded-3" required value="{{ old('title', $tour->title) }}">
            </div>

            <div class="col-md-4">
                <label class="form-label fs-7 fw-bold text-muted">Badge Text (Optional)</label>
                <input type="text" name="badge_text" class="form-control rounded-3" value="{{ old('badge_text', $tour->badge_text) }}">
            </div>

            <div class="col-md-6">
                <label class="form-label fs-7 fw-bold text-muted">Category</label>
                <select name="category_id" class="form-select rounded-3">
                    <option value="">Select Category</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $tour->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label fs-7 fw-bold text-muted">Destination Region</label>
                <select name="destination_id" class="form-select rounded-3">
                    <option value="">Select Destination</option>
                    @foreach($destinations as $dest)
                        <option value="{{ $dest->id }}" {{ old('destination_id', $tour->destination_id) == $dest->id ? 'selected' : '' }}>{{ $dest->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Duration, Places, Price -->
            <div class="col-md-3">
                <label class="form-label fs-7 fw-bold text-muted">Duration (Days) *</label>
                <input type="number" name="duration_days" class="form-control rounded-3" min="1" required value="{{ old('duration_days', $tour->duration_days) }}">
            </div>

            <div class="col-md-3">
                <label class="form-label fs-7 fw-bold text-muted">Duration (Nights)</label>
                <input type="number" name="duration_nights" class="form-control rounded-3" min="0" value="{{ old('duration_nights', $tour->duration_nights) }}">
            </div>

            <div class="col-md-3">
                <label class="form-label fs-7 fw-bold text-muted">Places Visited Count</label>
                <input type="number" name="places_count" class="form-control rounded-3" min="1" value="{{ old('places_count', $tour->places_count) }}">
            </div>

            <div class="col-md-3">
                <label class="form-label fs-7 fw-bold text-muted">Starting Price (BDT)</label>
                <input type="number" step="0.01" name="starting_price" class="form-control rounded-3" value="{{ old('starting_price', $tour->starting_price) }}">
            </div>

            <div class="col-md-6">
                <label class="form-label fs-7 fw-bold text-muted">Difficulty Level</label>
                <select name="difficulty" class="form-select rounded-3">
                    <option value="Easy" {{ old('difficulty', $tour->difficulty) == 'Easy' ? 'selected' : '' }}>Easy</option>
                    <option value="Moderate" {{ old('difficulty', $tour->difficulty) == 'Moderate' ? 'selected' : '' }}>Moderate</option>
                    <option value="Challenging" {{ old('difficulty', $tour->difficulty) == 'Challenging' ? 'selected' : '' }}>Challenging</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label fs-7 fw-bold text-muted">Upload New Featured Image</label>
                <input type="file" name="featured_image_file" class="form-control rounded-3" accept="image/*">
            </div>

            <div class="col-12">
                <label class="form-label fs-7 fw-bold text-muted">Featured Image Path</label>
                <input type="text" name="featured_image" class="form-control rounded-3" value="{{ old('featured_image', $tour->featured_image) }}">
            </div>

            <!-- Overview -->
            <div class="col-12">
                <label class="form-label fs-7 fw-bold text-muted">Tour Overview &amp; Highlights</label>
                <textarea name="overview" class="form-control rounded-3" rows="4">{{ old('overview', $tour->overview) }}</textarea>
            </div>

            <!-- Inclusions & Exclusions -->
            <div class="col-md-6">
                <label class="form-label fs-7 fw-bold text-muted">Inclusions (One per line)</label>
                <textarea name="inclusions_text" class="form-control rounded-3" rows="4">{{ old('inclusions_text', is_array($tour->inclusions) ? implode("\n", $tour->inclusions) : '') }}</textarea>
            </div>

            <div class="col-md-6">
                <label class="form-label fs-7 fw-bold text-muted">Exclusions (One per line)</label>
                <textarea name="exclusions_text" class="form-control rounded-3" rows="4">{{ old('exclusions_text', is_array($tour->exclusions) ? implode("\n", $tour->exclusions) : '') }}</textarea>
            </div>

            <!-- Toggles -->
            <div class="col-12">
                <div class="d-flex flex-wrap gap-3 gap-md-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1" {{ $tour->is_active ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold fs-7 text-dark" for="isActive">Publish Tour (Active Publicly)</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_featured" id="isFeatured" value="1" {{ $tour->is_featured ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold fs-7 text-dark" for="isFeatured">Feature on Homepage</label>
                    </div>
                </div>
            </div>

            <!-- Day-by-Day Itinerary Repeater -->
            <div class="col-12 mt-4 pt-3 border-top">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0"><i class="fas fa-route text-success me-2"></i> Day-by-Day Itinerary</h5>
                    <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3" id="addItineraryBtn">
                        <i class="fas fa-plus me-1"></i> Add Day
                    </button>
                </div>

                <div id="itineraryContainer" class="d-flex flex-column gap-3">
                    @forelse($tour->itineraries as $idx => $it)
                        <div class="p-3 border rounded-3 bg-light itinerary-item">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold text-success fs-7 day-number-label">Day {{ $it->day_number }}</span>
                                <button type="button" class="btn btn-sm btn-outline-danger remove-day-btn py-0 px-2">&times;</button>
                            </div>
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <input type="text" name="itineraries[{{ $idx }}][title]" class="form-control form-control-sm" value="{{ $it->title }}" placeholder="Day Title">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="itineraries[{{ $idx }}][accommodation]" class="form-control form-control-sm" value="{{ $it->accommodation }}" placeholder="Hotel Stay">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="itineraries[{{ $idx }}][meals]" class="form-control form-control-sm" value="{{ $it->meals }}" placeholder="Meals">
                                </div>
                                <div class="col-12">
                                    <textarea name="itineraries[{{ $idx }}][description]" class="form-control form-control-sm" rows="2" placeholder="Activities...">{!! $it->description !!}</textarea>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-3 border rounded-3 bg-light itinerary-item">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold text-success fs-7 day-number-label">Day 1</span>
                            </div>
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <input type="text" name="itineraries[0][title]" class="form-control form-control-sm" placeholder="Day Title">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="itineraries[0][accommodation]" class="form-control form-control-sm" placeholder="Hotel Stay">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="itineraries[0][meals]" class="form-control form-control-sm" placeholder="Meals">
                                </div>
                                <div class="col-12">
                                    <textarea name="itineraries[0][description]" class="form-control form-control-sm" rows="2" placeholder="Activities..."></textarea>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Submit -->
            <div class="col-12 mt-4 d-flex flex-column flex-sm-row justify-content-end gap-2">
                <a href="{{ route('admin.tours.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Cancel</a>
                <button type="submit" class="btn btn-success rounded-pill px-5">Update Tour Package</button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('extra_js')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const container = document.getElementById("itineraryContainer");
    const addBtn = document.getElementById("addItineraryBtn");
    function reindexItineraries() {
        const items = container.querySelectorAll(".itinerary-item");
        items.forEach((item, idx) => {
            const label = item.querySelector(".day-number-label");
            if (label) label.textContent = "Day " + (idx + 1);
            item.querySelectorAll("input, textarea").forEach(input => {
                input.name = input.name.replace(/itineraries\[\d+\]/, `itineraries[${idx}]`);
            });
        });
    }

    addBtn.addEventListener("click", function () {
        const index = container.querySelectorAll(".itinerary-item").length;
        const dayNum = index + 1;
        const html = `
            <div class="p-3 border rounded-3 bg-light itinerary-item">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="fw-bold text-success fs-7 day-number-label">Day ${dayNum}</span>
                    <button type="button" class="btn btn-sm btn-outline-danger remove-day-btn py-0 px-2">&times;</button>
                </div>
                <div class="row g-2">
                    <div class="col-md-6">
                        <input type="text" name="itineraries[${index}][title]" class="form-control form-control-sm" placeholder="Day Title">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="itineraries[${index}][accommodation]" class="form-control form-control-sm" placeholder="Hotel Stay">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="itineraries[${index}][meals]" class="form-control form-control-sm" placeholder="Meals">
                    </div>
                    <div class="col-12">
                        <textarea name="itineraries[${index}][description]" class="form-control form-control-sm" rows="2" placeholder="Activities..."></textarea>
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML("beforeend", html);
    });

    container.addEventListener("click", function (e) {
        if (e.target.classList.contains("remove-day-btn")) {
            e.target.closest(".itinerary-item").remove();
            reindexItineraries();
        }
    });
});
</script>
@endsection
