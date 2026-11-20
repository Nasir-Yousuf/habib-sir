<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'destination_id',
        'title',
        'slug',
        'duration_days',
        'duration_nights',
        'places_count',
        'starting_price',
        'currency',
        'badge_text',
        'overview',
        'inclusions',
        'exclusions',
        'difficulty',
        'featured_image',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'inclusions' => 'array',
        'exclusions' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'starting_price' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function itineraries()
    {
        return $this->hasMany(TourItinerary::class)->orderBy('day_number');
    }

    public function images()
    {
        return $this->hasMany(TourImage::class)->orderBy('sort_order');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
