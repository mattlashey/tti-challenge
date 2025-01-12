<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * List all projects
     */
    public function index()
    {
        $projects = Project::all();
        return response()->json($projects, 200);
    }

    /**
     * Create a new project
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:open,in_progress,completed',
        ], [
            'title.required' => 'Please provide a title for the project.',
            'status.required' => 'A project status is required (open, in_progress, or completed).',
            'status.in' => 'The status must be one of the following: open, in_progress, completed.',
        ]);

        // If validation passes, create the project
        $project = Project::create($validated);
        return response()->json($project, 201);
    }

    /**
     * Show details of a single project by id
     */
    public function show($id)
    {
        $project = Project::find($id);
        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        return response()->json($project, 200);
    }

    /**
     * Update an existing project
     */
    public function update(Request $request, $id)
    {
        $project = Project::find($id);
        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:open,in_progress,completed',
        ],[
            'title.required' => 'Please provide a title for the project.',
            'status.required' => 'A project status is required (open, in_progress, or completed).',
            'status.in' => 'The status must be one of the following: open, in_progress, completed.',
        ]);

        $project->update($validated);
        return response()->json($project, 200);
    }

    /**
     * Delete a project
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }
        
        $project->delete();
        return response()->json(null, 204);
    }
}
