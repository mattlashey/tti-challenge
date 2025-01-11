<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Get(
 *     path="/projects/{id}",
 *     operationId="getProject",
 *     tags={"Projects"},
 *     summary="Get a project by ID",
 *     description="Fetches a specific project by its ID.",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the project to fetch",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Project retrieved successfully",
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
class GetController extends Controller
{
    public function __invoke($id): JsonResponse
    {
        return ProjectResource::make(Project::find($id))->response()->setStatusCode(200);
    }
}
