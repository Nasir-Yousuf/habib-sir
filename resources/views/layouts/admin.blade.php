<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Admin Dashboard') | Bongo Tanbo Travels</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.webp') }}" type="image/x-icon">

    <!-- Bootstrap 5 & Icons -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Outfit:wght@500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --admin-primary: #809e40;
            --admin-dark: #0e1b27;
            --admin-sidebar-bg: #121915;
            --admin-sidebar-width: 260px;
        }
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f4f6f9;
            color: #333;
            overflow-x: hidden;
        }
        
        /* Layout Structure */
        .admin-wrapper {
            display: flex;
            min-height: 100vh;
            width: 100%;
            position: relative;
        }
        
        /* Desktop Sidebar */
        .admin-sidebar {
            width: var(--admin-sidebar-width);
            min-height: 100vh;
            background-color: var(--admin-sidebar-bg);
            color: #cfd8d3;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            flex-shrink: 0;
            z-index: 1040;
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        
        .admin-sidebar::-webkit-scrollbar {
            width: 4px;
        }
        .admin-sidebar::-webkit-scrollbar-thumb {
            background-color: rgba(255, 255, 255, 0.15);
            border-radius: 4px;
        }

        .admin-sidebar .nav-link {
            color: #a0aec0;
            padding: 12px 18px;
            border-radius: 8px;
            margin: 4px 10px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.2s;
        }
        .admin-sidebar .nav-link:hover, 
        .admin-sidebar .nav-link.active {
            color: #ffffff;
            background-color: rgba(128, 158, 64, 0.25);
            border-left: 4px solid var(--admin-primary);
        }
        .admin-sidebar .nav-link i {
            font-size: 18px;
            width: 24px;
            text-align: center;
        }

        /* Main Workspace Container */
        .admin-main {
            flex-grow: 1;
            min-width: 0; /* Crucial: allows flex child to shrink properly without overflowing */
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f4f6f9;
            width: calc(100% - var(--admin-sidebar-width));
        }

        .admin-header {
            background-color: #ffffff;
            height: 70px;
            border-bottom: 1px solid #e2e8f0;
            position: sticky;
            top: 0;
            z-index: 1020;
        }

        .admin-content {
            padding: 24px;
            flex-grow: 1;
            width: 100%;
        }

        /* Stat Cards */
        .stat-card {
            border-radius: 16px;
            border: none;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04);
            transition: transform 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-3px);
        }

        /* Badges */
        .badge-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        .badge-confirmed {
            background-color: #d4edda;
            color: #155724;
        }
        .badge-cancelled {
            background-color: #f8d7da;
            color: #721c24;
        }

        /* Responsive Table Optimization */
        .table-responsive {
            -webkit-overflow-scrolling: touch;
            border-radius: 12px;
        }
        .table-responsive table {
            min-width: 680px; /* Guarantees data readability on small phones with horizontal scroll */
        }

        /* Mobile Backdrop Overlay */
        .admin-backdrop {
            position: fixed;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.55);
            backdrop-filter: blur(2px);
            z-index: 1035;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        /* Mobile Card & Touch Target Helpers */
        .admin-mobile-card {
            background: #ffffff;
            border: 1px solid #edf2f7;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
            padding: 16px;
        }
        .pagination {
            flex-wrap: wrap;
            justify-content: center;
            gap: 4px;
            margin-bottom: 0;
        }

        /* ==========================================================================
           MOBILE & TABLET BREAKPOINTS (< 992px)
           ========================================================================== */
        @media (max-width: 991.98px) {
            .admin-sidebar {
                position: fixed;
                top: 0;
                left: 0;
                bottom: 0;
                width: 280px;
                height: 100vh;
                z-index: 1050;
                transform: translateX(-100%);
                box-shadow: 4px 0 25px rgba(0, 0, 0, 0.35);
            }
            body.admin-sidebar-open .admin-sidebar {
                transform: translateX(0);
            }
            body.admin-sidebar-open .admin-backdrop {
                opacity: 1;
                visibility: visible;
            }
            body.admin-sidebar-open {
                overflow: hidden; /* Prevent background scroll while menu is open */
            }

            .admin-main {
                width: 100%; /* Full screen on mobile */
            }

            .admin-header {
                height: 60px;
                padding-left: 14px !important;
                padding-right: 14px !important;
            }

            .admin-content {
                padding: 14px !important;
            }
        }

        @media (max-width: 767.98px) {
            .admin-content .form-control-sm,
            .admin-content .form-select-sm {
                min-height: 38px;
                font-size: 14px;
            }
            .admin-content .btn-touch {
                min-height: 38px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar Navigation Drawer -->
        <aside class="admin-sidebar d-flex flex-column p-3" id="adminSidebar">
            <!-- Sidebar Header with Logo & Mobile Close Button -->
            <div class="d-flex align-items-center justify-content-between mb-3 px-2 pt-1">
                <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-2 text-white text-decoration-none">
                    <img src="{{ asset('assets/images/logo.webp') }}" alt="Logo" width="38" height="38">
                    <div>
                        <span class="fs-6 fw-bold d-block text-white" style="line-height: 1.1;">Bongo Tanbo</span>
                        <span class="text-success fw-semibold" style="font-size: 11px;">Administration</span>
                    </div>
                </a>
                <!-- Mobile Close Button -->
                <button type="button" class="btn btn-sm btn-link text-white-50 d-lg-none p-1" id="adminSidebarClose" aria-label="Close Sidebar">
                    <i class="fas fa-times fs-5"></i>
                </button>
            </div>
            
            <hr class="text-secondary my-2 opacity-25">

            <!-- Nav Links -->
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-th-large"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.tours.index') }}" class="nav-link {{ request()->routeIs('admin.tours.*') ? 'active' : '' }}">
                        <i class="fas fa-map-marked-alt"></i> <span>Tours Packages</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.destinations.index') }}" class="nav-link {{ request()->routeIs('admin.destinations.*') ? 'active' : '' }}">
                        <i class="fas fa-globe-asia"></i> <span>Destinations</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <i class="fas fa-tags"></i> <span>Categories</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.bookings.index') }}" class="nav-link {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">
                        <i class="fas fa-calendar-check"></i>
                        <span>Bookings</span>
                        @if(($pendingBookingsCount ?? 0) > 0)
                            <span class="badge bg-warning text-dark rounded-pill ms-auto" style="font-size: 11px;">{{ $pendingBookingsCount }}</span>
                        @endif
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.messages.index') }}" class="nav-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                        <i class="fas fa-envelope"></i>
                        <span>Messages</span>
                        @if(($unreadMessagesCount ?? 0) > 0)
                            <span class="badge bg-danger rounded-pill ms-auto" style="font-size: 11px;">{{ $unreadMessagesCount }}</span>
                        @endif
                    </a>
                </li>
            </ul>

            <hr class="text-secondary my-3 opacity-25">

            <!-- Quick Utilities & Logout -->
            <div class="px-2">
                <form action="{{ route('admin.cache.clear') }}" method="POST" class="mb-2">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-secondary w-100 text-start text-white-50">
                        <i class="fas fa-sync-alt me-1"></i> Flush Data Cache
                    </button>
                </form>

                <a href="{{ route('home') }}" target="_blank" class="btn btn-sm btn-outline-success w-100 text-start mb-2">
                    <i class="fas fa-external-link-alt me-1"></i> View Live Site
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger w-100 text-start">
                        <i class="fas fa-sign-out-alt me-1"></i> Log Out
                    </button>
                </form>
            </div>
        </aside>

        <!-- Dark Backdrop for Mobile Drawer -->
        <div class="admin-backdrop" id="adminBackdrop"></div>

        <!-- Main Workspace -->
        <div class="admin-main">
            <!-- Topbar Header -->
            <header class="admin-header d-flex justify-content-between align-items-center px-3 px-lg-4 gap-2">
                <div class="d-flex align-items-center gap-2 min-w-0 flex-grow-1">
                    <!-- Mobile Hamburger Toggle Button -->
                    <button type="button" class="btn btn-light d-lg-none p-2 border rounded-3 flex-shrink-0" id="adminSidebarToggle" aria-label="Open Navigation">
                        <i class="fas fa-bars text-dark"></i>
                    </button>

                    <h1 class="fw-bold fs-6 fs-md-5 text-dark mb-0 text-truncate">
                        @yield('header_title', 'Dashboard Overview')
                    </h1>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-light text-dark px-3 py-2 border rounded-pill d-none d-sm-inline-flex align-items-center">
                        <i class="fas fa-user-circle text-success me-1"></i> {{ Auth::user()->name ?? 'Administrator' }}
                    </span>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline d-lg-none">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger p-2 rounded-circle" title="Log Out">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>
            </header>

            <!-- Page Content -->
            <main class="admin-content">
                @include('components.alert')
                @yield('content')
            </main>

            <!-- Admin Footer -->
            <footer class="p-3 text-center text-muted fs-8 bg-white border-top">
                &copy; {{ date('Y') }} Bongo Tanbo Travels. Administrative Management System.
            </footer>
        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <!-- Mobile Drawer Interaction Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebarToggle = document.getElementById('adminSidebarToggle');
            const sidebarClose = document.getElementById('adminSidebarClose');
            const backdrop = document.getElementById('adminBackdrop');
            const sidebar = document.getElementById('adminSidebar');

            function openSidebar() {
                document.body.classList.add('admin-sidebar-open');
            }

            function closeSidebar() {
                document.body.classList.remove('admin-sidebar-open');
            }

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', openSidebar);
            }
            if (sidebarClose) {
                sidebarClose.addEventListener('click', closeSidebar);
            }
            if (backdrop) {
                backdrop.addEventListener('click', closeSidebar);
            }

            // Close on escape key
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && document.body.classList.contains('admin-sidebar-open')) {
                    closeSidebar();
                }
            });

            // Close when clicking nav-links on mobile
            if (window.innerWidth < 992) {
                const navLinks = sidebar ? sidebar.querySelectorAll('.nav-link') : [];
                navLinks.forEach(link => {
                    link.addEventListener('click', closeSidebar);
                });
            }
        });
    </script>
    @yield('extra_js')
</body>
</html>
