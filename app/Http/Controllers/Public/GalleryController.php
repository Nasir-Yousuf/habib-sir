<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        $destinations = Destination::all();
        $galleries = Gallery::with('destination')->orderBy('sort_order')->get();

        return view('pages.public.gallery', compact('destinations', 'galleries'));
    }
}
