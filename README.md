# Bongo Tanbo Travels - Homepage Design (Bootstrap 5)

## 📁 Project Structure

```text
├── index.html          # Complete homepage designed with Bootstrap 5
├── css/
│   ├── bootstrap.min.css # Bootstrap 5.3.3 CSS (local file)
│   └── style.css       # Minimal theme CSS (brand colors & font styles)
├── js/
│   └── bootstrap.bundle.min.js # Bootstrap 5.3.3 Bundle JS with Popper (local file)
├── assets/
│   └── images/         # All 67 local high-res images, logos, flags, badges & static hero slides
└── README.md           # Documentation guide for presentations & client walk-throughs
```

---

## 🚀 How to Run the Website Locally

You can open `index.html` directly in any web browser, or serve it using Python's built-in HTTP server:

```bash
# In the project directory, run:
python -m http.server 8085
```

Then visit **`http://localhost:8085`** in your browser.

---

## 🎨 Design System & Color Palette

The project is built on CSS custom properties (`:root` variables in `css/style.css`) matching Bongo Tanbo's brand:

| Variable               | Hex Code  | Purpose                                                 |
| :--------------------- | :-------- | :------------------------------------------------------ |
| `--theme-color`        | `#809e40` | Primary olive green accent (buttons, icons, highlights) |
| `--theme-color-2`      | `#fb5b32` | Secondary warm coral-orange (tags, accents)             |
| `--theme-dark-green`   | `#006a4e` | Deep Bangladesh forest green                            |
| `--theme-dark-green-2` | `#004d38` | Dark emerald green (headings, brand title)              |
| `--bg-dark-navy`       | `#0e1b27` | Midnight navy background for Why Choose Us              |
| `--bg-light-green`     | `#f1f7f1` | Soft mint green container background                    |

### Typography

- **Headings & Badges**: `'Outfit', sans-serif`
- **Body Copy**: `'Nunito', sans-serif`
- **Luxury Editorial Headline**: `'Playfair Display', serif`
- **Artistic Script Accent**: `'Seaweed Script', cursive`
- **Display Collages**: `'Prompt', sans-serif`

---

## 🧩 Section-by-Section Walkthrough & How to Explain It

This guide is structured so you can walk any team member, teacher, or client through each piece of the code:

### 1. Header & Navigation Bar

- **Top Info Bar (`.header-top-section`)**:
  - **Email contact**: Direct clickable `mailto:` link with an envelope icon.
  - **Animated Address Ticker (`#addressTickerInner`)**: Alternates between the Fukuoka (Japan) headquarters and Uttara, Dhaka (Bangladesh) liaison office using vertical translation.
  - **Social Links**: Circular buttons for Facebook, Instagram, and WhatsApp.
  - **Language Selector Dropdown**: Built with Bootstrap 5 dropdown (`data-bs-toggle="dropdown"`), featuring country flags for English, Chinese, French, Italian, Japanese, Spanish, and Bengali.
- **Main Sticky Navbar (`.header-main-nav`)**:
  - Uses `window.scrollY > 160` in `js/main.js` to dynamically add `.is-sticky`, providing a smooth slide-down animation and shadow.
  - Features the official brand logo and title `Bongo Tanbo Travels`.
  - **Multi-level Dropdown Menus**: Styled hover dropdowns for _About Us_, _Services_, _Tour Packages_, and _Archive_.
  - **Action Buttons**: Highlighted green "Book Now" pill button, "Login" button, Search modal trigger icon, and mobile hamburger toggle.

### 2. Fullscreen Search Modal & Mobile Drawer

- **Search Modal (`#searchModal`)**:
  - Sleek backdrop-filter glassmorphism overlay.
  - Opens on clicking the magnifying glass and can be dismissed with the **Close (×)** button or by pressing the **Escape (Esc)** key.
- **Mobile Offcanvas Drawer (`#mobileOffcanvas`)**:
  - Slide-out navigation drawer designed specifically for mobile screens and tablets (`d-xl-none`).
  - Includes interactive accordion dropdown toggles for nested links.

