@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4 mx-auto container" role="alert" style="max-width: 1100px; border-left: 5px solid #809e40; background-color: #f1f7f1; color: #173e2b;">
        <i class="fas fa-check-circle me-2 text-success"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4 mx-auto container" role="alert" style="max-width: 1100px; border-left: 5px solid #eb4941;">
        <i class="fas fa-exclamation-triangle me-2 text-danger"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(isset($errors) && $errors->any())
    <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4 mx-auto container" role="alert" style="max-width: 1100px;">
        <strong><i class="fas fa-exclamation-circle me-1"></i> Please check the form errors below:</strong>
        <ul class="mb-0 mt-1 ps-3">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
