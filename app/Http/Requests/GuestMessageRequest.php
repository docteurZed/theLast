<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuestMessageRequest extends FormRequest
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
            'phone' => 'required|string|max:16',
            'email' => 'required|string|email',
            'message' => 'required|string',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Le nom',
            'phone' => 'Le numéro de téléphone',
            'email' => 'L\'adresse email',
            'message' => 'Le message',
        ];
    }
}
