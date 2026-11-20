<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Tour;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::withCount('tours')->get();
        return view('pages.public.destinations.index', compact('destinations'));
    }

    public function show($slug)
    {
        $destination = Destination::where('slug', $slug)->firstOrFail();
        $tours = Tour::with('category')
            ->where('destination_id', $destination->id)
            ->where('is_active', true)
            ->paginate(9);

        return view('pages.public.destinations.show', compact('destination', 'tours'));
    }
}
