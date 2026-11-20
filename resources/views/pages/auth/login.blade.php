<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Login | Bongo Tanbo Travels</title>
    
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
        .login-card {
            background: #ffffff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(0,0,0,0.3);
            max-width: 440px;
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
    <div class="login-card p-4 p-sm-5">
        <!-- Logo & Branding -->
        <div class="text-center mb-4">
            <a href="{{ route('home') }}">
                <img src="{{ asset('assets/images/logo.webp') }}" alt="Bongo Tanbo Logo" width="65" height="65" class="mb-2">
            </a>
            <h3 class="fw-bold mb-1" style="font-family: 'Outfit', sans-serif; color: #004d38;">Bongo Tanbo Travels</h3>
            <p class="text-muted fs-7">Administrative Control Panel</p>
        </div>

        @include('components.alert')

        <!-- Login Form -->
        <form action="{{ route('login.submit') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label fs-7 fw-bold text-muted">Administrator Email</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="far fa-envelope text-muted"></i></span>
                    <input type="email" name="email" id="email" class="form-control border-start-0 shadow-none" placeholder="admin@bongotanbo.com" required autofocus value="{{ old('email', 'admin@bongotanbo.com') }}">
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fs-7 fw-bold text-muted">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-lock text-muted"></i></span>
                    <input type="password" name="password" id="password" class="form-control border-start-0 shadow-none" placeholder="••••••••" required value="password">
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4 fs-7">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" checked>
                    <label class="form-check-label text-muted" for="remember">Keep me logged in</label>
                </div>
            </div>

            <button type="submit" class="btn btn-theme w-100 mb-3">
                <span>Sign In to Dashboard</span> <i class="fas fa-arrow-right ms-2"></i>
            </button>

            <div class="p-3 bg-light rounded-3 text-center fs-8 text-muted border">
                <i class="fas fa-info-circle text-success me-1"></i> <b>Seed Credentials:</b><br />
                Email: <code>admin@bongotanbo.com</code> | Password: <code>password</code>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('home') }}" class="text-decoration-none fs-7 text-muted">
                    <i class="fas fa-arrow-left me-1"></i> Return to Homepage
                </a>
            </div>
        </form>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
