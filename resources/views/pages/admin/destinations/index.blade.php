@extends('layouts.admin')

@section('title', 'Manage Destinations')
@section('header_title', 'Destinations Management')

@section('content')
<div class="card border-0 shadow-sm rounded-4 p-3 p-md-4 bg-white mb-4">
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3">
        <div>
            <h5 class="fw-bold mb-1">Travel Destinations</h5>
            <p class="text-muted small mb-0">Manage regions, countries, banner images, and descriptions.</p>
        </div>
        <button type="button" class="btn btn-success rounded-pill px-4 w-100 w-sm-auto btn-touch" data-bs-toggle="modal" data-bs-target="#addDestModal">
            <i class="fas fa-plus me-1"></i> Add Destination
        </button>
    </div>
</div>

<!-- Desktop Destinations Table (md and up) -->
<div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden d-none d-md-block">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light small text-uppercase text-muted">
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
            <tbody class="small">
                @forelse($destinations as $dest)
                    <tr>
                        <td style="width: 70px;">
                            <img src="{{ asset($dest->banner_image ?? 'assets/images/sundorbon.png') }}" alt="{{ $dest->name }}" class="rounded-3 object-fit-cover" width="60" height="45" loading="lazy">
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $dest->name }}</div>
                            <span class="text-muted">{{ $dest->slug }}</span>
                        </td>
                        <td><span class="badge bg-light text-dark border">{{ $dest->country }}</span></td>
                        <td><span class="text-muted">{{ $dest->tagline ?? '—' }}</span></td>
                        <td><span class="fw-bold text-success">{{ $dest->tours_count }} Tours</span></td>
                        <td>
                            @if($dest->is_featured)
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill">Yes</span>
                            @else
                                <span class="badge bg-light text-muted border rounded-pill">No</span>
                            @endif
                        </td>
                        <td class="text-end text-nowrap">
                            <button type="button"
                                class="btn btn-sm btn-outline-primary rounded-pill me-1 edit-dest-btn"
                                data-bs-toggle="modal"
                                data-bs-target="#editDestModal"
                                data-action="{{ route('admin.destinations.update', $dest->id) }}"
                                data-name="{{ $dest->name }}"
                                data-country="{{ $dest->country }}"
                                data-tagline="{{ $dest->tagline }}"
                                data-banner="{{ $dest->banner_image }}"
                                data-description="{{ $dest->description }}"
                                data-featured="{{ $dest->is_featured ? '1' : '0' }}"
                                title="Edit Destination">
                                <i class="fas fa-edit"></i>
                            </button>
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

<!-- Mobile Destination Cards (< 768px) -->
<div class="d-md-none d-flex flex-column gap-3">
    @forelse($destinations as $dest)
        <div class="admin-mobile-card">
            <div class="d-flex gap-3 mb-3">
                <img src="{{ asset($dest->banner_image ?? 'assets/images/sundorbon.png') }}" alt="{{ $dest->name }}" class="rounded-3 object-fit-cover flex-shrink-0" width="76" height="64" loading="lazy">
                <div class="min-w-0 flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start gap-2">
                        <h6 class="fw-bold text-dark mb-1">{{ $dest->name }}</h6>
                        @if($dest->is_featured)
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill flex-shrink-0">Featured</span>
                        @endif
                    </div>
                    <div class="small text-muted mb-1">{{ $dest->tagline ?? $dest->slug }}</div>
                    <div class="d-flex gap-2 align-items-center small">
                        <span class="badge bg-light text-dark border">{{ $dest->country }}</span>
                        <span class="fw-bold text-success">{{ $dest->tours_count }} Tours</span>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="button"
                    class="btn btn-sm btn-outline-primary rounded-pill flex-grow-1 btn-touch edit-dest-btn"
                    data-bs-toggle="modal"
                    data-bs-target="#editDestModal"
                    data-action="{{ route('admin.destinations.update', $dest->id) }}"
                    data-name="{{ $dest->name }}"
                    data-country="{{ $dest->country }}"
                    data-tagline="{{ $dest->tagline }}"
                    data-banner="{{ $dest->banner_image }}"
                    data-description="{{ $dest->description }}"
                    data-featured="{{ $dest->is_featured ? '1' : '0' }}">
                    <i class="fas fa-edit me-1"></i> Edit
                </button>
                <form action="{{ route('admin.destinations.destroy', $dest->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this destination?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 btn-touch" title="Delete">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="admin-mobile-card text-center text-muted py-5">
            No destinations found.
        </div>
    @endforelse

    @if($destinations->hasPages())
        <div class="pt-2">
            {{ $destinations->links('pagination::bootstrap-5') }}
        </div>
    @endif
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
                        <label class="form-label small fw-bold text-muted">Destination Name *</label>
                        <input type="text" name="name" class="form-control rounded-3" placeholder="e.g. Srimangal" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Country *</label>
                        <input type="text" name="country" class="form-control rounded-3" value="Bangladesh" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Tagline</label>
                        <input type="text" name="tagline" class="form-control rounded-3" placeholder="e.g. Emerald Rolling Hills">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Banner Image Path</label>
                        <input type="text" name="banner_image" class="form-control rounded-3" value="assets/images/sundorbon.png">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Description</label>
                        <textarea name="description" class="form-control rounded-3" rows="3" placeholder="Overview of destination..."></textarea>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_featured" id="modalDestFeatured" value="1" checked>
                        <label class="form-check-label small fw-bold" for="modalDestFeatured">Feature on Homepage</label>
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

<!-- Edit Destination Modal -->
<div class="modal fade" id="editDestModal" tabindex="-1" aria-labelledby="editDestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <form id="editDestForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header border-bottom p-4">
                    <h5 class="modal-title fw-bold" id="editDestModalLabel">Edit Destination</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Destination Name *</label>
                        <input type="text" name="name" id="editDestName" class="form-control rounded-3" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Country *</label>
                        <input type="text" name="country" id="editDestCountry" class="form-control rounded-3" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Tagline</label>
                        <input type="text" name="tagline" id="editDestTagline" class="form-control rounded-3">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Banner Image Path</label>
                        <input type="text" name="banner_image" id="editDestBanner" class="form-control rounded-3">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Description</label>
                        <textarea name="description" id="editDestDescription" class="form-control rounded-3" rows="3"></textarea>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_featured" id="editDestFeatured" value="1">
                        <label class="form-check-label small fw-bold" for="editDestFeatured">Feature on Homepage</label>
                    </div>
                </div>
                <div class="modal-footer border-top p-3">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('extra_js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.edit-dest-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.getElementById('editDestForm').action = this.dataset.action;
            document.getElementById('editDestName').value = this.dataset.name || '';
            document.getElementById('editDestCountry').value = this.dataset.country || '';
            document.getElementById('editDestTagline').value = this.dataset.tagline || '';
            document.getElementById('editDestBanner').value = this.dataset.banner || '';
            document.getElementById('editDestDescription').value = this.dataset.description || '';
            document.getElementById('editDestFeatured').checked = this.dataset.featured === '1';
        });
    });
});
</script>
@endsection
