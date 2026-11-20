<header class="header-section">
    <!-- Top Information Bar -->
    <div class="header-top-section">
        <div class="container-fluid px-lg-5">
            <div class="header-top-wrapper">
                <!-- Left Info: Email & Fixed Address -->
                <ul class="top-left d-flex align-items-center mb-0 ps-0">
                    <li class="d-flex align-items-center me-4">
                        <i class="far fa-envelope me-2" aria-hidden="true"></i>
                        <a href="mailto:bongotanbo@gmail.com" title="Email us">bongotanbo@gmail.com</a>
                    </li>
                    <li class="d-none d-lg-flex align-items-center">
                        <i class="fas fa-map-marker-alt me-2" aria-hidden="true"></i>
                        <span class="header-address">Fukuoka Ken Fukuoka City Chuo-ku-Kego 2-9-10-201 Japan | House No. 6 Road No. 8 Sector 11 Uttara, Dhaka 1230</span>
                    </li>
                </ul>

                <!-- Right Info: Social Links & Language Dropdown -->
                <div class="header-top-right d-flex align-items-center gap-3">
                    <div class="social-icon d-flex align-items-center gap-2">
                        <a href="https://www.facebook.com/profile.php?id=61590056545286" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/bongotanbo.1952991" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="https://wa.me/+8801577509112" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                    </div>

                    <!-- Language Switcher -->
                    <div class="language-dropdown dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle d-flex align-items-center gap-2 text-white" id="langDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-globe"></i>
                            <span>English</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="langDropdown">
                            <li><a class="dropdown-item d-flex align-items-center gap-2" href="#"><img src="{{ asset('assets/images/flag-en.avif') }}" alt="EN" width="18" height="12"> English</a></li>
                            <li><a class="dropdown-item d-flex align-items-center gap-2" href="#"><img src="{{ asset('assets/images/flag-bd.png') }}" alt="BD" width="18"> বাংলা</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar (Sticky) -->
    <div class="header-main-nav" id="headerNav">
        <div class="container-fluid px-lg-5">
            <div class="mega-menu-wrapper">
                <div class="header-main">
                    <!-- Brand Logo -->
                    <div class="header-left">
                        <a href="{{ route('home') }}" class="header-logo d-flex align-items-center gap-2" title="Bongo Tanbo Travels Home">
                            <img src="{{ asset('assets/images/logo.webp') }}" alt="Bongo Tanbo Travels Logo" width="52" height="52">
                            <h3 class="header-brand-title d-none d-sm-inline mb-0">Bongo Tanbo Travels</h3>
                        </a>
                    </div>

                    <!-- Desktop Nav Links -->
                    <div class="main-menu d-none d-xl-block">
                        <nav aria-label="Main Navigation">
                            <ul>
                                <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                                    <a href="{{ route('home') }}"><span>Home</span></a>
                                </li>

                                <li class="has-dropdown {{ request()->routeIs('about') ? 'active' : '' }}">
                                    <a href="{{ route('about') }}">
                                        <span>About Us</span>
                                        <i class="fas fa-chevron-down ms-1"></i>
                                    </a>
                                    <ul class="submenu shadow-lg">
                                        <li><a href="{{ route('about') }}">About Bongo Tanbo</a></li>
                                        <li><a href="{{ route('home') }}#riverine-section">About Bangladesh</a></li>
                                        <li><a href="{{ route('home') }}#choose-us">About Partners</a></li>
                                        <li><a href="{{ route('home') }}#footer">FAQ</a></li>
                                    </ul>
                                </li>

                                <li class="has-dropdown {{ request()->routeIs('tours.*') ? 'active' : '' }}">
                                    <a href="{{ route('tours.index') }}">
                                        <span>Tour Packages</span>
                                        <i class="fas fa-chevron-down ms-1"></i>
                                    </a>
                                    <ul class="submenu shadow-lg">
                                        <li><a href="{{ route('tours.index') }}">All Tour Packages</a></li>
                                        <li><a href="{{ route('tours.index', ['category' => 'inbound-tour-packages']) }}">Inbound Packages</a></li>
                                        <li><a href="{{ route('tours.index', ['category' => 'outbound-tour-packages']) }}">Outbound Packages</a></li>
                                        <li><a href="{{ route('tours.index', ['category' => 'domestic-tour-packages']) }}">Domestic Packages</a></li>
                                        <li><a href="{{ route('tours.index', ['category' => 'specialized-tour-package']) }}">Specialized Packages</a></li>
                                        <li><a href="{{ route('tours.index', ['category' => 'bird-watching-tours']) }}">Bird Watching Tours</a></li>
                                        <li><a href="{{ route('tours.index', ['category' => 'trekking-packages']) }}">Trekking Packages</a></li>
                                        <li><a href="{{ route('tours.index', ['category' => 'photography-tours']) }}">Photography Tours</a></li>
                                        <li><a href="{{ route('tours.index', ['category' => 'festival-packages']) }}">Festival Packages</a></li>
                                        <li><a href="{{ route('tours.index', ['category' => 'family-packages']) }}">Family Packages</a></li>
                                    </ul>
                                </li>

                                <li class="{{ request()->routeIs('destinations.*') ? 'active' : '' }}">
                                    <a href="{{ route('destinations.index') }}"><span>Destinations</span></a>
                                </li>

                                <li class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">
                                    <a href="{{ route('blog.index') }}"><span>Travel Blog</span></a>
                                </li>

                                <li class="{{ request()->routeIs('gallery.index') ? 'active' : '' }}">
                                    <a href="{{ route('gallery.index') }}"><span>Gallery</span></a>
                                </li>

                                <li class="{{ request()->routeIs('contact.index') ? 'active' : '' }}">
                                    <a href="{{ route('contact.index') }}"><span>Contact</span></a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                    <!-- Action Controls -->
                    <div class="header-actions d-flex align-items-center gap-3">
                        <a href="{{ route('tours.index') }}" class="book-btn" title="Book your tailored tour">
                            <i class="far fa-calendar-check me-1"></i> Book Now
                        </a>

                        @auth
                            <a href="{{ route('admin.dashboard') }}" class="login-btn d-none d-sm-inline-flex" title="Admin Dashboard">
                                <i class="fas fa-tachometer-alt me-1"></i> Admin
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="login-btn d-none d-sm-inline-flex" title="Admin Login">
                                <i class="far fa-user me-1"></i> Login
                            </a>
                        @endauth

                        <button class="search-toggle" id="searchOpenBtn" aria-label="Open search modal" title="Search tours">
                            <i class="fas fa-search"></i>
                        </button>

                        <button class="sidebar__toggle d-xl-none" id="mobileToggleBtn" aria-label="Toggle navigation drawer">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
