<footer class="footer-section" id="footer" style="background-image: url('{{ asset('assets/images/footer-bg.webp') }}');">
    <div class="container">
        <div class="row g-4">
            <!-- Col 1: BTB Registration Badge & Socials -->
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="footer-widget-items">
                    <h3 class="footer-widget-title">Bangladesh Tourism Board</h3>
                    <div class="btb-registration-box mt-3">
                        <a href="https://btbregistration.gov.bd/to-company-info/Nzc/bongo-tanbo-travels" target="_blank" rel="noopener">
                            <img src="{{ asset('assets/images/btb-logo.png') }}" alt="BTB Official Logo" width="55" height="55">
                        </a>
                        <div>
                            <span class="d-block text-danger fs-7 fw-semibold">Registered by</span>
                            <span class="d-block text-dark fw-bold fs-6">Bangladesh Tourism Board (BTB)</span>
                        </div>
                    </div>

                    <div class="social-icon mt-4 d-flex align-items-center gap-2">
                        <a href="https://www.facebook.com/profile.php?id=61590056545286" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/bongotanbo.1952991" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="https://wa.me/+8801577509112" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>

            <!-- Col 2: Quick Links -->
            <div class="col-xl-2 col-lg-3 col-md-6">
                <div class="footer-widget-items">
                    <h3 class="footer-widget-title">Quick Links</h3>
                    <ul class="list-items ps-0 mb-0">
                        <li><i class="bi bi-chevron-right me-1"></i><a href="{{ route('tours.index') }}">Tour Packages</a></li>
                        <li><i class="bi bi-chevron-right me-1"></i><a href="{{ route('destinations.index') }}">Destinations</a></li>
                        <li><i class="bi bi-chevron-right me-1"></i><a href="{{ route('blog.index') }}">Travel Insights</a></li>
                        <li><i class="bi bi-chevron-right me-1"></i><a href="{{ route('gallery.index') }}">Photo Gallery</a></li>
                        <li><i class="bi bi-chevron-right me-1"></i><a href="{{ route('about') }}">About Bongo Tanbo</a></li>
                        <li><i class="bi bi-chevron-right me-1"></i><a href="{{ route('contact.index') }}">Contact Us</a></li>
                    </ul>
                </div>
            </div>

            <!-- Col 3: Bangladesh Office -->
            <div class="col-xl-4 col-lg-5 col-md-6">
                <div class="footer-widget-items">
                    <h3 class="footer-widget-title">Bangladesh Office</h3>
                    <div class="contact-info-items mt-3">
                        <div class="contact-items d-flex align-items-start mb-3">
                            <div class="footer-contact-icon me-3"><i class="fas fa-map-marker-alt"></i></div>
                            <div class="content"><p class="footer-contact-text mb-0">Nipobon (First Floor) House No. 6 Road No. 8 Sector 11 Uttara, Dhaka 1230.</p></div>
                        </div>
                        <div class="contact-items d-flex align-items-center mb-2">
                            <div class="footer-contact-icon-small me-3"><i class="fas fa-phone"></i></div>
                            <div class="content"><a href="tel:+88028991482" class="footer-contact-text">+88028991482</a></div>
                        </div>
                        <div class="contact-items d-flex align-items-center mb-2">
                            <div class="footer-contact-icon-small me-3"><i class="fab fa-whatsapp"></i></div>
                            <div class="content"><a href="https://wa.me/8801577509112" class="footer-contact-text">+8801612320995 | +8801577509112</a></div>
                        </div>
                        <div class="contact-items d-flex align-items-center">
                            <div class="footer-contact-icon-small me-3"><i class="fas fa-envelope"></i></div>
                            <div class="content"><a href="mailto:bongotanbo@gmail.com" class="footer-contact-text">bongotanbo@gmail.com</a></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Col 4: Japan Office -->
            <div class="col-xl-3 col-lg-5 col-md-6">
                <div class="footer-widget-items">
                    <h3 class="footer-widget-title">Japan Office</h3>
                    <div class="contact-info-items mt-3">
                        <div class="contact-items d-flex align-items-start mb-3">
                            <div class="footer-contact-icon me-3"><i class="fas fa-map-marker-alt"></i></div>
                            <div class="content"><p class="footer-contact-text mb-0">Fukuoka Ken Fukuoka City Chuo-ku-Kego 2-9-10-201 Japan</p></div>
                        </div>
                        <div class="contact-items d-flex align-items-center mb-2">
                            <div class="footer-contact-icon-small me-3"><i class="fas fa-phone"></i></div>
                            <div class="content"><span class="footer-contact-text">81-90-714-0758</span></div>
                        </div>
                        <div class="contact-items d-flex align-items-center mb-2">
                            <div class="footer-contact-icon-small me-3"><i class="fas fa-mobile-alt"></i></div>
                            <div class="content"><a href="tel:819029324271" class="footer-contact-text">81-90-2932-4271</a></div>
                        </div>
                        <div class="contact-items d-flex align-items-center">
                            <div class="footer-contact-icon-small me-3"><i class="fas fa-envelope"></i></div>
                            <div class="content"><a href="mailto:hyderlemon@gmail.com" class="footer-contact-text">hyderlemon@gmail.com</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Copyright Sub-Footer Bar -->
    <div class="footer-bottom-1">
        <div class="container text-center">
            <p class="mb-0">&copy; {{ date('Y') }} Bongo Tanbo Travels. All rights reserved. Government Registered Tour Operator.</p>
        </div>
    </div>
</footer>

<!-- Floating Back to Top Button -->
<button id="backTopBtn" class="back-to-top" aria-label="Scroll back to top">
    <i class="fas fa-arrow-up"></i>
</button>
