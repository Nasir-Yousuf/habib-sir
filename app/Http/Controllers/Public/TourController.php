<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Destination;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TourController extends Controller
{
    public function index(Request $request)
    {
        $query = Tour::with(['category', 'destination'])->where('is_active', true);

        // Search Keyword
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('overview', 'like', "%{$search}%")
                  ->orWhere('badge_text', 'like', "%{$search}%");
            });
        }

        // Filter by Category
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filter by Destination
        if ($request->filled('destination')) {
            $destinationSlug = $request->destination;
            $query->whereHas('destination', function ($q) use ($destinationSlug) {
                $q->where('slug', 'like', "%{$destinationSlug}%")
                  ->orWhere('name', 'like', "%{$destinationSlug}%");
            });
        }

        // Filter by Duration
        if ($request->filled('duration')) {
            $duration = $request->duration;
            if (str_contains($duration, '3-days')) {
                $query->where('duration_days', '<=', 3);
            } elseif (str_contains($duration, '5-days')) {
                $query->where('duration_days', 5);
            } elseif (str_contains($duration, '7-days')) {
                $query->where('duration_days', 7);
            } elseif (str_contains($duration, '8-days')) {
                $query->where('duration_days', 8);
            } elseif (str_contains($duration, '10-days')) {
                $query->where('duration_days', 10);
            } elseif (str_contains($duration, '12-days')) {
                $query->where('duration_days', '>=', 12);
            }
        }

        // Sort
        if ($request->sort === 'price_asc') {
            $query->orderBy('starting_price', 'asc');
        } elseif ($request->sort === 'price_desc') {
            $query->orderBy('starting_price', 'desc');
        } elseif ($request->sort === 'duration_desc') {
            $query->orderBy('duration_days', 'desc');
        } else {
            $query->latest();
        }

        $tours = $query->paginate(12)->withQueryString();
        $categories = Cache::remember('all_categories', 3600, function () {
            return Category::where('is_active', true)->orderBy('sort_order')->get();
        });
        $destinations = Cache::remember('public_destinations_all', 3600, function () {
            return Destination::all();
        });

        return view('pages.public.tours.index', compact('tours', 'categories', 'destinations'));
    }

    public function show($slug)
    {
        $tour = Cache::remember("tour_detail_{$slug}", 1800, function () use ($slug) {
            return Tour::with(['category', 'destination', 'itineraries', 'images'])
                ->where('slug', $slug)
                ->where('is_active', true)
                ->firstOrFail();
        });

        $relatedTours = Cache::remember("tour_related_{$tour->id}", 1800, function () use ($tour) {
            return Tour::with(['category', 'destination'])
                ->where('id', '!=', $tour->id)
                ->where(function ($q) use ($tour) {
                    $q->where('category_id', $tour->category_id)
                      ->orWhere('destination_id', $tour->destination_id);
                })
                ->where('is_active', true)
                ->take(3)
                ->get();
        });

        return view('pages.public.tours.show', compact('tour', 'relatedTours'));
    }
}
