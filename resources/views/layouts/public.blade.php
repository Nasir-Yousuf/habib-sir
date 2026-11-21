<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <title>@yield('title', 'Discover Unique Travel Experiences | Bongo Tanbo Travels')</title>
    <meta name="description" content="@yield('meta_description', 'Bongo Tanbo Travels is a premier Bangladesh-Japan joint venture travel agency offering tailor-made inbound, outbound, cultural, and eco tours.')">
    <meta name="theme-color" content="#809e40">

    <!-- Open Graph / Facebook / WhatsApp -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Bongo Tanbo Travels | Bangladesh & Japan Tour Specialist')">
    <meta property="og:description" content="@yield('meta_description', 'Discover unique tailor-made travel packages across Bangladesh and Japan.')">
    <meta property="og:image" content="@yield('meta_image', asset('assets/images/logo.webp'))">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.webp') }}" type="image/x-icon">

    <!-- CSS Frameworks & Google Fonts -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,400;0,600;0,700;0,800;0,900;1,400&family=Outfit:wght@400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,400;1,600&family=Prompt:wght@400;600;700;900&family=Seaweed+Script&family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Custom Brand Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @yield('extra_css')
</head>
<body>
    <!-- Header -->
    @include('components.header')

    <!-- Flash Alert Banners -->
    <div class="pt-3">
        @include('components.alert')
    </div>

    <!-- Main Dynamic Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('components.footer')

    <!-- Fullscreen Search Modal -->
    @include('components.search-modal')

    <!-- Mobile Drawer -->
    @include('components.mobile-drawer')

    <!-- WhatsApp Floating Action Pill -->
    @include('components.whatsapp-pill')

    <!-- Scripts -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @yield('extra_js')
</body>
</html>