### 3. Hero Section (Hero Carousel with Static Images)

_In direct accordance with your requirements, static photography is used instead of heavy video backgrounds._

- Built using **Bootstrap 5 Carousel** (`carousel slide carousel-fade`).
- **4 Iconic Static Slides**:
  1. **The Sundarbans**: World Heritage Mangrove Forest & Bengal Tiger habitat (`hero-sundarbans.jpg`).
  2. **Tea Garden**: Srimangal lush green rolling tea hills (`hero-tea-garden.jpg`).
  3. **Kaptai Lake**: Rangamati emerald waters and hill tracts (`hero-kaptai-lake.jpg`).
  4. **Cox’s Bazar**: World's longest natural sea beach and golden sunset surf (`hero-coxs-bazar.jpg`).
- **Floating Airplanes (`.plane-shape-1`, `.plane-shape-2`)**: Bob smoothly up and down using custom CSS `@keyframes floatBobY` and `floatBobX`.
- **Custom Navigation Arrows**: Custom circular arrow buttons (`#heroPrevBtn`, `#heroNextBtn`) hooked to `bootstrap.Carousel.prev()` and `next()`.

### 4. Floating Booking Search Filter Bar

- Positioned with `margin-top: -65px` to overlap the boundary between the hero section and the content below.
- Styled as an elevated pill card (`border-radius: 55px; box-shadow: var(--shadow-floating)`).
- Contains 4 input fields with custom icons:
  1. **Destination**: Dropdown featuring popular Bangladesh spots and outbound countries (Japan, Singapore, Thailand).
  2. **Duration**: 3 Days, 5 Days, 7 Days, 10 Days, 12 Days.
  3. **Departure Date**: HTML5 Date input with automatic validation (minimum selectable date is tomorrow).
  4. **Time Slot**: Morning, Afternoon, Evening, Flexible.
  5. **Search CTA**: Pill button triggering tailored package filtering.

### 5. Bangladesh Showcase ("A Riverine Country")

- Celebrates Bangladesh's geography with authentic branding:
  - **Red & Green Flag Badge**: Pure CSS national flag emblem.
  - **Editorial Heading**: Combines _Playfair Display_ serif ("A Riverine") with _Seaweed Script_ cursive ("Country") underlined with a curved brush stroke.
  - **Background Watermark**: Subtle topographical pattern (`bg-pattern.png`).
  - **3 Stat Feature Cards**:
    - `147,570 km²` (Total Area)
    - `170 Million+` (Population)
    - `Dhaka` (Capital City)
  - **Pill Badges**: _Green Landscape_, _Fertile Plains_, _Bay of Bengal_, _Vibrant Culture_, _Friendly People_.

### 6. About Us Section (12+ Years Experience)

- Highlights the unique **Bangladesh–Japan joint venture**:
  - Left column: Image collage with an animated floating badge: `12+ YEARS OF EXPERIENCE` (animated smoothly via JavaScript IntersectionObserver).
  - Right column: Quote emphasizing _"Bangladeshi hospitality and Japanese precision make every journey a lifetime memory."_
  - 4-item checklist with custom SVG icons (Trusted local experts, Many years experience, Flexible booking, Real-time updates).
  - "Read More" button alongside traveler community avatar thumbnails.

### 7. Why Choose Us Section

- Dark midnight navy background (`#0e1b27`) with dark overlay (`bg-choose-us.webp`).
- **6 Frosted Glass Cards** with frosted blur (`backdrop-filter: blur(10px)`):
  - Each card features a numbered watermark in the bottom corner (`data-number="01"` to `"06"` rendered via CSS `::after`).
  - When hovered, cards lift up (`translateY(-10px)`), glow with a soft green gradient, and scale the icon.
  - **6 Key Selling Points**:
    1. Experienced Travel Experts Who Care
    2. A Trusted Global Network
    3. Exceptional Value for Every Budget
    4. Tailor-Made Experiences
    5. Professional Guides Who Enrich Your Journey
    6. End-to-End Travel Support

