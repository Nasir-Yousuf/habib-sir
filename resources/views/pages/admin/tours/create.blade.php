@extends('layouts.admin')

@section('title', 'Create Tour Package')
@section('header_title', 'Create New Tour Package')

@section('content')
<div class="card border-0 shadow-sm rounded-4 p-3 p-md-5 bg-white">
    <form action="{{ route('admin.tours.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-4">
            <!-- Basic Details -->
            <div class="col-md-8">
                <label class="form-label fs-7 fw-bold text-muted">Tour Title *</label>
                <input type="text" name="title" class="form-control rounded-3" placeholder="e.g. 7 Days Bangladesh Standard Tour" required value="{{ old('title') }}">
            </div>

            <div class="col-md-4">
                <label class="form-label fs-7 fw-bold text-muted">Badge Text (Optional)</label>
                <input type="text" name="badge_text" class="form-control rounded-3" placeholder="e.g. Best Seller / UNESCO Heritage" value="{{ old('badge_text') }}">
            </div>

            <div class="col-md-6">
                <label class="form-label fs-7 fw-bold text-muted">Category</label>
                <select name="category_id" class="form-select rounded-3">
                    <option value="">Select Category</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label fs-7 fw-bold text-muted">Destination Region</label>
                <select name="destination_id" class="form-select rounded-3">
                    <option value="">Select Destination</option>
                    @foreach($destinations as $dest)
                        <option value="{{ $dest->id }}" {{ old('destination_id') == $dest->id ? 'selected' : '' }}>{{ $dest->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Duration, Places, Price -->
            <div class="col-md-3">
                <label class="form-label fs-7 fw-bold text-muted">Duration (Days) *</label>
                <input type="number" name="duration_days" class="form-control rounded-3" min="1" required value="{{ old('duration_days', 7) }}">
            </div>

            <div class="col-md-3">
                <label class="form-label fs-7 fw-bold text-muted">Duration (Nights)</label>
                <input type="number" name="duration_nights" class="form-control rounded-3" min="0" value="{{ old('duration_nights', 6) }}">
            </div>

            <div class="col-md-3">
                <label class="form-label fs-7 fw-bold text-muted">Places Visited Count</label>
                <input type="number" name="places_count" class="form-control rounded-3" min="1" value="{{ old('places_count', 4) }}">
            </div>

            <div class="col-md-3">
                <label class="form-label fs-7 fw-bold text-muted">Starting Price (BDT)</label>
                <input type="number" step="0.01" name="starting_price" class="form-control rounded-3" placeholder="35000" value="{{ old('starting_price') }}">
            </div>

            <div class="col-md-6">
                <label class="form-label fs-7 fw-bold text-muted">Difficulty Level</label>
                <select name="difficulty" class="form-select rounded-3">
                    <option value="Easy" {{ old('difficulty') == 'Easy' ? 'selected' : '' }}>Easy</option>
                    <option value="Moderate" {{ old('difficulty') == 'Moderate' ? 'selected' : '' }}>Moderate</option>
                    <option value="Challenging" {{ old('difficulty') == 'Challenging' ? 'selected' : '' }}>Challenging</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label fs-7 fw-bold text-muted">Featured Image File</label>
                <input type="file" name="featured_image_file" class="form-control rounded-3" accept="image/*">
                <small class="text-muted fs-8">Or leave blank to use reference path below.</small>
            </div>

            <div class="col-12">
                <label class="form-label fs-7 fw-bold text-muted">Existing Asset Image Path (Optional)</label>
                <input type="text" name="featured_image" class="form-control rounded-3" placeholder="assets/images/package-1.webp" value="{{ old('featured_image', 'assets/images/package-1.webp') }}">
            </div>

            <!-- Overview -->
            <div class="col-12">
                <label class="form-label fs-7 fw-bold text-muted">Tour Overview &amp; Highlights</label>
                <textarea name="overview" class="form-control rounded-3" rows="4" placeholder="Comprehensive description of the tour experience...">{{ old('overview') }}</textarea>
            </div>

            <!-- Inclusions & Exclusions -->
            <div class="col-md-6">
                <label class="form-label fs-7 fw-bold text-muted">Inclusions (One per line)</label>
                <textarea name="inclusions_text" class="form-control rounded-3" rows="4" placeholder="AC Transport&#10;Licensed Tour Guide&#10;Hotel Stay&#10;Daily Breakfast">{{ old('inclusions_text') }}</textarea>
            </div>

            <div class="col-md-6">
                <label class="form-label fs-7 fw-bold text-muted">Exclusions (One per line)</label>
                <textarea name="exclusions_text" class="form-control rounded-3" rows="4" placeholder="Airfare&#10;Personal Expenses&#10;Travel Insurance">{{ old('exclusions_text') }}</textarea>
            </div>

            <!-- Toggles -->
            <div class="col-12">
                <div class="d-flex gap-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1" checked>
                        <label class="form-check-label fw-bold fs-7 text-dark" for="isActive">Publish Tour (Active Publicly)</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_featured" id="isFeatured" value="1" checked>
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
                    <!-- Day 1 Default Card -->
                    <div class="p-3 border rounded-3 bg-light itinerary-item">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="fw-bold text-success fs-7 day-number-label">Day 1</span>
                        </div>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <input type="text" name="itineraries[0][title]" class="form-control form-control-sm" placeholder="Day Title (e.g. Arrival in Dhaka)">
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="itineraries[0][accommodation]" class="form-control form-control-sm" placeholder="Hotel Stay">
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="itineraries[0][meals]" class="form-control form-control-sm" placeholder="Meals (e.g. Dinner)">
                            </div>
                            <div class="col-12">
                                <textarea name="itineraries[0][description]" class="form-control form-control-sm" rows="2" placeholder="Activities for this day..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="col-12 mt-4 d-flex flex-column flex-sm-row justify-content-end gap-2">
                <a href="{{ route('admin.tours.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Cancel</a>
                <button type="submit" class="btn btn-success rounded-pill px-5">Save Tour Package</button>
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
    let dayCount = 1;

    addBtn.addEventListener("click", function () {
        dayCount++;
        const index = dayCount - 1;
        const html = `
            <div class="p-3 border rounded-3 bg-light itinerary-item">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="fw-bold text-success fs-7 day-number-label">Day ${dayCount}</span>
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
        }
    });
});
</script>
@endsection
