<div class="booking-filter-wrapper container" id="bookingFilter">
    <form id="heroBookingForm" class="booking-filter-card" action="{{ route('tours.index') }}" method="GET">
        <!-- Field 1: Destination -->
        <div class="booking-col">
            <div class="booking-icon">
                <img src="{{ asset('assets/images/icon-destination.webp') }}" alt="Destination icon" width="24" height="24">
            </div>
            <div class="booking-info">
                <label for="filterDestination">Destination</label>
                <select id="filterDestination" name="destination" class="form-select border-0 p-0 shadow-none">
                    <option value="">Select Destination</option>
                    <option value="sundarbans" {{ request('destination') == 'sundarbans' ? 'selected' : '' }}>Sundarbans</option>
                    <option value="srimangal" {{ request('destination') == 'srimangal' ? 'selected' : '' }}>Srimangal (Tea Garden)</option>
                    <option value="coxs-bazar" {{ request('destination') == 'coxs-bazar' ? 'selected' : '' }}>Cox's Bazar</option>
                    <option value="rangamati" {{ request('destination') == 'rangamati' ? 'selected' : '' }}>Rangamati (Kaptai)</option>
                    <option value="bandarban" {{ request('destination') == 'bandarban' ? 'selected' : '' }}>Bandarban</option>
                    <option value="japan" {{ request('destination') == 'japan' ? 'selected' : '' }}>Japan</option>
                    <option value="singapore" {{ request('destination') == 'singapore' ? 'selected' : '' }}>Singapore</option>
                </select>
            </div>
        </div>

        <!-- Field 2: Duration -->
        <div class="booking-col">
            <div class="booking-icon">
                <img src="{{ asset('assets/images/icon-duration.webp') }}" alt="Duration icon" width="24" height="24">
            </div>
            <div class="booking-info">
                <label for="filterDuration">Duration</label>
                <select id="filterDuration" name="duration" class="form-select border-0 p-0 shadow-none">
                    <option value="">Select Duration</option>
                    <option value="3-days" {{ request('duration') == '3-days' ? 'selected' : '' }}>3 Days</option>
                    <option value="5-days" {{ request('duration') == '5-days' ? 'selected' : '' }}>5 Days</option>
                    <option value="7-days" {{ request('duration') == '7-days' ? 'selected' : '' }}>7 Days</option>
                    <option value="8-days" {{ request('duration') == '8-days' ? 'selected' : '' }}>8 Days</option>
                    <option value="10-days" {{ request('duration') == '10-days' ? 'selected' : '' }}>10 Days</option>
                    <option value="12-days" {{ request('duration') == '12-days' ? 'selected' : '' }}>12 Days</option>
                </select>
            </div>
        </div>

        <!-- Field 3: Departure Date -->
        <div class="booking-col">
            <div class="booking-icon">
                <img src="{{ asset('assets/images/icon-departure.webp') }}" alt="Date icon" width="24" height="24">
            </div>
            <div class="booking-info">
                <label for="departureDatePicker">Departure Date</label>
                <input type="date" id="departureDatePicker" name="departure_date" class="form-control border-0 p-0 shadow-none" value="{{ request('departure_date') }}">
            </div>
        </div>

        <!-- Field 4: Time Slot -->
        <div class="booking-col">
            <div class="booking-icon">
                <img src="{{ asset('assets/images/icon-slot.webp') }}" alt="Time slot icon" width="24" height="24">
            </div>
            <div class="booking-info">
                <label for="filterSlot">Time Slot</label>
                <select id="filterSlot" name="slot" class="form-select border-0 p-0 shadow-none">
                    <option value="morning">Morning (09:00 AM)</option>
                    <option value="afternoon">Afternoon (02:00 PM)</option>
                    <option value="evening">Evening (06:00 PM)</option>
                    <option value="flexible" selected>Flexible Schedule</option>
                </select>
            </div>
        </div>

        <!-- Field 5: Submit Search Button -->
        <div class="booking-btn-col">
            <button type="submit" class="booking-submit-btn">
                <span>Search</span> <i class="fas fa-search ms-1"></i>
            </button>
        </div>
    </form>
</div>
