<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Destination;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $featuredTours = Cache::remember('home_featured_tours', 3600, function () {
            return Tour::with(['category', 'destination'])
                ->where('is_active', true)
                ->where('is_featured', true)
                ->take(8)
                ->get();
        });

        $categories = Cache::remember('all_categories', 3600, function () {
            return Category::where('is_active', true)
                ->orderBy('sort_order')
                ->get();
        });

        $destinations = Cache::remember('all_destinations', 3600, function () {
            return Destination::where('is_featured', true)->get();
        });

        $latestBlogs = Cache::remember('home_latest_blogs', 3600, function () {
            return Blog::where('is_published', true)
                ->latest('published_at')
                ->take(4)
                ->get();
        });

        return view('pages.public.home', compact('featuredTours', 'categories', 'destinations', 'latestBlogs'));
    }
}
