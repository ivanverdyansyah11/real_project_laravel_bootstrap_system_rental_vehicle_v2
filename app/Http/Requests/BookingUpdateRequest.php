<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'bookings_id' => 'required|integer',
            'total_price' => 'required|string',
            'paid_image' => 'required|file|image|mimes:png,jpg,jpeg,gif,webp,svg|max:2048',
            'total_paid' => 'required|string',
            'total_change' => 'required|string',
            'payment_method' => 'required|string|max:50',
            'status' => 'required|integer',
        ];
    }
}
