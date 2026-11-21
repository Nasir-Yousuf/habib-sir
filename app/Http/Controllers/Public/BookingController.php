<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingStoreRequest;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function store(BookingStoreRequest $request)
    {
        $validated = $request->validated();
        $validated['booking_reference'] = 'BTB-' . date('Y') . '-' . strtoupper(Str::random(6));
        $validated['status'] = 'pending';
        if (Auth::check()) {
            $validated['user_id'] = Auth::id();
        }

        $booking = Booking::create($validated);

        return redirect()->back()->with('success', 'Your booking inquiry (' . $booking->booking_reference . ') has been successfully received! Our trip advisor will contact you within 24 hours to confirm details.');
    }

    /**
     * Traveler booking dashboard.
     */
    public function myBookings()
    {
        $user = Auth::user();

        // Query bookings either linked by user_id OR by matching customer_email
        $bookings = Booking::with('tour')
            ->where(function ($query) use ($user) {
                $query->where('user_id', $user->id)
                      ->orWhere('customer_email', $user->email);
            })
            ->latest()
            ->paginate(10);

        return view('pages.public.my-bookings', compact('bookings', 'user'));
    }

    /**
     * Printable / PDF-ready tour voucher.
     */
    public function voucher(string $reference)
    {
        $user = Auth::user();

        $booking = Booking::with(['tour.category', 'tour.images'])
            ->where('booking_reference', $reference)
            ->where(function ($query) use ($user) {
                // Customer can view their own booking; admin can view any booking
                if ($user->role !== 'admin') {
                    $query->where('user_id', $user->id)
                          ->orWhere('customer_email', $user->email);
                }
            })
            ->firstOrFail();

        return view('pages.public.booking-voucher', compact('booking'));
    }
}
