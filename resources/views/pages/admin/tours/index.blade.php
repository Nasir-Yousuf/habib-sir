@extends('layouts.admin')

@section('title', 'Manage Tour Packages')
@section('header_title', 'Tour Packages Catalog')

@section('content')
<div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
        <!-- Search & Filter Form -->
        <form action="{{ route('admin.tours.index') }}" method="GET" class="d-flex flex-wrap gap-2">
            <div class="input-group" style="max-width: 280px;">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Search tours..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-sm btn-outline-secondary"><i class="fas fa-search"></i></button>
            </div>

            <select name="category_id" class="form-select form-select-sm" style="max-width: 200px;" onchange="this.form.submit()">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>

            @if(request()->anyFilled(['search', 'category_id']))
                <a href="{{ route('admin.tours.index') }}" class="btn btn-sm btn-outline-danger">Reset</a>
            @endif
        </form>

        <a href="{{ route('admin.tours.create') }}" class="btn btn-success rounded-pill px-4">
            <i class="fas fa-plus me-1"></i> Create Tour Package
        </a>
    </div>
</div>

<!-- Tours Table -->
<div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light fs-8 text-uppercase text-muted">
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
            <tbody class="fs-7">
                @forelse($tours as $tour)
                    <tr>
                        <td style="width: 70px;">
                            <img src="{{ asset($tour->featured_image ?? 'assets/images/package-1.webp') }}" alt="{{ $tour->title }}" class="rounded-3 object-fit-cover" width="60" height="45">
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $tour->title }}</div>
                            <span class="text-muted fs-8">
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
                                <span class="text-muted fs-8">Contact</span>
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
                        <td class="text-end">
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
@endsection
