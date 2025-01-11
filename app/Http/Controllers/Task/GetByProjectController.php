<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @OA\Get(
 *     path="/projects/{project_id}/tasks",
 *     operationId="getProjectTasks",
 *     tags={"Tasks"},
 *     summary="Get tasks for a specific project",
 *     description="Retrieves all tasks associated with a specific project, ordered by priority in ascending order.",
 *     @OA\Parameter(
 *         name="project_id",
 *         in="path",
 *         required=true,
 *         description="The ID of the project for which tasks are retrieved",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="List of tasks retrieved successfully",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/TaskResource")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Project not found",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Project not found")
 *         )
 *     )
 * )
 */
class GetByProjectController extends Controller
{
    public function __invoke($project_id): JsonResponse
    {
        if (!Project::find($project_id)) {
            throw new NotFoundHttpException("Project not found");
        }
        return TaskResource::collection(Task::where('project_id', $project_id)->orderBy('created_at', 'asc')->get())->response()->setStatusCode(200);
    }
}
