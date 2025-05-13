<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'          => 'required|string|max:255',
            'first_name'    => 'required|string|max:255',
            'phone'         => 'required|string|max:16',
            'password'      => 'nullable|string|min:8',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg',
            'bio'           => 'nullable|string|max:500',
        ];
    }

    public function attributes(): array
    {
        return [
            'name'          => 'Le nom',
            'first_name'    => 'Le prénom',
            'phone'         => 'Le numéro de téléphone',
            'password'      => 'Le mot de passe',
            'profile_photo' => 'La photo de profil',
            'bio'           => 'La biographie',
        ];
    }
}
