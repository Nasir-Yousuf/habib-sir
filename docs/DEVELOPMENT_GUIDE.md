# Development & Setup Guide: Bongo Tanbo Travels (Blade Architecture)

This guide provides instructions for setting up, configuring, running, and testing the application locally on PHP 8.2, Laravel 11, MySQL (XAMPP), Blade, and Vanilla JavaScript.

---

## 1. Prerequisites Checklist

- **PHP**: Version 8.2 or higher (`php -v`)
- **Composer**: Dependency manager for PHP (`composer --version`)
- **Node.js & npm**: Optional for running Vite asset compilation (`node -v` & `npm -v`)
- **MySQL / MariaDB**: Running locally via XAMPP or native service on port `3306`.

---

## 2. Environment Configuration

### Step A: Configure `.env`
In the root directory, create `.env` by copying `.env.example`:
```bash
cp .env.example .env
```

Ensure your database settings match your local MySQL configuration:
```ini
APP_NAME="Bongo Tanbo Travels"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_TIMEZONE=Asia/Dhaka
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bongotanbo_db
DB_USERNAME=root
DB_PASSWORD=

CACHE_STORE=file
SESSION_DRIVER=file
```

Generate the encryption key:
```bash
php artisan key:generate
```

---

## 3. Database Initialization & Seeding

### Step A: Create the Database
Ensure the database exists in MySQL:
```sql
CREATE DATABASE IF NOT EXISTS bongotanbo_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### Step B: Run Migrations and Seeders
Run the migration and seeding command:
```bash
php artisan migrate:fresh --seed
```

This populates:
- **Default Administrator**:
  - Email: `admin@bongotanbo.com`
  - Password: `password`
- **11 Categories**: Inbound, Outbound, Domestic, Specialized, Bird Watching, Trekking, Photography, Documentary, Festival, Ancestral, Family.
- **7 Destinations**: Sundarbans, Srimangal, Kaptai Lake, Cox's Bazar, Bandarban, Japan, Singapore.
- **8 Tour Packages**: All reference packages with realistic itineraries, inclusions, prices, and high-resolution images.
- **4 Travel Articles**: Insights into Bangladesh ecotourism and travel tips.

---

## 4. Running the Application

### Step A: Start the Development Server
```bash
php artisan serve
```
Access the application at: **`http://127.0.0.1:8000`**

### Step B: (Optional) Compile Assets via Vite
```bash
npm install
npm run build
```
In production or local development, assets are served directly from `public/` without requiring any background Node process.

---

## 5. Admin Dashboard Access
1. Visit `http://127.0.0.1:8000/login`
2. Enter:
   - **Email**: `admin@bongotanbo.com`
   - **Password**: `password`
3. Manage tours, itineraries, destinations, categories, customer bookings, and contact messages.

---

## 6. Production Deployment & Security Architecture

### A. What You Need to Prepare Before Deployment
To deploy this project to a live public server, you or your hosting provider need to have:
1. **Domain Name**: e.g., `bongotanbo.com` with DNS records pointed to your server IP.
2. **Hosting Environment**: Either:
   - **cPanel / DirectAdmin Shared Hosting** (with PHP 8.2+ and MySQL support).
   - **Cloud VPS** (Ubuntu 22.04 / 24.04 on DigitalOcean, Linode, AWS EC2, or Hetzner).
3. **Database Credentials**:
   - Database Name (e.g., `cpaneluser_bongotanbo`)
   - Database User (e.g., `cpaneluser_admin`)
   - Database Password (strong, random 16+ character password)
4. **SSL / HTTPS Certificate**: Let's Encrypt / AutoSSL enabled for HTTPS.
5. **SMTP Email Credentials**:
   - Gmail App Password or hosting webmail SMTP credentials to send instant booking confirmations and contact notifications.

---

### B. Deployment Option 1: Shared Hosting (cPanel / Apache)
1. Upload the project files to your server (either via Git or zip via File Manager).
2. If your domain's document root points to `public_html/`:
   - Option A: Point domain document root in cPanel directly to `public_html/public`.
   - Option B: Use the pre-configured root [`.htaccess`](file:///d:/Nasir%20(local%20disk)/nasir/OneDrive/Documents/habib-sir/.htaccess) which automatically and securely routes web requests to `public/` while blocking access to `.env` and internal code folders.
3. Create your MySQL database in cPanel -> MySQL Databases and note the credentials.
4. Set up `.env` from [`.env.production.example`](file:///d:/Nasir%20(local%20disk)/nasir/OneDrive/Documents/habib-sir/.env.production.example):
   ```ini
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://yourdomain.com
   DB_DATABASE=your_db_name
   DB_USERNAME=your_db_user
   DB_PASSWORD=your_db_password
   SESSION_SECURE_COOKIE=true
   ```
5. Run migrations via Terminal or SSH:
   ```bash
   php artisan migrate --force
   php artisan db:seed --force
   php artisan storage:link
   ```
6. Cache configuration and routes for high speed:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

---

### C. Deployment Option 2: Linux VPS (Ubuntu + Nginx + PHP 8.2-FPM)
1. **Nginx Server Block**:
   ```nginx
   server {
       listen 80;
       listen 443 ssl http2;
       server_name bongotanbotravels.com www.bongotanbotravels.com;
       root /var/www/bongotanbo-travels/public;

       index index.php;
       charset utf-8;

       # Security Headers
       add_header X-Frame-Options "SAMEORIGIN" always;
       add_header X-Content-Type-Options "nosniff" always;
       add_header X-XSS-Protection "1; mode=block" always;
       add_header Referrer-Policy "strict-origin-when-cross-origin" always;

       location / {
           try_files $uri $uri/ /index.php?$query_string;
       }

       # Block access to hidden files and sensitive extensions
       location ~ /\.(?!well-known).* {
           deny all;
       }

       location ~ \.(env|log|json|lock|yaml|yml|sql|git|sh)$ {
           deny all;
       }

       location ~ \.php$ {
           fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
           fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
           include fastcgi_params;
       }
   }
   ```
2. Enable SSL with Certbot:
   ```bash
   sudo certbot --nginx -d bongotanbotravels.com -d www.bongotanbotravels.com
   ```

---

### D. Security Verification Checklist for Production
- [x] **`APP_DEBUG=false`**: Prevents sensitive database queries and stack traces from leaking on errors.
- [x] **Custom Error Pages**: Branded 404, 403, 419, and 500 error views in `resources/views/errors/`.
- [x] **Security Headers**: Injected via `SecurityHeadersMiddleware` (Clickjacking, MIME sniffing, XSS filter, Referrer policy).
- [x] **Input Sanitization**: Injected via `SanitizeInputMiddleware` (Strips dangerous tags and XSS attack vectors).
- [x] **Strict Admin Role Verification**: `EnsureAdminMiddleware` checks `Auth::user()->role === 'admin'`.
- [x] **Rate Limiting (Anti-Spam / Anti-Brute-Force)**:
  - Login endpoint: 5 attempts/minute.
  - Contact form: 5 submissions/minute.
  - Booking inquiries: 5 submissions/minute.
- [x] **File Protection**: Root and public `.htaccess` block direct access to `.env`, `.git`, `.json`, `.sql`, and logs.
- [x] **Secure Session Cookies**: `SESSION_SECURE_COOKIE=true`, `SESSION_HTTP_ONLY=true`, `SESSION_SAME_SITE=lax`.
