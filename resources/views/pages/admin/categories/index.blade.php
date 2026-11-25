@extends('layouts.admin')

@section('title', 'Manage Categories')
@section('header_title', 'Tour Categories Taxonomy')

@section('content')
<div class="card border-0 shadow-sm rounded-4 p-3 p-md-4 bg-white mb-4">
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3">
        <div>
            <h5 class="fw-bold mb-1">Tour Categories</h5>
            <p class="text-muted small mb-0">Manage tour classification taxonomy, badges, and sort ordering.</p>
        </div>
        <button type="button" class="btn btn-success rounded-pill px-4 w-100 w-sm-auto btn-touch" data-bs-toggle="modal" data-bs-target="#addCatModal">
            <i class="fas fa-plus me-1"></i> Add Category
        </button>
    </div>
</div>

<!-- Desktop Categories Table (md and up) -->
<div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden d-none d-md-block">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light small text-uppercase text-muted">
                <tr>
                    <th>Icon</th>
                    <th>Category Name</th>
                    <th>Slug</th>
                    <th>Sort Order</th>
                    <th>Tours Count</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody class="small">
                @forelse($categories as $cat)
                    <tr>
                        <td style="width: 60px;">
                            <img src="{{ asset($cat->icon ?? 'assets/images/cat-specialized.webp') }}" alt="{{ $cat->name }}" width="35" height="35" class="rounded" loading="lazy">
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $cat->name }}</div>
                            <span class="text-muted">{{ Str::limit($cat->description, 60) }}</span>
                        </td>
                        <td><span class="text-muted font-monospace">{{ $cat->slug }}</span></td>
                        <td><span class="badge bg-light text-dark border">{{ $cat->sort_order }}</span></td>
                        <td><span class="fw-bold text-success">{{ $cat->tours_count }} Tours</span></td>
                        <td>
                            @if($cat->is_active)
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill">Active</span>
                            @else
                                <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill">Inactive</span>
                            @endif
                        </td>
                        <td class="text-end text-nowrap">
                            <button type="button"
                                class="btn btn-sm btn-outline-primary rounded-pill me-1 edit-cat-btn"
                                data-bs-toggle="modal"
                                data-bs-target="#editCatModal"
                                data-action="{{ route('admin.categories.update', $cat->id) }}"
                                data-name="{{ $cat->name }}"
                                data-icon="{{ $cat->icon }}"
                                data-sort="{{ $cat->sort_order }}"
                                data-description="{{ $cat->description }}"
                                data-active="{{ $cat->is_active ? '1' : '0' }}"
                                title="Edit Category">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this category?');">
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
                        <td colspan="7" class="text-center text-muted py-5">No categories found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-3 border-top d-flex justify-content-center">
        {{ $categories->links('pagination::bootstrap-5') }}
    </div>
</div>

<!-- Mobile Category Cards (< 768px) -->
<div class="d-md-none d-flex flex-column gap-3">
    @forelse($categories as $cat)
        <div class="admin-mobile-card">
            <div class="d-flex align-items-center gap-3 mb-2">
                <img src="{{ asset($cat->icon ?? 'assets/images/cat-specialized.webp') }}" alt="{{ $cat->name }}" width="44" height="44" class="rounded flex-shrink-0" loading="lazy">
                <div class="min-w-0 flex-grow-1">
                    <div class="d-flex justify-content-between align-items-center gap-2">
                        <h6 class="fw-bold text-dark mb-0 text-truncate">{{ $cat->name }}</h6>
                        @if($cat->is_active)
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill flex-shrink-0">Active</span>
                        @else
                            <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill flex-shrink-0">Inactive</span>
                        @endif
                    </div>
                    <div class="small text-muted font-monospace text-truncate">{{ $cat->slug }}</div>
                </div>
            </div>

            @if($cat->description)
                <p class="small text-muted mb-2">{{ Str::limit($cat->description, 90) }}</p>
            @endif

            <div class="d-flex justify-content-between align-items-center py-2 px-3 bg-light rounded-3 small mb-3">
                <span class="text-muted">Sort Order: <strong>{{ $cat->sort_order }}</strong></span>
                <span class="fw-bold text-success">{{ $cat->tours_count }} Tours</span>
            </div>

            <div class="d-flex gap-2">
                <button type="button"
                    class="btn btn-sm btn-outline-primary rounded-pill flex-grow-1 btn-touch edit-cat-btn"
                    data-bs-toggle="modal"
                    data-bs-target="#editCatModal"
                    data-action="{{ route('admin.categories.update', $cat->id) }}"
                    data-name="{{ $cat->name }}"
                    data-icon="{{ $cat->icon }}"
                    data-sort="{{ $cat->sort_order }}"
                    data-description="{{ $cat->description }}"
                    data-active="{{ $cat->is_active ? '1' : '0' }}">
                    <i class="fas fa-edit me-1"></i> Edit
                </button>
                <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this category?');">
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
            No categories found.
        </div>
    @endforelse

    @if($categories->hasPages())
        <div class="pt-2">
            {{ $categories->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="addCatModal" tabindex="-1" aria-labelledby="addCatModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="modal-header border-bottom p-4">
                    <h5 class="modal-title fw-bold" id="addCatModalLabel">Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Category Name *</label>
                        <input type="text" name="name" class="form-control rounded-3" placeholder="e.g. Wildlife Safari" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Icon Asset Path</label>
                        <input type="text" name="icon" class="form-control rounded-3" value="assets/images/cat-specialized.webp">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Sort Order</label>
                        <input type="number" name="sort_order" class="form-control rounded-3" value="0">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Description</label>
                        <textarea name="description" class="form-control rounded-3" rows="3" placeholder="Short description..."></textarea>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" id="modalCatActive" value="1" checked>
                        <label class="form-check-label small fw-bold" for="modalCatActive">Active</label>
                    </div>
                </div>
                <div class="modal-footer border-top p-3">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success rounded-pill px-4">Create Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCatModal" tabindex="-1" aria-labelledby="editCatModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <form id="editCatForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header border-bottom p-4">
                    <h5 class="modal-title fw-bold" id="editCatModalLabel">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Category Name *</label>
                        <input type="text" name="name" id="editCatName" class="form-control rounded-3" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Icon Asset Path</label>
                        <input type="text" name="icon" id="editCatIcon" class="form-control rounded-3">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Sort Order</label>
                        <input type="number" name="sort_order" id="editCatSort" class="form-control rounded-3">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Description</label>
                        <textarea name="description" id="editCatDescription" class="form-control rounded-3" rows="3"></textarea>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" id="editCatActive" value="1">
                        <label class="form-check-label small fw-bold" for="editCatActive">Active</label>
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
    document.querySelectorAll('.edit-cat-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.getElementById('editCatForm').action = this.dataset.action;
            document.getElementById('editCatName').value = this.dataset.name || '';
            document.getElementById('editCatIcon').value = this.dataset.icon || '';
            document.getElementById('editCatSort').value = this.dataset.sort || 0;
            document.getElementById('editCatDescription').value = this.dataset.description || '';
            document.getElementById('editCatActive').checked = this.dataset.active === '1';
        });
    });
});
</script>
@endsection
