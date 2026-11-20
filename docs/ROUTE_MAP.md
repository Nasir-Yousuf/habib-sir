# Route Map: Bongo Tanbo Travels (Blade Architecture)

All routes are registered in `routes/web.php` and map directly to specific controller actions.

---

## 1. Public Visitor Routes

| Method | URI | Route Name | Controller & Action | Blade View | Description |
| :--- | :--- | :--- | :--- | :--- | :--- |
| `GET` | `/` | `home` | `Public\HomeController@index` | `pages.public.home` | Full homepage with hero slider, booking filter bar, showcase, why choose us, 8 tour packages, deals, 11 categories, collage, and blogs. |
| `GET` | `/about` | `about` | `Public\AboutController@index` | `pages.public.about` | About Bongo Tanbo, Bangladesh–Japan joint venture story, values, team, and BTB verification. |
| `GET` | `/tours` | `tours.index` | `Public\TourController@index` | `pages.public.tours.index` | Tour catalog with filters (category, destination, duration), search, and pagination. |
| `GET` | `/tours/{slug}` | `tours.show` | `Public\TourController@show` | `pages.public.tours.show` | Tour details, day-by-day itinerary accordion, inclusions/exclusions, gallery, and booking widget. |
| `GET` | `/destinations` | `destinations.index` | `Public\DestinationController@index` | `pages.public.destinations.index` | All destinations overview. |
| `GET` | `/destinations/{slug}` | `destinations.show` | `Public\DestinationController@show` | `pages.public.destinations.show` | Destination details with related tours. |
| `GET` | `/blog` | `blog.index` | `Public\BlogController@index` | `pages.public.blog.index` | Travel articles and guides with pagination. |
| `GET` | `/blog/{slug}` | `blog.show` | `Public\BlogController@show` | `pages.public.blog.show` | Single travel article. |
| `GET` | `/gallery` | `gallery.index` | `Public\GalleryController@index` | `pages.public.gallery` | Filterable photo gallery. |
| `GET` | `/contact` | `contact.index` | `Public\ContactController@index` | `pages.public.contact` | Contact page with Dhaka & Fukuoka office cards, Google Map, and contact form. |
| `POST` | `/contact` | `contact.store` | `Public\ContactController@store` | Redirect with Flash | Validates and saves contact form submissions. |
| `POST` | `/bookings` | `bookings.store` | `Public\BookingController@store` | Redirect with Flash | Validates and saves booking and tailor-made tour inquiries. |
| `GET` | `/sitemap.xml` | `sitemap` | `Public\SitemapController@index` | XML Response | Dynamic XML sitemap for search engines. |
| `GET` | `/robots.txt` | `robots` | `Public\SitemapController@robots` | Text Response | Search engine crawling directives. |

---

## 2. Authentication Routes

| Method | URI | Route Name | Controller & Action | Blade View | Description |
| :--- | :--- | :--- | :--- | :--- | :--- |
| `GET` | `/login` | `login` | `Auth\LoginController@showLoginForm` | `pages.auth.login` | Admin login form. |
| `POST` | `/login` | `login.submit` | `Auth\LoginController@login` | Redirect | Validates credentials and initiates authenticated session. |
| `POST` | `/logout` | `logout` | `Auth\LoginController@logout` | Redirect | Invalidates session and logs out administrator. |

---

## 3. Protected Administrative Routes (`/admin/*`)
Middleware: `auth`

| Method | URI | Route Name | Controller & Action | Blade View | Description |
| :--- | :--- | :--- | :--- | :--- | :--- |
| `GET` | `/admin/dashboard` | `admin.dashboard` | `Admin\DashboardController@index` | `pages.admin.dashboard` | Analytics overview, counts, pending inquiries, recent activity. |
| `GET` | `/admin/tours` | `admin.tours.index` | `Admin\TourController@index` | `pages.admin.tours.index` | Tour list with search and actions. |
| `GET` | `/admin/tours/create` | `admin.tours.create` | `Admin\TourController@create` | `pages.admin.tours.create` | Tour creation form. |
| `POST` | `/admin/tours` | `admin.tours.store` | `Admin\TourController@store` | Redirect | Save new tour with itinerary and images. |
| `GET` | `/admin/tours/{id}/edit` | `admin.tours.edit` | `Admin\TourController@edit` | `pages.admin.tours.edit` | Edit tour form. |
| `PUT` | `/admin/tours/{id}` | `admin.tours.update` | `Admin\TourController@update` | Redirect | Update tour record. |
| `DELETE` | `/admin/tours/{id}` | `admin.tours.destroy` | `Admin\TourController@destroy` | Redirect | Delete tour. |
| `GET` | `/admin/destinations` | `admin.destinations.index` | `Admin\DestinationController@index` | `pages.admin.destinations.index` | Destination manager. |
| `POST` | `/admin/destinations` | `admin.destinations.store` | `Admin\DestinationController@store` | Redirect | Create destination. |
| `PUT` | `/admin/destinations/{id}` | `admin.destinations.update` | `Admin\DestinationController@update` | Redirect | Update destination. |
| `DELETE` | `/admin/destinations/{id}`| `admin.destinations.destroy`| `Admin\DestinationController@destroy` | Redirect | Delete destination. |
| `GET` | `/admin/categories` | `admin.categories.index` | `Admin\CategoryController@index` | `pages.admin.categories.index` | Category taxonomy manager. |
| `POST` | `/admin/categories` | `admin.categories.store` | `Admin\CategoryController@store` | Redirect | Create category. |
| `GET` | `/admin/bookings` | `admin.bookings.index` | `Admin\BookingController@index` | `pages.admin.bookings.index` | Inbound booking inquiries with filter by status. |
| `PATCH` | `/admin/bookings/{id}` | `admin.bookings.updateStatus` | `Admin\BookingController@updateStatus` | Redirect | Update booking status (`confirmed`, `cancelled`, etc.). |
| `GET` | `/admin/messages` | `admin.messages.index` | `Admin\MessageController@index` | `pages.admin.messages.index` | Contact message inbox. |
| `PATCH` | `/admin/messages/{id}` | `admin.messages.markRead` | `Admin\MessageController@markRead` | Redirect | Toggle message read status. |
| `DELETE` | `/admin/messages/{id}` | `admin.messages.destroy` | `Admin\MessageController@destroy` | Redirect | Delete contact message. |
| `POST` | `/admin/cache/clear` | `admin.cache.clear` | `Admin\DashboardController@clearCache` | Redirect | Flush application data cache manually. |
