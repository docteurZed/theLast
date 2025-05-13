<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'description' => ['nullable', 'string'],
            'due_date' => ['nullable', 'date'],
            'priority' => ['required', 'in:low,medium,high,critical'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png'],
            'userIds' => ['required', 'array'],
            'userIds.*' => ['exists:users,id']
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Le nom de la tâche',
            'description' => 'La description de la tâche',
            'due_date' => 'Le deadline de la tâche',
            'priority' => 'La priorité de la tâche',
            'L\'image' => 'Le statut de la tâche',
        ];
    }
}
