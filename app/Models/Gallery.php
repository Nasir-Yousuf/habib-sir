<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'destination_id',
        'title',
        'image_path',
        'tag',
        'sort_order',
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
