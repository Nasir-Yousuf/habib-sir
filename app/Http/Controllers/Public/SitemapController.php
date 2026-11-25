<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Destination;
use App\Models\Tour;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    public function index()
    {
        $content = Cache::remember('sitemap_xml', 3600, function () {
            $tours = Tour::where('is_active', true)->get();
            $destinations = Destination::all();
            $blogs = Blog::where('is_published', true)->get();

            return view('pages.public.sitemap', compact('tours', 'destinations', 'blogs'))->render();
        });

        return response($content, 200)->header('Content-Type', 'text/xml');
    }

    public function robots()
    {
        $content = "User-agent: *\nAllow: /\nDisallow: /admin/\nDisallow: /login\n\nSitemap: " . url('/sitemap.xml');
        return response($content, 200)->header('Content-Type', 'text/plain');
    }
}
