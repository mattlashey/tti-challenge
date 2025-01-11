<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @OA\Get(
 *     path="/tasks/{id}",
 *     operationId="getTask",
 *     tags={"Tasks"},
 *     summary="Get a specific task by ID",
 *     description="Retrieves a task by its ID and returns its details.",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="The ID of the task to retrieve",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Task retrieved successfully",
 *         @OA\JsonContent(ref="#/components/schemas/TaskResource")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Task not found",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Task not found")
 *         )
 *     )
 * )
 */
class GetController extends Controller
{
    public function __invoke($id): JsonResponse
    {
        $task = Task::find($id);
        if (!$task) {
            throw new NotFoundHttpException("Task not found");
        }
        return TaskResource::make($task)->response()->setStatusCode(200);
    }
}
