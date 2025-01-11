<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Post(
 *     path="/projects",
 *     operationId="createProject",
 *     tags={"Projects"},
 *     summary="Create a new project",
 *     description="This endpoint creates a new project with the provided details.",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/ProjectRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Project created successfully",
 *         @OA\JsonContent(ref="#/components/schemas/ProjectResource")
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation errors",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="The given data was invalid."),
 *             @OA\Property(property="errors", type="object", example={"title": {"The title field is required."}})
 *         )
 *     )
 * )
 */
class CreateController extends Controller
{
    public function __invoke(ProjectRequest $request): JsonResponse
    {
        $data = $request->validated();

        $project = Project::create($data);

        return ProjectResource::make($project)->response()->setStatusCode(201);
    }
}
