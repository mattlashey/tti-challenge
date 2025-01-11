<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;

/**
 * @OA\Get(
 *     path="/projects",
 *     operationId="getAllProjects",
 *     tags={"Projects"},
 *     summary="Get all projects",
 *     description="Fetches a list of all projects.",
 *     @OA\Response(
 *         response=200,
 *         description="List of projects retrieved successfully",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/ProjectResource")
 *         )
 *     )
 * )
 */
class GetAllController extends Controller
{
    public function __invoke()
    {
        return ProjectResource::collection(Project::all());
    }
}
