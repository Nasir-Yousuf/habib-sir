<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TourStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $tourId = $this->route('tour') ? $this->route('tour') : null;

        return [
            'category_id' => 'nullable|exists:categories,id',
            'destination_id' => 'nullable|exists:destinations,id',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:tours,slug,' . $tourId,
            'duration_days' => 'required|integer|min:1',
            'duration_nights' => 'nullable|integer|min:0',
            'places_count' => 'required|integer|min:1',
            'starting_price' => 'nullable|numeric|min:0',
            'currency' => 'nullable|string|max:10',
            'badge_text' => 'nullable|string|max:100',
            'overview' => 'nullable|string',
            'difficulty' => 'required|string',
            'featured_image' => 'nullable|string|max:255',
            'featured_image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'inclusions_text' => 'nullable|string',
            'exclusions_text' => 'nullable|string',
        ];
    }
}
