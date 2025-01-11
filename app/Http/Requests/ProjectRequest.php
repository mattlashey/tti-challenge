<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


/**
 * @OA\Schema(
 *     schema="ProjectRequest",
 *     required={"title", "status"},
 *     @OA\Property(property="title", type="string", description="Title of the project"),
 *     @OA\Property(property="description", type="string", nullable=true, description="Description of the project"),
 *     @OA\Property(property="status", type="string", enum={"open", "in_progress", "completed"}, description="Status of the project"),
 * )
 */
class ProjectRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title'         => 'required|string',
            'description'   => '',
            'status'        => 'required|in:open,in_progress, completed',
        ];
    }
}
