<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class DestinationController extends Controller
{
    private function clearDestinationCache(?string $slug = null): void
    {
        Cache::forget('all_destinations');
        Cache::forget('destinations_with_count');
        Cache::forget('public_destinations_all');
        Cache::forget('sitemap_xml');
        if ($slug) {
            Cache::forget("destination_detail_{$slug}");
        }
    }
    public function index()
    {
        $destinations = Destination::withCount('tours')->latest()->paginate(15);
        return view('pages.admin.destinations.index', compact('destinations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'country' => 'required|string|max:100',
            'tagline' => 'nullable|string|max:191',
            'description' => 'nullable|string',
            'banner_image' => 'nullable|string|max:191',
            'is_featured' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_featured'] = $request->boolean('is_featured');

        Destination::create($validated);
        $this->clearDestinationCache($validated['slug']);

        return redirect()->back()->with('success', 'Destination created successfully!');
    }

    public function update(Request $request, $id)
    {
        $destination = Destination::findOrFail($id);
        $oldSlug = $destination->slug;

        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'country' => 'required|string|max:100',
            'tagline' => 'nullable|string|max:191',
            'description' => 'nullable|string',
            'banner_image' => 'nullable|string|max:191',
            'is_featured' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_featured'] = $request->boolean('is_featured');

        $destination->update($validated);
        $this->clearDestinationCache($oldSlug);
        $this->clearDestinationCache($validated['slug']);

        return redirect()->back()->with('success', 'Destination updated successfully!');
    }

    public function destroy($id)
    {
        $destination = Destination::findOrFail($id);
        $slug = $destination->slug;
        $destination->delete();
        $this->clearDestinationCache($slug);

        return redirect()->back()->with('success', 'Destination removed successfully!');
    }
}
