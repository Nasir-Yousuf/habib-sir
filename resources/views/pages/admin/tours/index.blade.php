@extends('layouts.admin')

@section('title', 'Manage Tour Packages')
@section('header_title', 'Tour Packages Catalog')

@section('content')
<div class="card border-0 shadow-sm rounded-4 p-3 p-md-4 bg-white mb-4">
    <div class="row g-3 align-items-center">
        <div class="col-12 col-lg-8">
            <form action="{{ route('admin.tours.index') }}" method="GET" class="row g-2 align-items-center">
                <div class="col-12 col-sm-5">
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" class="form-control" placeholder="Search tours..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-outline-secondary" aria-label="Search"><i class="fas fa-search"></i></button>
                    </div>
                </div>

                <div class="col-8 col-sm-4">
                    <select name="category_id" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                @if(request()->anyFilled(['search', 'category_id']))
                    <div class="col-4 col-sm-3">
                        <a href="{{ route('admin.tours.index') }}" class="btn btn-sm btn-outline-danger w-100 btn-touch">Reset</a>
                    </div>
                @endif
            </form>
        </div>

        <div class="col-12 col-lg-4 text-lg-end">
            <a href="{{ route('admin.tours.create') }}" class="btn btn-success rounded-pill px-4 w-100 w-lg-auto btn-touch">
                <i class="fas fa-plus me-1"></i> Create Tour Package
            </a>
        </div>
    </div>
</div>

<!-- Desktop Tours Table (md and up) -->
<div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden d-none d-md-block">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light small text-uppercase text-muted">
                <tr>
                    <th>Cover</th>
                    <th>Title &amp; Destination</th>
                    <th>Category</th>
                    <th>Duration</th>
                    <th>Starting Price</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody class="small">
                @forelse($tours as $tour)
                    <tr>
                        <td style="width: 70px;">
                            <img src="{{ asset($tour->featured_image ?? 'assets/images/package-1.webp') }}" alt="{{ $tour->title }}" class="rounded-3 object-fit-cover" width="60" height="45" loading="lazy">
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $tour->title }}</div>
                            <span class="text-muted">
                                <i class="fas fa-map-marker-alt text-danger me-1"></i> {{ $tour->destination->name ?? 'General' }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border">{{ $tour->category->name ?? 'None' }}</span>
                        </td>
                        <td>
                            <span class="text-muted">{{ $tour->duration_days }} Days / {{ $tour->places_count }} Places</span>
                        </td>
                        <td>
                            @if($tour->starting_price)
                                <span class="fw-bold text-success">৳{{ number_format($tour->starting_price) }}</span>
                            @else
                                <span class="text-muted">Contact</span>
                            @endif
                        </td>
                        <td>
                            @if($tour->is_active)
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill">Active</span>
                            @else
                                <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill">Draft</span>
                            @endif
                            @if($tour->is_featured)
                                <span class="badge bg-warning bg-opacity-25 text-warning rounded-pill">Featured</span>
                            @endif
                        </td>
                        <td class="text-end text-nowrap">
                            <a href="{{ route('tours.show', $tour->slug) }}" target="_blank" class="btn btn-sm btn-outline-info rounded-pill me-1" title="Preview Public Page">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.tours.edit', $tour->id) }}" class="btn btn-sm btn-outline-primary rounded-pill me-1" title="Edit Tour">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.tours.destroy', $tour->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this tour package?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill" title="Delete Tour">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">No tour packages found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-3 border-top d-flex justify-content-center">
        {{ $tours->links('pagination::bootstrap-5') }}
    </div>
</div>

<!-- Mobile Tour Cards (< 768px) -->
<div class="d-md-none d-flex flex-column gap-3">
    @forelse($tours as $tour)
        <div class="admin-mobile-card">
            <div class="d-flex gap-3 mb-3">
                <img src="{{ asset($tour->featured_image ?? 'assets/images/package-1.webp') }}" alt="{{ $tour->title }}" class="rounded-3 object-fit-cover flex-shrink-0" width="76" height="76" loading="lazy">
                <div class="min-w-0 flex-grow-1">
                    <div class="d-flex flex-wrap gap-1 mb-1">
                        @if($tour->is_active)
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill">Active</span>
                        @else
                            <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill">Draft</span>
                        @endif
                        @if($tour->is_featured)
                            <span class="badge bg-warning bg-opacity-25 text-warning rounded-pill">Featured</span>
                        @endif
                    </div>
                    <h6 class="fw-bold text-dark mb-1">{{ $tour->title }}</h6>
                    <div class="text-muted small">
                        <i class="fas fa-map-marker-alt text-danger me-1"></i> {{ $tour->destination->name ?? 'General' }}
                    </div>
                </div>
            </div>

            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 py-2 px-3 bg-light rounded-3 small mb-3">
                <span class="text-muted"><i class="far fa-clock me-1"></i> {{ $tour->duration_days }} Days ({{ $tour->places_count }} Places)</span>
                @if($tour->starting_price)
                    <strong class="text-success">৳{{ number_format($tour->starting_price) }}</strong>
                @else
                    <span class="text-muted">Custom Price</span>
                @endif
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('admin.tours.edit', $tour->id) }}" class="btn btn-sm btn-outline-primary rounded-pill flex-grow-1 btn-touch">
                    <i class="fas fa-edit me-1"></i> Edit
                </a>
                <a href="{{ route('tours.show', $tour->slug) }}" target="_blank" class="btn btn-sm btn-outline-info rounded-pill px-3 btn-touch" title="Preview">
                    <i class="fas fa-eye"></i>
                </a>
                <form action="{{ route('admin.tours.destroy', $tour->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this tour package?');">
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
            No tour packages found.
        </div>
    @endforelse

    @if($tours->hasPages())
        <div class="pt-2">
            {{ $tours->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
