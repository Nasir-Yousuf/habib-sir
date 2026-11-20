<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DestinationController extends Controller
{
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

        return redirect()->back()->with('success', 'Destination created successfully!');
    }

    public function update(Request $request, $id)
    {
        $destination = Destination::findOrFail($id);

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

        return redirect()->back()->with('success', 'Destination updated successfully!');
    }

    public function destroy($id)
    {
        $destination = Destination::findOrFail($id);
        $destination->delete();

        return redirect()->back()->with('success', 'Destination removed successfully!');
    }
}
