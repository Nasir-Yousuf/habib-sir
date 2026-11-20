<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_id',
        'booking_reference',
        'customer_name',
        'customer_email',
        'customer_phone',
        'destination_interest',
        'departure_date',
        'time_slot',
        'adults_count',
        'children_count',
        'special_requests',
        'status',
    ];

    protected $casts = [
        'departure_date' => 'date',
        'adults_count' => 'integer',
        'children_count' => 'integer',
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
