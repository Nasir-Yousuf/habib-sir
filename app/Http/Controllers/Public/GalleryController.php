<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Gallery;
use Illuminate\Support\Facades\Cache;

class GalleryController extends Controller
{
    public function index()
    {
        $destinations = Cache::remember('public_destinations_all', 3600, function () {
            return Destination::all();
        });

        $galleries = Cache::remember('public_galleries', 3600, function () {
            return Gallery::with('destination')->orderBy('sort_order')->get();
        });

        return view('pages.public.gallery', compact('destinations', 'galleries'));
    }
}
