@extends('layouts.admin')

@section('title', 'Manage Categories')
@section('header_title', 'Tour Categories Taxonomy')

@section('content')
<div class="card border-0 shadow-sm rounded-4 p-3 p-sm-4 bg-white mb-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
            <h5 class="fw-bold mb-1">Tour Categories</h5>
            <p class="text-muted fs-7 mb-0">Manage tour classification taxonomy, badges, and sort ordering.</p>
        </div>
        <button type="button" class="btn btn-success rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#addCatModal">
            <i class="fas fa-plus me-1"></i> Add Category
        </button>
    </div>
</div>

<!-- Categories Table -->
<div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light fs-8 text-uppercase text-muted">
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
            <tbody class="fs-7">
                @forelse($categories as $cat)
                    <tr>
                        <td style="width: 60px;">
                            <img src="{{ asset($cat->icon ?? 'assets/images/cat-specialized.webp') }}" alt="{{ $cat->name }}" width="35" height="35" class="rounded">
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $cat->name }}</div>
                            <span class="text-muted fs-8">{{ Str::limit($cat->description, 60) }}</span>
                        </td>
                        <td><span class="text-muted fs-8 font-monospace">{{ $cat->slug }}</span></td>
                        <td><span class="badge bg-light text-dark border">{{ $cat->sort_order }}</span></td>
                        <td><span class="fw-bold text-success">{{ $cat->tours_count }} Tours</span></td>
                        <td>
                            @if($cat->is_active)
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill">Active</span>
                            @else
                                <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill">Inactive</span>
                            @endif
                        </td>
                        <td class="text-end">
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
                        <label class="form-label fs-7 fw-bold text-muted">Category Name *</label>
                        <input type="text" name="name" class="form-control rounded-3" placeholder="e.g. Wildlife Safari" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fs-7 fw-bold text-muted">Icon Asset Path</label>
                        <input type="text" name="icon" class="form-control rounded-3" value="assets/images/cat-specialized.webp">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fs-7 fw-bold text-muted">Sort Order</label>
                        <input type="number" name="sort_order" class="form-control rounded-3" value="0">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fs-7 fw-bold text-muted">Description</label>
                        <textarea name="description" class="form-control rounded-3" rows="3" placeholder="Short description..."></textarea>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" id="modalCatActive" value="1" checked>
                        <label class="form-check-label fs-7 fw-bold" for="modalCatActive">Active</label>
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
@endsection
