<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Get(
 *     path="/tasks",
 *     operationId="getAllTasks",
 *     tags={"Tasks"},
 *     summary="Get all tasks",
 *     description="Retrieves all tasks, ordered by priority in ascending order.",
 *     @OA\Response(
 *         response=200,
 *         description="List of tasks retrieved successfully",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/TaskResource")
 *         )
 *     )
 * )
 */
class GetAllController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return TaskResource::collection(Task::orderBy('created_at', 'asc')->get())->response()->setStatusCode(200);
    }
}
