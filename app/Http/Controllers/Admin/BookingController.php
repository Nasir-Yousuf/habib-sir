<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\StreamedResponse;

class BookingController extends Controller
{
    private function filteredQuery(Request $request)
    {
        $query = Booking::with('tour');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('booking_reference', 'like', "%{$s}%")
                  ->orWhere('customer_name', 'like', "%{$s}%")
                  ->orWhere('customer_email', 'like', "%{$s}%")
                  ->orWhere('customer_phone', 'like', "%{$s}%");
            });
        }

        return $query;
    }

    public function index(Request $request)
    {
        $bookings = $this->filteredQuery($request)->latest()->paginate(20)->withQueryString();

        return view('pages.admin.bookings.index', compact('bookings'));
    }

    public function export(Request $request): StreamedResponse
    {
        $bookings = $this->filteredQuery($request)->latest()->get();
        $filename = 'bongo-tanbo-bookings-' . date('Y-m-d') . '.csv';

        return response()->streamDownload(function () use ($bookings) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, [
                'Reference',
                'Customer Name',
                'Email',
                'Phone',
                'Tour / Destination',
                'Departure Date',
                'Time Slot',
                'Adults',
                'Children',
                'Status',
                'Special Requests',
                'Submitted At',
            ]);

            foreach ($bookings as $b) {
                fputcsv($handle, [
                    $b->booking_reference,
                    $b->customer_name,
                    $b->customer_email,
                    $b->customer_phone,
                    $b->destination_interest ?? ($b->tour->title ?? 'Custom Inquiry'),
                    $b->departure_date ? $b->departure_date->format('Y-m-d') : 'Flexible',
                    $b->time_slot ?? 'Flexible',
                    $b->adults_count,
                    $b->children_count,
                    ucfirst($b->status),
                    $b->special_requests ?? '',
                    $b->created_at ? $b->created_at->format('Y-m-d H:i') : '',
                ]);
            }

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $request->validate([
            'status' => 'required|in:pending,contacted,confirmed,cancelled',
        ]);

        $booking->update(['status' => $request->status]);
        Cache::forget('admin_sidebar_counts');

        return redirect()->back()->with('success', 'Booking status updated to ' . ucfirst($request->status));
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();
        Cache::forget('admin_sidebar_counts');

        return redirect()->back()->with('success', 'Booking inquiry deleted.');
    }
}
