# Bongo Tanbo Travels - Web Application

A full-stack, enterprise-grade, budget-friendly travel agency web application recreating and modernizing **Bongo Tanbo Travels** ([bongotanbotravels.com](https://bongotanbotravels.com/)), the premier Bangladesh–Japan joint venture tour specialist.

Built using **Laravel 12**, **Blade SSR**, **Vanilla JavaScript / Bootstrap 5**, and connected to a remote **TiDB Cloud MySQL cluster**, with automated Docker deployment on **Render Free Tier**.

---

## 🌟 Live Demo & Credentials

- **Live URL**: [https://bongo-tanbo-travels.onrender.com](https://bongo-tanbo-travels.onrender.com)
- **Admin Panel**: [https://bongo-tanbo-travels.onrender.com/admin/dashboard](https://bongo-tanbo-travels.onrender.com/admin/dashboard)
  - **Email**: `admin@bongotanbo.com`
  - **Password**: `admin123`

---

## 🚀 Key Features

### 1. Public Traveler Portal
- **Homepage Showcase**: Full hero carousel, company mission, Japan–Bangladesh joint venture highlights, featured tour packages, destination highlights, testimonials, and blog previews.
- **Tour Catalog & Smart Filters**: Search, category filters (Inbound, Outbound, Domestic, Specialized), duration filters, and sorting.
- **Tour Detail Pages**:
  - Day-by-day itineraries with interactive accordion breakdowns.
  - Price per person, duration, group size, and category tags.
  - Inclusions & Exclusions lists.
  - Real-time booking inquiry modal linked to the database.
- **Destinations Showcase**: Detailed regional pages (Sundarbans, Sreemangal, Kaptai Lake, Japan, etc.) with associated tours.
- **Travel Blog & Articles**: Informative guides for international and domestic tourists.
- **High-Definition Gallery**: Visual tours of landscapes and cultural moments.
- **Interactive Contact & Office Maps**:
  - Bangladesh Liaison Office (Dhaka).
  - Japan Headquarters (Fukuoka).
  - Validated contact inquiry form with anti-spam rate limiting.
- **Responsive Mobile Navigation**: Off-canvas drawer menu tailored for mobile travelers with smooth touch navigation.

### 2. User Authentication & Traveler Accounts
- **Registration (`/register`)**: Open sign-up for travelers with strict validation (unique email, minimum 8-character password).
- **Bcrypt Password Security**: Passwords hashed using standard 12-round Bcrypt (`'password' => 'hashed'`).
- **Smart Role-Based Login (`/login`)**:
  - `admin` users are automatically routed to the **Admin Dashboard** (`/admin/dashboard`).
  - `customer` users are routed to their personal browsing experience.
- **Header & Mobile Drawer Context**: Dynamic display showing traveler names, quick booking access, admin badges, and secure logout.

### 3. Comprehensive Admin Dashboard (`/admin`)
- **Metrics Overview**: Real-time counter of total bookings, unread messages, active tours, and featured destinations.
- **Tour Package Management**: Full CRUD (Create, Read, Update, Delete) for tour itineraries, prices, duration, highlights, and images.
- **Destination Management**: Create and curate destination guides with banner imagery.
- **Category Management**: Organize packages into custom travel themes.
- **Bookings Management**: Review traveler inquiries, party sizes, special requests, and update reservation status (Pending, Confirmed, Cancelled).
- **Messages Inbox**: Read incoming contact queries with sender details.
- **Mobile-Responsive Admin**: Custom collapsible sidebar with off-canvas hamburger navigation for administrators managing bookings on the go.

---

## 🔒 Security Architecture

The application has been hardened for production:
- **Bcrypt Password Hashing**: Passwords stored securely with 12 rounds of Bcrypt.
- **Anti-Brute Force Rate Limiting**: Authentication routes (`/login`, `/register`) throttled to 5 requests per minute.
- **HTTP Security Headers Middleware**:
  - `X-Frame-Options: SAMEORIGIN` (prevents clickjacking)
  - `X-Content-Type-Options: nosniff` (prevents MIME sniffing)
  - `X-XSS-Protection: 1; mode=block`
  - `Referrer-Policy: strict-origin-when-cross-origin`
  - `Permissions-Policy: camera=(), microphone=(), geolocation=(self)`
  - `Strict-Transport-Security` (HSTS enforced in production)
- **XSS Sanitization Middleware**: Automatically cleans and strips dangerous HTML/JS payloads from all submitted form inputs.
- **CSRF Token Verification**: Every POST/PUT/DELETE request verified with cryptographic CSRF tokens.
- **Role-Based Authorization**: Protected by `admin` route middleware; unauthorized access returns HTTP 403 Forbidden.
- **SSL Reverse Proxy Compatibility**: Configured `trustProxies(at: '*')` and `URL::forceScheme('https')` to prevent mixed-content blocks when deployed behind cloud load balancers.

---

## 🛠️ Technology Stack

| Layer | Technology |
| :--- | :--- |
| **Backend Framework** | Laravel 12 (PHP 8.2+) |
| **Database** | MySQL 8.0 Compatible (TiDB Cloud Serverless Cluster) |
| **Templating Engine** | Laravel Blade SSR |
| **Frontend Styling** | Bootstrap 5, Custom CSS3, Tailwind CSS (Vite), FontAwesome 6 |
| **Asset Bundler** | Vite 7 |
| **Containerization** | Docker (Alpine Linux, PHP-FPM, Nginx) |
| **Hosting Platform** | Render Free Tier (Web Service) |

---

## 📦 Local Development Setup

### Prerequisites
- PHP 8.2 or higher
- Composer 2.x
- Node.js 18+ and npm
- MySQL or access to the remote database

### Step-by-Step Installation

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/Nasir-Yousuf/habib-sir.git
   cd habib-sir
   ```

2. **Install Backend Dependencies**:
   ```bash
   composer install
   ```

3. **Install Frontend Dependencies & Build Assets**:
   ```bash
   npm install
   npm run build
   ```

4. **Environment Setup**:
   ```bash
   copy .env.example .env
   php artisan key:generate
   ```

5. **Configure Database in `.env`**:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=gateway01.us-east-1.prod.aws.tidbcloud.com
   DB_PORT=4000
   DB_DATABASE=bongotanbo_db
   DB_USERNAME=your_db_username
   DB_PASSWORD=your_db_password
   MYSQL_ATTR_SSL_CA=true
   MYSQL_ATTR_SSL_VERIFY_SERVER_CERT=false
   ```

6. **Run Migrations & Seeders (if initializing a fresh database)**:
   ```bash
   php artisan migrate --seed
   ```

7. **Link Storage**:
   ```bash
   php artisan storage:link
   ```

8. **Start Local Development Server**:
   ```bash
   php artisan serve
   ```
   Visit `http://127.0.0.1:8000` in your browser.

---

## 🧪 Testing

The project includes unit and feature test suites covering public pages, authentication, database persistence, and admin authorization.

Run the test suite:
```bash
php artisan test
```

---

## 💡 Suggested Features for Future Iterations

While preserving the clean, lightweight, mobile-responsive architecture without introducing unnecessary microservices or heavy Node.js dependencies, the following enhancements are recommended:

1. **Traveler Booking History & Profile Dashboard (`/my-bookings`)**:
   - Allow logged-in travelers to view their booking inquiry status (Pending / Confirmed / Completed) and download a PDF booking voucher.
2. **Instant WhatsApp / Telegram Quick Chat Integration**:
   - A floating contact pill on mobile that opens an instant WhatsApp chat with pre-filled text (e.g., *"Hello Bongo Tanbo, I am interested in the 5-day Sundarbans tour"*).
3. **Automated Email Notifications (Laravel Mailable / SMTP)**:
   - Send an immediate branded HTML receipt to the customer when they submit a booking or contact form, and alert the admin inbox (`admin@bongotanbo.com`).
4. **Multi-Currency Display (BDT / JPY / USD)**:
   - A lightweight vanilla JS currency switcher in the header converting prices between Bangladeshi Taka (BDT), Japanese Yen (JPY), and US Dollars (USD) for international visitors.
5. **Customer Reviews & Ratings on Tours**:
   - Allow verified travelers to leave 5-star ratings and written feedback directly on completed tour packages.
6. **Payment Gateway Integration (SSLCommerz / Stripe / bKash)**:
   - Support seamless local bKash/Nagad and international credit card deposit payments directly on booking confirmation.
