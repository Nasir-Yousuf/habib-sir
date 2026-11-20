@extends('layouts.admin')

@section('title', 'Manage Destinations')
@section('header_title', 'Destinations Management')

@section('content')
<div class="card border-0 shadow-sm rounded-4 p-3 p-sm-4 bg-white mb-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
            <h5 class="fw-bold mb-1">Travel Destinations</h5>
            <p class="text-muted fs-7 mb-0">Manage regions, countries, banner images, and descriptions.</p>
        </div>
        <button type="button" class="btn btn-success rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#addDestModal">
            <i class="fas fa-plus me-1"></i> Add Destination
        </button>
    </div>
</div>

<!-- Destinations Table -->
<div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light fs-8 text-uppercase text-muted">
                <tr>
                    <th>Banner</th>
                    <th>Destination Name</th>
                    <th>Country</th>
                    <th>Tagline</th>
                    <th>Tours</th>
                    <th>Featured</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody class="fs-7">
                @forelse($destinations as $dest)
                    <tr>
                        <td style="width: 70px;">
                            <img src="{{ asset($dest->banner_image ?? 'assets/images/sundorbon.png') }}" alt="{{ $dest->name }}" class="rounded-3 object-fit-cover" width="60" height="45">
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $dest->name }}</div>
                            <span class="text-muted fs-8">{{ $dest->slug }}</span>
                        </td>
                        <td><span class="badge bg-light text-dark border">{{ $dest->country }}</span></td>
                        <td><span class="text-muted fs-8">{{ $dest->tagline ?? '—' }}</span></td>
                        <td><span class="fw-bold text-success">{{ $dest->tours_count }} Tours</span></td>
                        <td>
                            @if($dest->is_featured)
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill">Yes</span>
                            @else
                                <span class="badge bg-light text-muted border rounded-pill">No</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <form action="{{ route('admin.destinations.destroy', $dest->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this destination?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">No destinations found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-3 border-top d-flex justify-content-center">
        {{ $destinations->links('pagination::bootstrap-5') }}
    </div>
</div>

<!-- Add Destination Modal -->
<div class="modal fade" id="addDestModal" tabindex="-1" aria-labelledby="addDestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <form action="{{ route('admin.destinations.store') }}" method="POST">
                @csrf
                <div class="modal-header border-bottom p-4">
                    <h5 class="modal-title fw-bold" id="addDestModalLabel">Add New Destination</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fs-7 fw-bold text-muted">Destination Name *</label>
                        <input type="text" name="name" class="form-control rounded-3" placeholder="e.g. Srimangal" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fs-7 fw-bold text-muted">Country *</label>
                        <input type="text" name="country" class="form-control rounded-3" value="Bangladesh" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fs-7 fw-bold text-muted">Tagline</label>
                        <input type="text" name="tagline" class="form-control rounded-3" placeholder="e.g. Emerald Rolling Hills">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fs-7 fw-bold text-muted">Banner Image Path</label>
                        <input type="text" name="banner_image" class="form-control rounded-3" value="assets/images/sundorbon.png">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fs-7 fw-bold text-muted">Description</label>
                        <textarea name="description" class="form-control rounded-3" rows="3" placeholder="Overview of destination..."></textarea>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_featured" id="modalDestFeatured" value="1" checked>
                        <label class="form-check-label fs-7 fw-bold" for="modalDestFeatured">Feature on Homepage</label>
                    </div>
                </div>
                <div class="modal-footer border-top p-3">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success rounded-pill px-4">Create Destination</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
