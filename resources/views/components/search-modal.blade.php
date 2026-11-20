<div class="header-search-bar" id="searchModal" role="dialog" aria-modal="true" aria-label="Search Dialog">
    <button class="search-close" id="searchCloseBtn" aria-label="Close search">&times;</button>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 text-center">
                <div class="contact-search-form-box">
                    <form action="{{ route('tours.index') }}" method="GET">
                        <input type="text" name="search" id="searchInput" placeholder="Search destinations, tours, packages..." autocomplete="off" value="{{ request('search') }}">
                        <button type="submit" aria-label="Submit search"><i class="fas fa-search"></i></button>
                    </form>
                    <p class="text-white-50 mt-2">Type keywords and press Enter to search. Press Escape or Close (&times;) to cancel.</p>
                </div>
            </div>
        </div>
    </div>
</div>
