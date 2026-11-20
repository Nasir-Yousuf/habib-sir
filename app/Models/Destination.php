<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'country',
        'tagline',
        'description',
        'banner_image',
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }
}
