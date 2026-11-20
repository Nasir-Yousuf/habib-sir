<div class="mobile-offcanvas-overlay" id="mobileOverlay"></div>
<aside class="mobile-offcanvas" id="mobileOffcanvas" aria-label="Mobile Navigation Drawer">
    <!-- Top Row: Logo & Close Button -->
    <div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
        <a href="{{ route('home') }}" class="d-flex align-items-center gap-2">
            <img src="{{ asset('assets/images/logo.webp') }}" alt="Logo" width="40" height="40">
            <span class="fw-bold text-dark fs-6">Bongo Tanbo</span>
        </a>
        <button class="offcanvas-close-btn" id="mobileCloseBtn" aria-label="Close menu">&times;</button>
    </div>

    <!-- Mobile Nav Links -->
    <div class="mobile-nav-links">
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li>
                <a href="#" class="mobile-dropdown-toggle">About Us <i class="fas fa-chevron-down"></i></a>
                <ul class="mobile-submenu">
                    <li><a href="{{ route('about') }}">About Bongo Tanbo</a></li>
                    <li><a href="{{ route('home') }}#riverine-section">About Bangladesh</a></li>
                    <li><a href="{{ route('home') }}#choose-us">About Partners</a></li>
                    <li><a href="{{ route('home') }}#footer">FAQ</a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="mobile-dropdown-toggle">Tour Packages <i class="fas fa-chevron-down"></i></a>
                <ul class="mobile-submenu">
                    <li><a href="{{ route('tours.index') }}">All Tour Packages</a></li>
                    <li><a href="{{ route('tours.index', ['category' => 'inbound-tour-packages']) }}">Inbound Packages</a></li>
                    <li><a href="{{ route('tours.index', ['category' => 'outbound-tour-packages']) }}">Outbound Packages</a></li>
                    <li><a href="{{ route('tours.index', ['category' => 'domestic-tour-packages']) }}">Domestic Packages</a></li>
                    <li><a href="{{ route('tours.index', ['category' => 'specialized-tour-package']) }}">Specialized Packages</a></li>
                </ul>
            </li>
            <li><a href="{{ route('destinations.index') }}">Destinations</a></li>
            <li><a href="{{ route('blog.index') }}">Travel Blog</a></li>
            <li><a href="{{ route('gallery.index') }}">Gallery</a></li>
            <li><a href="{{ route('contact.index') }}">Contact</a></li>
            @auth
                @if(Auth::user()->role === 'admin')
                    <li><a href="{{ route('admin.dashboard') }}" class="text-success fw-bold"><i class="fas fa-user-shield me-1"></i> Admin Dashboard</a></li>
                @else
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link text-danger p-0 fw-bold fs-7 text-decoration-none">
                                <i class="fas fa-sign-out-alt me-1"></i> Logout ({{ Auth::user()->name }})
                            </button>
                        </form>
                    </li>
                @endif
            @else
                <li><a href="{{ route('login') }}"><i class="far fa-user me-1"></i> Sign In</a></li>
                <li><a href="{{ route('register') }}" class="text-success fw-bold"><i class="fas fa-user-plus me-1"></i> Create Account</a></li>
            @endauth
        </ul>
    </div>

    <!-- Mobile Contact & Social Details -->
    <div class="mt-4 pt-3 border-top">
        <a href="{{ route('tours.index') }}" class="theme-btn w-100 justify-content-center mb-3">
            Book Now <i class="far fa-calendar-check ms-1"></i>
        </a>
        <div class="d-flex flex-column gap-2 text-muted fs-7">
            <div><i class="far fa-envelope text-success me-2"></i> bongotanbo@gmail.com</div>
            <div><i class="fas fa-phone text-success me-2"></i> +88028991482</div>
            <div><i class="fab fa-whatsapp text-success me-2"></i> +8801577509112</div>
        </div>
    </div>
</aside>
