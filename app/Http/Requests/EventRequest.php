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
        return [
            'name' => ['required', 'string', 'max:255'],
            'starts_at' => ['required', 'date'],
            'location' => ['required', 'string', 'max:255'],
            'location_latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'location_longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'dress_code' => ['nullable', 'string', 'max:255'],
            'primary_color_name' => ['required', 'string', 'max:50'],
            'primary_color_hex' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'secondary_color_name' => ['nullable', 'string', 'max:50'],
            'secondary_color_hex' => ['nullable', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'primary_image' => ['required', 'image', 'max:2048'],
            'secondary_image' => ['nullable', 'image', 'max:2048'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Le nom',
            'starts_at' => 'La date et l\'heure',
            'location' => 'Le lieu',
            'location_latitude' => 'La latitude',
            'location_longitude' => 'La longitude',
            'dress_code' => 'Le code vestimentaire',
            'primary_color_name' => 'La couleur principale',
            'primary_color_hex' => 'Le code hexadécimal de la couleur principale',
            'secondary_color_name' => 'La couleur secondaire',
            'secondary_color_hex' => 'Le code hexadécimal de la couleur secondaire',
            'primary_image' => 'L\'image principale',
            'secondary_image' => 'L\'image secondaire',
        ];
    }
}
