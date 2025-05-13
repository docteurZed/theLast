<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventProgramRequest extends FormRequest
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
            'event_id'    => 'required|exists:events,id',
            'starts_at'   => 'required|regex:/^\d{2}:\d{2}(:\d{2})?$/',
            'ends_at'     => 'nullable|regex:/^\d{2}:\d{2}(:\d{2})?$/|after:starts_at',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'speaker'     => 'nullable|string|max:255',
        ];
    }

    public function attributes(): array
    {
        return [
            'event_id'    => 'L\'événement',
            'starts_at'   => 'L\'heure de début',
            'ends_at'     => 'L\'heure de fin',
            'title'       => 'Le titre',
            'description' => 'La description',
            'speaker'     => 'L\'intervenant',
        ];
    }
}
