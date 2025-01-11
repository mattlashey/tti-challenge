<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @OA\Put(
 *     path="/projects/{id}",
 *     operationId="editProject",
 *     tags={"Projects"},
 *     summary="Edit a project by ID",
 *     description="Updates a specific project with the provided data.",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the project to edit",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/ProjectRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Project updated successfully",
 *         @OA\JsonContent(ref="#/components/schemas/ProjectResource")
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
class EditController extends Controller
{
    public function __invoke(ProjectRequest $request, $id): JsonResponse
    {
        $data = $request->validated();

        $project = Project::find($id);

        if (!$project) {
            throw new NotFoundHttpException('Project not found');
        }

        $project->update($data);

        return ProjectResource::make($project)->response()->setStatusCode(200);
    }
}
