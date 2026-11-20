@extends('layouts.admin')

@section('title', 'Contact Form Messages')
@section('header_title', 'Contact Inquiries Inbox')

@section('content')
<div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
        <!-- Filter Form -->
        <form action="{{ route('admin.messages.index') }}" method="GET" class="d-flex gap-2">
            <select name="is_read" class="form-select form-select-sm" style="max-width: 180px;" onchange="this.form.submit()">
                <option value="">All Messages</option>
                <option value="0" {{ request('is_read') === '0' ? 'selected' : '' }}>Unread Only</option>
                <option value="1" {{ request('is_read') === '1' ? 'selected' : '' }}>Read</option>
            </select>
            @if(request()->has('is_read'))
                <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-outline-danger">Reset</a>
            @endif
        </form>

        <span class="text-muted fs-7">{{ $messages->total() }} Total Messages</span>
    </div>
</div>

<!-- Messages List -->
<div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light fs-8 text-uppercase text-muted">
                <tr>
                    <th>Status</th>
                    <th>Sender</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Received</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody class="fs-7">
                @forelse($messages as $msg)
                    <tr class="{{ !$msg->is_read ? 'table-warning bg-opacity-25' : '' }}">
                        <td>
                            @if(!$msg->is_read)
                                <span class="badge bg-danger rounded-pill fs-8">Unread</span>
                            @else
                                <span class="badge bg-light text-muted border rounded-pill fs-8">Read</span>
                            @endif
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $msg->name }}</div>
                            <div class="fs-8 text-muted"><i class="far fa-envelope me-1"></i> {{ $msg->email }}</div>
                            @if($msg->phone)
                                <div class="fs-8 text-muted"><i class="fas fa-phone me-1"></i> {{ $msg->phone }}</div>
                            @endif
                        </td>
                        <td>
                            <span class="fw-semibold text-dark">{{ $msg->subject ?? 'General Inquiry' }}</span>
                        </td>
                        <td style="max-width: 320px;">
                            <p class="text-muted mb-0 leading-relaxed">{{ $msg->message }}</p>
                        </td>
                        <td>
                            <span class="text-muted fs-8">{{ $msg->created_at->format('M d, Y') }}<br />{{ $msg->created_at->format('h:i A') }}</span>
                        </td>
                        <td class="text-end">
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
@endsection
