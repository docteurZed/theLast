<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AchievementRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'date' => 'nullable|date',
            'description' => 'nullable|string',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'L\intitulé',
            'date' => 'La date',
            'description' => 'La description',
        ];
    }
}
