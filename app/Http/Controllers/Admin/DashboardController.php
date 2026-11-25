<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\ContactMessage;
use App\Models\Destination;
use App\Models\Tour;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        // Consolidate sequential COUNT(*) queries into single-pass aggregates
        $tourStats = Tour::selectRaw('COUNT(*) as total, SUM(CASE WHEN is_active = 1 THEN 1 ELSE 0 END) as active')->first();
        $bookingStats = Booking::selectRaw("COUNT(*) as total, SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending")->first();
        $messageStats = ContactMessage::selectRaw('COUNT(*) as total, SUM(CASE WHEN is_read = 0 THEN 1 ELSE 0 END) as unread')->first();

        $stats = [
            'total_tours' => (int) ($tourStats->total ?? 0),
            'active_tours' => (int) ($tourStats->active ?? 0),
            'total_bookings' => (int) ($bookingStats->total ?? 0),
            'pending_bookings' => (int) ($bookingStats->pending ?? 0),
            'total_destinations' => Destination::count(),
            'total_messages' => (int) ($messageStats->total ?? 0),
            'unread_messages' => (int) ($messageStats->unread ?? 0),
        ];

        $recentBookings = Booking::with('tour')->latest()->take(6)->get();
        $recentMessages = ContactMessage::latest()->take(6)->get();

        return view('pages.admin.dashboard', compact('stats', 'recentBookings', 'recentMessages'));
    }

    public function clearCache()
    {
        Cache::flush();
        return redirect()->back()->with('success', 'Application data cache flushed successfully!');
    }
}