### 8. Our Tour Packages Grid

- 8 distinct tour package cards arranged in a responsive 4-column desktop / 2-column mobile grid:
  1. Japan Standard Tour Itinerary (7 Days, 4 places)
  2. 5 Days Singapore Standard Tour Package (5 Days, 3 places)
  3. Bangladesh Cultural Discovery Tour (8 Days, 11 places)
  4. Bangladesh Shaktipeeth Pilgrimage Tour (7 Days / 6 Nights, 10 places)
  5. 7 Days Bangladesh Standard Tour (7 Days, 12 places)
  6. 10 Days Bangladesh Standard Tour (10 Days, 13 places)
  7. 10 Days Bangladesh Discovery Tour (10 Days, 13 places)
  8. 12 Days Village Culture, Archaeology & Heritage Tour (12 Days, 7 places)
- Hovering over any card gently zooms the thumbnail image without overflowing its rounded container.

### 9. Promotional Deals & Discount Banners

- 3 visual deal cards with percentage discount badges:
  - _Explore Destinations – Save More Every Trip_
  - _Plan Ahead, Travel Smart – Save Big On Vacations_
  - _Experience The Best Trips – At Best Rates_

### 10. Top Destination Packages & Highlight CTA

- **11 Category Feature Boxes** with dedicated icons:
  - Specialized, Festival, Ancestral, Family, Trekking, Photography, Documentary, Bird Watching, Inbound, Outbound, Domestic.
- **Travel Highlight CTA (`.cta-wrapper-4`)**:
  - Background banner with fixed attachment.
  - Headline: _"Dream Trip Starts Here / Tailored Trips For You"_ with Book Now button.
  - Floating decorative shapes: Discount badge, suitcase, and airplane.

### 11. Popular In Bangladesh (Recommendation Collage)

- Recreates the iconic _Beautiful Bangladesh_ layered collage:
  - Staggered absolute cards on desktop that gracefully transition to a responsive 2-column grid on tablets/mobiles.
  - 6 categories: **Waterfalls** (_Charming_), **Beach** (_Beautiful_), **Food** (_Tasty_), **Green Tourism** (_Attractive_), **Historical Heritage** (_Heritage Tour_), and **Luxury Comfort** (_Luxury_).
  - Hovering brings any card to the foreground (`z-index: 100`) with smooth scaling.

### 12. Latest Travel Insights & Blog Section

- 4 blog cards showcasing travel stories, guides, and customer feedback.
- Each card includes a cover photo, title, text excerpt, and "Read More" button.

### 13. Footer Section

- **Column 1**: Official **Bangladesh Tourism Board (BTB)** registration badge linking directly to the government verification record, plus social handles.
- **Column 2**: Quick Links (Travel Experiences, FAQ, Privacy Policies, Terms & Conditions).
- **Column 3**: **Bangladesh Office** (Full Uttara, Dhaka address, landline `+88028991482`, WhatsApp `+8801577509112`, and email).
- **Column 4**: **Japan Office** (Full Fukuoka City address, phone numbers `81-90-714-0758` and `81-90-2932-4271`, and email).
- **Copyright Sub-Footer**: Centered copyright line with Bootstrap 5 credit.

### 14. Floating Back-to-Top Button

- Appears smoothly when scrolling past 450px and scrolls smoothly to the top when clicked.

---

## 🛠️ Responsive Breakpoints Used

The layout adheres to standard Bootstrap 5 responsive grid tiers:

- **Extra Small (`< 576px`)**: Single column forms, compact headers, touch-friendly buttons.
- **Small (`≥ 576px`)**: 2-column package grid, visible brand text.
- **Medium / Tablets (`≥ 768px`)**: 3-column packages, 2-column blog cards, mobile drawer available.
- **Large / Desktop (`≥ 992px`)**: 4-column tour packages, full desktop navigation, floating airplane animations.
- **Extra Large (`≥ 1200px`)**: Full mega menu visible, high-definition collage layouts.
