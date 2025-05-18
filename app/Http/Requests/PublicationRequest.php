<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublicationRequest extends FormRequest
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
    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'content' => 'nullable|string|required_without:image',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|required_without:content',
        ];
    }

    public function attributes()
    {
        return [
            'user_id' => 'L\'utilisateur',
            'content' => 'Le contenu',
            'image' => 'L\'image',
        ];
    }
}
