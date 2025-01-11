<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="TaskRequest",
 *     type="object",
 *     required={"title", "status"},
 *     @OA\Property(property="title", type="string", description="The title of the task"),
 *     @OA\Property(property="description", type="string", description="The description of the task"),
 *     @OA\Property(property="assigned_to", type="string", description="The user to whom the task is assigned"),
 *     @OA\Property(property="due_date", type="string", format="date", description="The due date for the task"),
 *     @OA\Property(property="status", type="string", enum={"to_do", "in_progress", "done"}, description="The status of the task")
 * )
 */
class TaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title'         => 'string|required',
            'description'   => '',
            'assigned_to'   => 'string',
            'due_date'      => 'date',
            'status'        => 'required|in:to_do,in_progress,done',
        ];
    }
}
