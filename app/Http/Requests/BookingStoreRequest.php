<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingStoreRequest extends FormRequest
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
            'customers_id' => 'required|integer',
            'drivers_id' => 'nullable|integer',
            'vehicles_id' => 'required|integer',
            'send_address' => 'required|string',
            'pickup_date' => 'required|date',
            'return_date' => 'required|date',
            'status' => 'required|integer',
        ];
    }
}
