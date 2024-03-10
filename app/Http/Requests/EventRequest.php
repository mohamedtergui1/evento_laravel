<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
        return  [
            'title' => 'required|string|max:50',
            'description' => 'required|string',
            'capacity' => 'required|integer|min:1',
            'rest_places' => 'integer|min:0|max:capacity',
            'date' => 'required|date|after:+1 day',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'status' => 'nullable|in:accepted,rejected',
            'autoAccept' => 'nullable|boolean',
            'image' => 'required|mimes:png,jpeg,jpg,webp'
        ];



    }
}
