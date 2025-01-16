<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectPostRequest;
use App\Http\Requests\ProjectPutRequest;
use App\Http\Resources\Project as ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new ProjectResource(Project::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectPostRequest $request)
    {
        $project = Project::create($request->all());
        return ProjectResource::make($project)->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Project not found',
            ], 404);
        }

        return new ProjectResource($project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectPutRequest $request, int $id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Project not found',
            ], 404);
        }
        $project->update($request->all());

        return new ProjectResource($project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Project not found',
            ], 404);
        }
        Project::destroy($id);
        
        return response()->json([
            'success' => true,
            'message' => 'Project deleted succesfully'
        ], 204);
    }
}
