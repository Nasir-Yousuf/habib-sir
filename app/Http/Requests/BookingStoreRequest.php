<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tour_id' => 'nullable|exists:tours,id',
            'customer_name' => 'required|string|max:150',
            'customer_email' => 'required|email|max:191',
            'customer_phone' => 'required|string|max:50',
            'destination_interest' => 'nullable|string|max:150',
            'departure_date' => 'nullable|date',
            'time_slot' => 'nullable|string|max:50',
            'adults_count' => 'nullable|integer|min:1|max:50',
            'children_count' => 'nullable|integer|min:0|max:50',
            'special_requests' => 'nullable|string|max:1000',
        ];
    }
}
