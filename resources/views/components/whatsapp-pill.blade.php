@php
    // If a tour is present on this page, prefill with its title
    $defaultMessage = isset($tour) && $tour 
        ? "Hello Bongo Tanbo Travels! I have an inquiry about the {$tour->title} tour package." 
        : "Hello Bongo Tanbo Travels! I would like to inquire about booking a tour package.";
    $whatsappNumber = "+8801577509112";
    $whatsappLink = "https://wa.me/" . preg_replace('/[^0-9]/', '', $whatsappNumber) . "?text=" . urlencode($defaultMessage);
@endphp

<!-- Floating WhatsApp Pill Button -->
<aside class="floating-whatsapp-wrapper" aria-label="Quick WhatsApp Inquiry">
    <a href="{{ $whatsappLink }}" 
       target="_blank" 
       rel="noopener noreferrer" 
       class="floating-whatsapp-btn" 
       title="Chat with us on WhatsApp"
       id="whatsappPill">
        <span class="whatsapp-icon-circle">
            <i class="fab fa-whatsapp" aria-hidden="true"></i>
        </span>
        <span class="whatsapp-label d-none d-sm-inline">
            Chat with us
        </span>
    </a>
</aside>
