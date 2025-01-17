<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'       => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'status'      => ['sometimes', 'required', Rule::in(['open', 'in_progress', 'completed'])],
        ];
    }
}
