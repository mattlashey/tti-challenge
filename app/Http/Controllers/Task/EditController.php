<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @OA\Put(
 *     path="/tasks/{id}",
 *     operationId="editTask",
 *     tags={"Tasks"},
 *     summary="Edit a task",
 *     description="Updates the details of a specific task by its ID.",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="The ID of the task to update",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/TaskRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Task updated successfully",
 *         @OA\JsonContent(ref="#/components/schemas/TaskResource")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Task or project not found",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Task not found")
 *         )
 *     )
 * )
 */
class EditController extends Controller
{
    public function __invoke(TaskRequest $request, $id): JsonResponse
    {
        $task = Task::find($id);

        if (!$task) {
            throw new NotFoundHttpException('Task not found');
        }

        $data = $request->validated();

        if(key_exists('project_id', $data)) {
            if (!Project::find($data['project_id'])) {
                throw new NotFoundHttpException('Project not found');
            }
        }

        $task->update($data);

        return TaskResource::make($task)->response()->setStatusCode(200);
    }
}
