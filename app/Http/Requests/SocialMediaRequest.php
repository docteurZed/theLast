<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SocialMediaRequest extends FormRequest
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
            'links' => ['required', 'array'],
            'links.*' => ['nullable', 'url', 'max:255'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $allowed = ['linkedin', 'facebook', 'instagram', 'x', 'whatsapp', 'tiktok'];
            $keys = array_keys($this->input('links', []));

            foreach ($keys as $key) {
                if (!in_array($key, $allowed)) {
                    $validator->errors()->add("links.$key", "La plateforme '$key' n'est pas autorisée.");
                }
            }
        });
    }

    public function attributes(): array
    {
        return [
            'links' => 'Liens sociaux',
            'links.*' => 'Lien de la plateforme',
        ];
    }
}
