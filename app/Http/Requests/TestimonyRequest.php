<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestimonyRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:png,jpg,jpeg',
            'testimony' => 'required|string',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Le nom',
            'image' => 'L\'image',
            'testimony' => 'Le témoignage',
        ];
    }
}
