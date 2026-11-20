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
        $stats = [
            'total_tours' => Tour::count(),
            'active_tours' => Tour::where('is_active', true)->count(),
            'total_bookings' => Booking::count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'total_destinations' => Destination::count(),
            'total_messages' => ContactMessage::count(),
            'unread_messages' => ContactMessage::where('is_read', false)->count(),
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
