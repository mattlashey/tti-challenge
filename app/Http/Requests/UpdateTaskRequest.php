<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => 'nullable|string|max:255',
            'due_date' => 'nullable|date',
            'status' => 'sometimes|in:to_do,in_progress,done',
        ];
    }

    /**
     * Get the custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'The task title is required.',
            'title.string' => 'The task title must be a string.',
            'title.max' => 'The task title must not exceed 255 characters.',
            'description.string' => 'The description must be a string.',
            'assigned_to.string' => 'The assigned person must be a valid name.',
            'assigned_to.max' => 'The assigned person name must not exceed 255 characters.',
            'due_date.date' => 'The due date must be a valid date.',
            'status.required' => 'The task status is required.',
            'status.in' => 'The status must be one of the following: to_do, in_progress, done.',
        ];
    }
}
