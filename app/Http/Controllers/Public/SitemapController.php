<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Destination;
use App\Models\Tour;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $tours = Tour::where('is_active', true)->get();
        $destinations = Destination::all();
        $blogs = Blog::where('is_published', true)->get();

        $content = view('pages.public.sitemap', compact('tours', 'destinations', 'blogs'))->render();

        return response($content, 200)->header('Content-Type', 'text/xml');
    }

    public function robots()
    {
        $content = "User-agent: *\nAllow: /\nDisallow: /admin/\nDisallow: /login\n\nSitemap: " . url('/sitemap.xml');
        return response($content, 200)->header('Content-Type', 'text/plain');
    }
}
