<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'email' => 'required|email:dns|max:255',
            'password' => 'required|string|min:3|max:255',
            'fullname' => 'required|string|max:100',
            'nik' => 'required|string|max:16',
            'phone_number' => 'required|string|max:20',
            'identity_card_number' => 'required|string|max:16',
            'family_card_number' => 'required|string|max:16',
            'profile_image' => 'required|file|image|mimes:png,jpg,jpeg,gif,webp,svg|max:2048',
            'address' => 'required|string',
        ];
    }
}
