@extends('layouts.admin')

@section('title', 'Contact Form Messages')
@section('header_title', 'Contact Inquiries Inbox')

@section('content')
<div class="card border-0 shadow-sm rounded-4 p-3 p-md-4 bg-white mb-4">
    <div class="row g-2 align-items-center">
        <div class="col-12 col-sm-8">
            <form action="{{ route('admin.messages.index') }}" method="GET" class="row g-2 align-items-center">
                <div class="col-8 col-sm-6 col-md-5">
                    <select name="is_read" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="">All Messages</option>
                        <option value="0" {{ request('is_read') === '0' ? 'selected' : '' }}>Unread Only</option>
                        <option value="1" {{ request('is_read') === '1' ? 'selected' : '' }}>Read</option>
                    </select>
                </div>
                @if(request()->has('is_read'))
                    <div class="col-4 col-sm-3">
                        <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-outline-danger w-100 btn-touch">Reset</a>
                    </div>
                @endif
            </form>
        </div>
        <div class="col-12 col-sm-4 text-sm-end">
            <span class="text-muted small">{{ $messages->total() }} Total Messages</span>
        </div>
    </div>
</div>

<!-- Desktop Messages Table (md and up) -->
<div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden d-none d-md-block">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light small text-uppercase text-muted">
                <tr>
                    <th>Status</th>
                    <th>Sender</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Received</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody class="small">
                @forelse($messages as $msg)
                    <tr class="{{ !$msg->is_read ? 'table-warning bg-opacity-25' : '' }}">
                        <td>
                            @if(!$msg->is_read)
                                <span class="badge bg-danger rounded-pill">Unread</span>
                            @else
                                <span class="badge bg-light text-muted border rounded-pill">Read</span>
                            @endif
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $msg->name }}</div>
                            <div><a href="mailto:{{ $msg->email }}" class="text-muted text-decoration-none"><i class="far fa-envelope me-1"></i> {{ $msg->email }}</a></div>
                            @if($msg->phone)
                                <div><a href="tel:{{ $msg->phone }}" class="text-muted text-decoration-none"><i class="fas fa-phone me-1"></i> {{ $msg->phone }}</a></div>
                            @endif
                        </td>
                        <td>
                            <span class="fw-semibold text-dark">{{ $msg->subject ?? 'General Inquiry' }}</span>
                        </td>
                        <td style="max-width: 320px;">
                            <p class="text-muted mb-0 leading-relaxed">{{ $msg->message }}</p>
                        </td>
                        <td>
                            <span class="text-muted">{{ $msg->created_at->format('M d, Y') }}<br />{{ $msg->created_at->format('h:i A') }}</span>
                        </td>
                        <td class="text-end text-nowrap">
                            <form action="{{ route('admin.messages.markRead', $msg->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-outline-secondary rounded-pill me-1" title="Toggle Read Status">
                                    <i class="fas {{ $msg->is_read ? 'fa-envelope' : 'fa-envelope-open' }}"></i>
                                </button>
                            </form>

                            <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this message?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill" title="Delete Message">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-5">No contact messages received.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-3 border-top d-flex justify-content-center">
        {{ $messages->links('pagination::bootstrap-5') }}
    </div>
</div>

<!-- Mobile Message Cards (< 768px) -->
<div class="d-md-none d-flex flex-column gap-3">
    @forelse($messages as $msg)
        <div class="admin-mobile-card {{ !$msg->is_read ? 'border-warning' : '' }}">
            <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                @if(!$msg->is_read)
                    <span class="badge bg-danger rounded-pill">Unread</span>
                @else
                    <span class="badge bg-light text-muted border rounded-pill">Read</span>
                @endif
                <span class="small text-muted">{{ $msg->created_at->format('M d, Y · h:i A') }}</span>
            </div>

            <h6 class="fw-bold text-dark mb-1">{{ $msg->name }}</h6>
            <div class="small fw-semibold text-success mb-2">{{ $msg->subject ?? 'General Inquiry' }}</div>

            <p class="small text-muted bg-light p-3 rounded-3 mb-3">{{ $msg->message }}</p>

            <div class="d-flex flex-wrap gap-2 mb-3 small">
                <a href="mailto:{{ $msg->email }}" class="badge bg-light text-dark border text-decoration-none py-2 px-2 text-truncate" style="max-width: 100%;">
                    <i class="far fa-envelope text-primary me-1"></i> {{ $msg->email }}
                </a>
                @if($msg->phone)
                    <a href="tel:{{ $msg->phone }}" class="badge bg-light text-dark border text-decoration-none py-2 px-2">
                        <i class="fas fa-phone text-success me-1"></i> {{ $msg->phone }}
                    </a>
                @endif
            </div>

            <div class="d-flex gap-2">
                <form action="{{ route('admin.messages.markRead', $msg->id) }}" method="POST" class="flex-grow-1">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-sm btn-outline-secondary rounded-pill w-100 btn-touch">
                        <i class="fas {{ $msg->is_read ? 'fa-envelope' : 'fa-envelope-open' }} me-1"></i>
                        {{ $msg->is_read ? 'Mark Unread' : 'Mark Read' }}
                    </button>
                </form>

                <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this message?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 btn-touch" title="Delete Message">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="admin-mobile-card text-center text-muted py-5">
            No contact messages received.
        </div>
    @endforelse

    @if($messages->hasPages())
        <div class="pt-2">
            {{ $messages->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
