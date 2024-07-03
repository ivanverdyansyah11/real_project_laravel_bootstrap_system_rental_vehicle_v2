<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleUpdateRequest extends FormRequest
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
            'vehicle_series_id' => 'required|integer',
            'vehicle_image' => 'nullable|file|image|mimes:png,jpg,jpeg,gif,webp,svg|max:2048',
            'name' => 'required|string|max:100',
            'stnk_name' => 'required|string|max:100',
            'license_plate_number' => 'required|string|max:25',
            'kilometer' => 'required|integer',
            'capacity' => 'required|integer',
            'price' => 'required|string',
            'year_of_creation' => 'required|integer',
            'date_purchased' => 'required|date',
            'color' => 'required|string|max:50',
            'frame_number' => 'required|string|max:100',
            'machine_number' => 'required|string|max:100',
            'status' => 'required|integer',
        ];
    }
}
