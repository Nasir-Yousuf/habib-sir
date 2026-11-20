<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TourStoreRequest;
use App\Models\Category;
use App\Models\Destination;
use App\Models\Tour;
use App\Models\TourItinerary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class TourController extends Controller
{
    public function index(Request $request)
    {
        $query = Tour::with(['category', 'destination']);

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $tours = $query->latest()->paginate(15)->withQueryString();
        $categories = Category::all();

        return view('pages.admin.tours.index', compact('tours', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        $destinations = Destination::all();

        return view('pages.admin.tours.create', compact('categories', 'destinations'));
    }

    public function store(TourStoreRequest $request)
    {
        $data = $request->validated();
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        // Handle uploaded image
        if ($request->hasFile('featured_image_file')) {
            $file = $request->file('featured_image_file');
            $filename = 'tour_' . time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('tours', $filename, 'public');
            $data['featured_image'] = 'storage/' . $path;
        }

        // Process inclusions / exclusions strings to JSON array
        if (!empty($request->inclusions_text)) {
            $data['inclusions'] = array_values(array_filter(array_map('trim', explode("\n", $request->inclusions_text))));
        }
        if (!empty($request->exclusions_text)) {
            $data['exclusions'] = array_values(array_filter(array_map('trim', explode("\n", $request->exclusions_text))));
        }

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');

        $tour = Tour::create($data);

        // Process itineraries if provided
        if ($request->has('itineraries') && is_array($request->itineraries)) {
            foreach ($request->itineraries as $index => $item) {
                if (!empty($item['title'])) {
                    TourItinerary::create([
                        'tour_id' => $tour->id,
                        'day_number' => $index + 1,
                        'title' => $item['title'],
                        'description' => $item['description'] ?? '',
                        'accommodation' => $item['accommodation'] ?? null,
                        'meals' => $item['meals'] ?? null,
                    ]);
                }
            }
        }

        Cache::forget('home_featured_tours');

        return redirect()->route('admin.tours.index')->with('success', 'Tour package created successfully!');
    }

    public function edit($id)
    {
        $tour = Tour::with('itineraries')->findOrFail($id);
        $categories = Category::all();
        $destinations = Destination::all();

        return view('pages.admin.tours.edit', compact('tour', 'categories', 'destinations'));
    }

    public function update(TourStoreRequest $request, $id)
    {
        $tour = Tour::findOrFail($id);
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        // Handle uploaded image
        if ($request->hasFile('featured_image_file')) {
            $file = $request->file('featured_image_file');
            $filename = 'tour_' . time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('tours', $filename, 'public');
            $data['featured_image'] = 'storage/' . $path;
        }

        if (!empty($request->inclusions_text)) {
            $data['inclusions'] = array_values(array_filter(array_map('trim', explode("\n", $request->inclusions_text))));
        }
        if (!empty($request->exclusions_text)) {
            $data['exclusions'] = array_values(array_filter(array_map('trim', explode("\n", $request->exclusions_text))));
        }

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');

        $tour->update($data);

        // Itineraries update
        if ($request->has('itineraries') && is_array($request->itineraries)) {
            TourItinerary::where('tour_id', $tour->id)->delete();
            foreach ($request->itineraries as $index => $item) {
                if (!empty($item['title'])) {
                    TourItinerary::create([
                        'tour_id' => $tour->id,
                        'day_number' => $index + 1,
                        'title' => $item['title'],
                        'description' => $item['description'] ?? '',
                        'accommodation' => $item['accommodation'] ?? null,
                        'meals' => $item['meals'] ?? null,
                    ]);
                }
            }
        }

        Cache::forget('home_featured_tours');

        return redirect()->route('admin.tours.index')->with('success', 'Tour updated successfully!');
    }

    public function destroy($id)
    {
        $tour = Tour::findOrFail($id);
        $tour->delete();
        Cache::forget('home_featured_tours');

        return redirect()->route('admin.tours.index')->with('success', 'Tour deleted successfully!');
    }
}
