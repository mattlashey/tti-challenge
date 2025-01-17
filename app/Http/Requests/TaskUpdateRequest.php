<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use App\Models\Project;

class TaskUpdateRequest extends FormRequest
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
        $project_ids = Project::pluck('id');

        return [
            'project_id' => [
                'required',
                Rule::in($project_ids),
            ],
            'title' => ['nullable'],
            'description' => ['nullable'],
            'assigned_to' => ['nullable'],
            'due_date' => ['nullable', 'date'],
            'status' => [
                'nullable', 
                Rule::in(['to_do', 'in_progress', 'done'])
            ],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Invalid task data provided.',
            'data'      => $validator->errors()
        ], 400));
    }
}
