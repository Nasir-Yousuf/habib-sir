<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactStoreRequest;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Cache;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.public.contact');
    }

    public function store(ContactStoreRequest $request)
    {
        ContactMessage::create($request->validated());
        Cache::forget('admin_sidebar_counts');

        return redirect()->back()->with('success', 'Thank you for reaching out to Bongo Tanbo Travels! Our tour specialist will contact you shortly.');
    }
}
