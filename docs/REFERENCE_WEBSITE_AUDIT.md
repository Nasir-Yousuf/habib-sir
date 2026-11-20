# Reference Website Audit: Bongo Tanbo Travels

**Target URL**: [https://bongotanbotravels.com/](https://bongotanbotravels.com/)  
**Audit Date**: November 2026  
**Auditor**: Full-Stack Architecture Agent  
**Government Registration**: Bangladesh Tourism Board (BTB) License [[Verification Link](https://btbregistration.gov.bd/to-company-info/Nzc/bongo-tanbo-travels)]

---

## 1. Brand Identity & Global Architecture

### Company Profile
- **Entity**: Bongo Tanbo Travels
- **Model**: Bangladesh–Japan Joint Venture Travel & Tourism Operator
- **Headquarters (Japan)**: Fukuoka Ken Fukuoka City Chuo-ku-Kego 2-9-10-201 Japan
  - Phone: `81-90-714-0758` / `81-90-2932-4271`
  - Email: `hyderlemon@gmail.com`
- **Liaison Office (Bangladesh)**: Nipobon (1st Floor), House No. 6, Road No. 8, Sector 11, Uttara, Dhaka 1230
  - Phone: `+88028991482`
  - WhatsApp: `+8801612320995` / `+8801577509112`
  - Email: `bongotanbo@gmail.com`
- **Social Handles**:
  - Facebook: `https://www.facebook.com/profile.php?id=61590056545286`
  - Instagram: `https://www.instagram.com/bongotanbo.1952991`
  - WhatsApp: `https://wa.me/+8801577509112`

---

## 2. Visual Identity & Design Tokens

### A. Color Palette
- **Primary Brand Olive**: `#809e40` (Used for primary CTA buttons, badges, icons, interactive highlights)
- **Primary Olive Hover**: `#6d8833`
- **Secondary Coral Orange**: `#fb5b32` (Used for discount tags, secondary highlights)
- **Deep Forest Green**: `#006a4e` (Used for national emblem elements, brand anchors)
- **Dark Emerald Green**: `#004d38` (Used for brand logo title and key subtitles)
- **Midnight Dark Navy**: `#0e1b27` (Used for Why Choose Us background section)
- **Charcoal Dark Green**: `#121915` (Used for Footer background)
- **Soft Mint Green**: `#f1f7f1` (Used for intro card backgrounds)
- **Cream Accent**: `#fdf8f2` (Used for warm background fills)
- **Royal Gold**: `#d4af37` (Used for ratings, luxury badges)
- **Text Headings**: `#151415`
- **Text Body Copy**: `#455151`
- **Text Muted Meta**: `#717d77`

### B. Typography Hierarchy
1. **Headings, Badges, Navigation**: `'Outfit', sans-serif` (Weights: 500, 600, 700, 800)
2. **Body Copy & Form Controls**: `'Nunito', sans-serif` (Weights: 400, 600, 700; Line-height: 1.7)
3. **Editorial Heritage Heading**: `'Playfair Display', serif` (Weights: 600, 700) — Used for "A Riverine"
4. **Authentic Cursive Script**: `'Seaweed Script', cursive` — Used for "Country"
5. **Display Badges**: `'Prompt', sans-serif` — Used for category cards

---

## 3. Structural Page Inventory & Section Anatomy

### Page 1: Homepage (`/`)
1. **Header Top Bar**:
   - Left: Direct `mailto:bongotanbo@gmail.com` + Fixed dual office address.
   - Right: Facebook, Instagram, WhatsApp circular icon links + Language Selector dropdown (English, Bengali).
2. **Sticky Main Navigation**:
   - Official logo (`logo.webp`) + `Bongo Tanbo Travels` brand text.
   - Menu items: `Home`, `About Us` (dropdown), `Services` (dropdown), `Tour Packages` (dropdown), `Travel Blog`, `Archive` (dropdown), `Contact`.
   - Action controls: `Book Now` pill button, `Login` pill button, Search trigger button, Mobile hamburger button.
3. **Hero Section (Cross-Fade Carousel)**:
   - 4 Static destination slides:
     1. *The Sundarbans* (UNESCO World Heritage Site)
     2. *Tea Garden* (Emerald Rolling Hills, Srimangal)
     3. *Kaptai Lake* (Serene Hill Tracts, Rangamati)
     4. *Cox's Bazar* (World's Longest Natural Sea Beach)
   - Custom floating animated airplanes (`plane-2.png`, `plane-3.png`).
   - Long circular arrow previous/next buttons and indicator dots.
4. **Floating Booking Search Filter Bar**:
   - Overlaps hero lower margin (`-65px`).
   - 5 Inputs: Destination dropdown, Duration dropdown, Departure Date picker, Time Slot dropdown, Search button.
5. **Bangladesh Heritage Showcase ("A Riverine Country")**:
   - Flag icon badge, dual-font heading, 3 statistic cards (Area: 147,570 km², Pop: 170M+, Capital: Dhaka), 5 pill tags, Read More button.
6. **About Us Section**:
   - Left collage with floating animated `12+ Years Experience` badge.
   - Right story copy, joint venture quote, 4-point SVG feature checklist, community avatar badges.
7. **Why Choose Us Section**:
   - Midnight navy background with image overlay.
   - 6 Glassmorphism cards with numbered watermarks (`01` through `06`):
     1. Experienced Travel Experts Who Care
     2. A Trusted Global Network
     3. Exceptional Value for Every Budget
     4. Tailor-Made Experiences
     5. Professional Guides Who Enrich Your Journey
     6. End-to-End Travel Support
8. **Our Tour Packages Grid**:
   - 8 Featured Tour Package Cards (4-column desktop, 2-column mobile):
     1. Japan Standard Tour Itinerary (7 Days, 4 places)
     2. 5 Days Singapore Standard Tour Package (5 Days, 3 places)
     3. Bangladesh Cultural Discovery Tour (8 Days, 11 places)
     4. Bangladesh Shaktipeeth Pilgrimage Tour (7 Days / 6 Nights, 10 places)
     5. 7 Days Bangladesh Standard Tour (7 Days, 12 places)
     6. 10 Days Bangladesh Standard Tour (10 Days, 13 places)
     7. 10 Days Bangladesh Discovery Tour (10 Days, 13 places)
     8. 12 Days Village Culture, Archaeology & Heritage Tour (12 Days, 7 places)
9. **Promotional Deals & Discount Banners**:
   - 3 Callout visual banners with discount stickers:
     - Explore Destinations – Save More Every Trip
     - Plan Ahead, Travel Smart – Save Big On Vacations
     - Experience The Best Trips – At Best Rates
10. **Top Destination Packages & Travel Highlight CTA**:
    - 11 Categories: Specialized, Festival, Ancestral, Family, Trekking, Photography, Documentary, Bird Watching, Inbound, Outbound, Domestic.
    - Full-width Highlight Banner: "Dream Trip Starts Here / Tailored Trips For You" with floating suitcase and airplane shapes.
11. **Popular in Bangladesh Recommendation Collage**:
    - 6 Overlapping cards: Waterfalls, Beach, Food, Green Tourism, Historical Heritage, Luxury Comfort.
12. **Latest Travel Insights & Blog**:
    - 4 Story cards with cover images, title links, excerpts, and Read More buttons.
13. **Footer**:
    - 4 Columns: BTB Accreditation & socials, Quick Links, Bangladesh Office details, Japan Office details.
    - Copyright notice & Floating back-to-top button.

---

### Page 2: Tour Listing & Filter Page (`/tours`)
- **Breadcrumb Header**: Clean header banner with page title.
- **Search & Filter Controls**: Category selector pills, destination filter, duration slider/dropdown, price sorting.
- **Tour Grid**: Responsive cards displaying cover image, duration, destination tag, places count, price, and "View Tour Details" button.
- **Pagination**: Numbered pagination links with Inertia state preservation.

---

### Page 3: Tour Details Page (`/tours/{slug}`)
- **Header Banner**: Tour title, destination badge, duration, price starting at.
- **Interactive Sticky Sidebar**:
  - Direct Booking / Inquiry card with date picker, number of guests (Adults/Children), customer name, email, phone, special notes, and instant submit button.
- **Main Tour Content**:
  1. *Tour Overview*: High-level summary and trip highlights.
  2. *Day-by-Day Detailed Itinerary*: Expandable accordion timeline detailing day 1 through end day with hotel, transport, and meals.
  3. *Inclusions & Exclusions*: Two-column checklist with green checkmarks and red cross icons.
  4. *Photo Lightbox Gallery*: Grid of destination photos.
  5. *Related Tours*: Suggestions for similar itineraries.

---

### Page 4: Destinations Listing & Details (`/destinations` & `/destinations/{slug}`)
- Overview of all key regions (Sundarbans, Sylhet / Srimangal, Chittagong Hill Tracts / Kaptai, Cox's Bazar, Bandarban, Japan, Singapore).
- Filtered tours linked to the selected destination.

---

### Page 5: About Us Page (`/about`)
- Comprehensive background on the Bangladesh–Japan joint venture.
- Leadership vision and commitment to hospitality and precision.
- Bangladesh Tourism Board registration documentation.
- The 6 core values ("Why Choose Us").
- Traveler community reviews and metrics.

---

### Page 6: Contact & Inquiries Page (`/contact`)
- Two dedicated office detail cards (Uttara, Dhaka & Fukuoka, Japan).
- Interactive Contact Form (Name, Email, Phone, Subject / Preferred Tour, Message).
- Embedded Google Maps location for the Dhaka office.

---

### Page 7: Travel Blog (`/blog` & `/blog/{slug}`)
- Article grid with categories (Destinations, Travel Tips, Heritage).
- Single article view with author, published date, formatted content, and related posts.

---

### Page 8: Gallery Page (`/gallery`)
- Filterable photo gallery categorized by destination and theme (Nature, Beaches, Culture, Hills).

---

### Page 9: Admin Management Suite (`/admin/*`)
- Secure login portal (`/login` or `/admin/login`).
- Dashboard statistics (Tours count, Bookings count, Pending inquiries, Contact messages).
- CRUD managers for Tours, Destinations, Categories, Bookings, Messages, and Gallery.
