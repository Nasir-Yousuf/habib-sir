<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('is_published', true)->latest('published_at')->paginate(8);
        return view('pages.public.blog.index', compact('blogs'));
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->where('is_published', true)->firstOrFail();
        $recentBlogs = Blog::where('id', '!=', $blog->id)->where('is_published', true)->latest('published_at')->take(4)->get();

        return view('pages.public.blog.show', compact('blog', 'recentBlogs'));
    }
}
