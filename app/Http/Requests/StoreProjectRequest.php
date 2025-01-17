<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProjectRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => ['required', Rule::in(['open', 'in_progress', 'completed'])],
        ];
    }
}
