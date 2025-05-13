<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpecialGuestRequest extends FormRequest
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
    public function rules(): array {
        return [
            'title' => 'required|in:dr,prof,mr,mme',
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'domain' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
            'description' => 'nullable|string',
        ];
    }

    public function attributes(): array {
        return [
            'title' => 'Le titre',
            'name' => 'Le nom',
            'role' => 'Le rôle',
            'domain' => 'Le domaine',
            'image' => 'L\'image',
            'description' => 'La description',
        ];
    }
}
