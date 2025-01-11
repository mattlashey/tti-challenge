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
 * @OA\Post(
 *     path="/projects/{project_id}/tasks",
 *     operationId="createTask",
 *     tags={"Tasks"},
 *     summary="Create a task for a project",
 *     description="Creates a new task associated with a specific project.",
 *     @OA\Parameter(
 *         name="project_id",
 *         in="path",
 *         required=true,
 *         description="The ID of the project to which the task belongs",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/TaskRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Task created successfully",
 *         @OA\JsonContent(ref="#/components/schemas/TaskResource")
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
class CreateController extends Controller
{
    public function __invoke(TaskRequest $request, $project_id): JsonResponse
    {
        if(!Project::find($project_id)) {
            throw new NotFoundHttpException('Project not found');
        }

        $data = $request->validated();
        $data['project_id'] = $project_id;

        $task = Task::create($data);

        return TaskResource::make($task)->response()->setStatusCode(201);
    }
}
