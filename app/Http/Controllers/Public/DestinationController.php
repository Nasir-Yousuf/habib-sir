<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Tour;
use Illuminate\Support\Facades\Cache;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Cache::remember('destinations_with_count', 3600, function () {
            return Destination::withCount('tours')->get();
        });

        return view('pages.public.destinations.index', compact('destinations'));
    }

    public function show($slug)
    {
        $destination = Cache::remember("destination_detail_{$slug}", 3600, function () use ($slug) {
            return Destination::where('slug', $slug)->firstOrFail();
        });

        $tours = Tour::with('category')
            ->where('destination_id', $destination->id)
            ->where('is_active', true)
            ->paginate(9);

        return view('pages.public.destinations.show', compact('destination', 'tours'));
    }
}
