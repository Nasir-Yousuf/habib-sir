<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingStoreRequest;
use App\Models\Booking;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function store(BookingStoreRequest $request)
    {
        $validated = $request->validated();
        $validated['booking_reference'] = 'BTB-' . date('Y') . '-' . strtoupper(Str::random(6));
        $validated['status'] = 'pending';

        $booking = Booking::create($validated);

        return redirect()->back()->with('success', 'Your booking inquiry (' . $booking->booking_reference . ') has been successfully received! Our trip advisor will contact you within 24 hours to confirm details.');
    }
}
