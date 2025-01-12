<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;

class ProjectController extends Controller
{
    //  List all projects: /api/projects
    public function index()
    {
        try {
            $projects = ProjectResource::collection(Project::all());
            return response()->json($projects);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    //Create a new project : /api/projects
    public function store(ProjectRequest $request)
    {
        try {
            $project = Project::create($request->validated());
            return response()->json(new ProjectResource($project), 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    //Show details of a single project : /api/projects/{id}
    public function show($id)
    {
        try {
            $project = Project::findOrFail($id);

            return response()->json([
                'project' => new ProjectResource($project),
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Project not found.',
            ], 404);
        } catch (\Exception $e) {

            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    //Update an existing project : /api/projects/{id}
    public function update(ProjectRequest $request, $id)
    {
        try {
            $project = Project::findOrFail($id);
            $project->update($request->validated());

            return response()->json([
                'message' => 'Project updated successfully.',
                'project' => new ProjectResource($project),
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Project not found.',
            ], 404);
        } catch (\Exception $e) {

            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // Delete a project  : /api/projects/{id}

    public function destroy($id)
    {

        try {
            $project = Project::findOrFail($id);
            $project->tasks()->delete();
            $project->delete();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Project not found.',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }

        return response()->json([
            'message' => 'Project deleted successfully.'
        ]);
    }
}
