<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Resources\DeletedResource;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @OA\Delete(
 *     path="/projects/{id}",
 *     operationId="deleteProject",
 *     tags={"Projects"},
 *     summary="Delete a project by ID",
 *     description="Deletes a specific project by its ID.",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the project to delete",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="Project deleted successfully"
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
class DeleteController extends Controller
{
    public function __invoke($id): JsonResponse
    {
        $project = Project::find($id);

        if (!$project) {
            throw new NotFoundHttpException('Project not found');
        }

        $project->delete();

        return DeletedResource::make($project)->response()->setStatusCode(204);
    }
}
