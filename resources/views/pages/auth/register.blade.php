<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an Account | Bongo Tanbo Travels</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.webp') }}" type="image/x-icon">

    <!-- Bootstrap 5 & Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #0e1b27 0%, #121915 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .register-card {
            background: #ffffff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(0,0,0,0.3);
            max-width: 460px;
            width: 100%;
        }
        .btn-theme {
            background-color: #809e40;
            color: #ffffff;
            font-weight: 700;
            border-radius: 50px;
            padding: 12px;
            transition: all 0.3s;
        }
        .btn-theme:hover {
            background-color: #6d8833;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="register-card p-4 p-sm-5">
        <!-- Logo & Branding -->
        <div class="text-center mb-4">
            <a href="{{ route('home') }}">
                <img src="{{ asset('assets/images/logo.webp') }}" alt="Bongo Tanbo Logo" width="60" height="60" class="mb-2">
            </a>
            <h3 class="fw-bold mb-1" style="font-family: 'Outfit', sans-serif; color: #004d38;">Bongo Tanbo Travels</h3>
            <p class="text-muted fs-7">Create Your Traveler Account</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger py-2 px-3 fs-7 mb-3 rounded-3">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.submit') }}" method="POST">
            @csrf

            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label fs-7 fw-bold text-muted">Full Name</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="far fa-user"></i></span>
                    <input type="text" class="form-control bg-light border-start-0" id="name" name="name" value="{{ old('name') }}" placeholder="e.g. John Doe" required autofocus>
                </div>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label fs-7 fw-bold text-muted">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="far fa-envelope"></i></span>
                    <input type="email" class="form-control bg-light border-start-0" id="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required>
                </div>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label fs-7 fw-bold text-muted">Password (Min 8 characters)</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control bg-light border-start-0" id="password" name="password" placeholder="••••••••" required>
                </div>
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="form-label fs-7 fw-bold text-muted">Confirm Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-check-double"></i></span>
                    <input type="password" class="form-control bg-light border-start-0" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="btn btn-theme w-100 shadow-sm mb-3">
                <i class="fas fa-user-plus me-1"></i> Register Account
            </button>

            <div class="text-center fs-7 text-muted">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-success fw-bold text-decoration-none">Sign In</a>
            </div>
        </form>

        <div class="text-center mt-4 pt-3 border-top">
            <a href="{{ route('home') }}" class="text-muted fs-8 text-decoration-none">
                <i class="fas fa-arrow-left me-1"></i> Back to Homepage
            </a>
        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
