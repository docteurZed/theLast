<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'email' => 'required|string|email',
            'phone' => 'required|string|max:16',
            'participation_fee' => 'required|numeric',
            'decompt_event_date' => 'required|date',
            'decompt_event_time' => 'required|regex:/^\d{2}:\d{2}(:\d{2})?$/',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Le nom',
            'email' => 'L\'adresse email',
            'phone' => 'Le numéro de téléphone',
            'participation_fee' => 'Le montant de participation',
            'decompt_event_date' => 'La date pour la décompte',
            'decompt_event_time' => 'L\'heure pour la décompte',
        ];
    }
}
