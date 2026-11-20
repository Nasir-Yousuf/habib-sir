# Folder Structure: Bongo Tanbo Travels (Blade Architecture)

```text
bongotanbo-travels/
│
├── app/                                # Application Core Logic (PHP)
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Public/                 # Public website controllers
│   │   │   │   ├── HomeController.php
│   │   │   │   ├── TourController.php
│   │   │   │   ├── DestinationController.php
│   │   │   │   ├── AboutController.php
│   │   │   │   ├── ContactController.php
│   │   │   │   ├── BookingController.php
│   │   │   │   ├── BlogController.php
│   │   │   │   ├── GalleryController.php
│   │   │   │   └── SitemapController.php
│   │   │   │
│   │   │   ├── Admin/                  # Protected admin controllers
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── TourController.php
│   │   │   │   ├── DestinationController.php
│   │   │   │   ├── CategoryController.php
│   │   │   │   ├── BookingController.php
│   │   │   │   └── MessageController.php
│   │   │   │
│   │   │   └── Auth/                   # Authentication controllers
│   │   │       └── LoginController.php
│   │   │
│   │   ├── Middleware/                 # Session, CSRF, Admin checks
│   │   └── Requests/                   # Validation rules (FormRequest)
│   │       ├── BookingStoreRequest.php
│   │       ├── ContactStoreRequest.php
│   │       └── TourStoreRequest.php
│   │
│   └── Models/                         # Eloquent ORM Models (Active Record)
│       ├── User.php
│       ├── Category.php
│       ├── Destination.php
│       ├── Tour.php
│       ├── TourItinerary.php
│       ├── TourImage.php
│       ├── Booking.php
│       ├── ContactMessage.php
│       ├── Blog.php
│       └── Gallery.php
│
├── bootstrap/                          # Framework bootstrap & providers
│   └── app.php
│
├── config/                             # Application configurations
│   ├── app.php
│   ├── cache.php                       # Cache drivers (file / database)
│   ├── database.php                    # MySQL configuration
│   └── filesystems.php                 # Local / Public storage configuration
│
├── database/                           # Database Schema & Seeders
│   ├── migrations/                     # MySQL table creation migrations (11 tables)
│   └── seeders/                        # Realistic sample data seeders
│       ├── DatabaseSeeder.php
│       ├── UserSeeder.php
│       ├── CategorySeeder.php
│       ├── DestinationSeeder.php
│       ├── TourSeeder.php
│       └── BlogSeeder.php
│
├── public/                             # Public web root
│   ├── assets/                         # Static reference assets
│   │   └── images/                     # 67 official brand images
│   ├── css/                            # Compiled or custom stylesheet
│   ├── js/                             # Compiled or modular vanilla JS
│   ├── index.php                       # PHP front controller
│   └── robots.txt
│
├── resources/                          # Views & Asset Sources
│   ├── css/
│   │   └── app.css                     # Primary styles & design tokens
│   │
│   ├── js/
│   │   └── app.js                      # Vanilla JavaScript enhancements
│   │
│   └── views/                          # Blade Templates & Components
│       ├── layouts/                    # Master layouts
│       │   ├── public.blade.php        # Public website shell (header, footer, modals)
│       │   ├── admin.blade.php         # Admin dashboard shell (sidebar, topbar)
│       │   └── auth.blade.php          # Login page layout
│       │
│       ├── components/                 # Reusable Blade UI components
│       │   ├── header.blade.php        # Top bar + sticky navigation
│       │   ├── footer.blade.php        # 4-column footer + back to top
│       │   ├── search-modal.blade.php  # Fullscreen search modal
│       │   ├── mobile-drawer.blade.php # Offcanvas drawer for mobile
│       │   ├── tour-card.blade.php     # Reusable package card
│       │   ├── booking-filter.blade.php# Floating hero search bar
│       │   └── alert.blade.php         # Flash message alerts
│       │
│       └── pages/                      # Page views
│           ├── public/
│           │   ├── home.blade.php
│           │   ├── about.blade.php
│           │   ├── contact.blade.php
│           │   ├── gallery.blade.php
│           │   ├── tours/
│           │   │   ├── index.blade.php # Catalog with filters
│           │   │   └── show.blade.php  # Details + itinerary + booking widget
│           │   ├── destinations/
│           │   │   ├── index.blade.php
│           │   │   └── show.blade.php
│           │   └── blog/
│           │       ├── index.blade.php
│           │       └── show.blade.php
│           │
│           ├── admin/
│           │   ├── dashboard.blade.php # Metrics & recent activity
│           │   ├── tours/
│           │   │   ├── index.blade.php
│           │   │   ├── create.blade.php
│           │   │   └── edit.blade.php
│           │   ├── destinations/
│           │   │   └── index.blade.php
│           │   ├── categories/
│           │   │   └── index.blade.php
│           │   ├── bookings/
│           │   │   └── index.blade.php
│           │   └── messages/
│           │       └── index.blade.php
│           │
│           └── auth/
│               └── login.blade.php     # Admin login screen
│
├── routes/
│   ├── web.php                         # All web application routes
│   └── console.php
│
├── storage/                            # Media uploads, cache, logs
│
├── docs/                               # Comprehensive project documentation
│
├── .env.example
├── composer.json
├── package.json
└── vite.config.js
```
