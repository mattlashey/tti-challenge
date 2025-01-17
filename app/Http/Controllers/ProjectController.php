<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends Controller
{
    // Endpoint to List all projects.
    // GET /api/projects
    public function index()
    {
        $projects = Project::all();
        return response()->json($projects, Response::HTTP_OK);
    }

    // Endpoint to Create a new project
    // POST /api/projects
    public function store(StoreProjectRequest $request)
    {
        $project = Project::create($request->validated());
        return response()->json($project, 201);
    }

    // Endpoint to Show details of a single project
    // GET /api/projects/{id}
    public function show($id)
    {
        $project = Project::find($id);
        if (!$project) {
            return response()->json(['message' => 'Project not found'], Response::HTTP_NOT_FOUND);
        }
        return response()->json($project, Response::HTTP_OK);
    }

    // Endpoint to Update an existing project.
    // PUT /api/projects/{id}
    public function update(UpdateProjectRequest $request, $id)
    {
        $project = Project::find($id);
        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        $project->update($request->validated());
        return response()->json($project, 200);
    }

    // Endpoint to Delete a project.
    // DELETE /api/projects/{id}
    public function destroy($id)
    {
        $project = Project::find($id);
        if (!$project) {
            return response()->json(['message' => 'Project not found'], Response::HTTP_NOT_FOUND);
        }

        $project->delete();
        return response()->json(['message' => 'Project deleted successfully'], Response::HTTP_OK);
    }
}
