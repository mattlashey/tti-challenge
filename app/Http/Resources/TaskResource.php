<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="TaskResource",
 *     type="object",
 *     @OA\Property(property="id", type="integer", description="The ID of the task"),
 *     @OA\Property(property="title", type="string", description="The title of the task"),
 *     @OA\Property(property="description", type="string", description="The description of the task"),
 *     @OA\Property(property="assigned_to", type="string", description="The user to whom the task is assigned"),
 *     @OA\Property(property="due_date", type="string", format="date", description="The due date for the task"),
 *     @OA\Property(property="status", type="string", enum={"to_do", "in_progress", "done"}, description="The status of the task"),
 *     @OA\Property(property="project_id", type="integer", description="The ID of the associated project")
 * )
 */
class TaskResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'assigned_to' => $this->assigned_to,
            'due_date' => $this->due_date,
            'status' => $this->status,
            'project_id' => $this->project_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
