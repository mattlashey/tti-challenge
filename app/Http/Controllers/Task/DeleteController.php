<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Resources\DeletedResource;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @OA\Delete(
 *     path="/tasks/{id}",
 *     operationId="deleteTask",
 *     tags={"Tasks"},
 *     summary="Delete a task",
 *     description="Deletes a specific task by its ID.",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="The ID of the task to delete",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="Task deleted successfully",
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
class DeleteController extends Controller
{
    public function __invoke($id): JsonResponse
    {
        $task = Task::find($id);

        if(!$task){
            throw new NotFoundHttpException('Task not found');
        }

        $task->delete();

        return DeletedResource::make($task)->response()->setStatusCode(204);
    }
}
