<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * List all Projects.
     */
    public function index()
    {
        try {
            // Fetch all projects from the db
            $projects = Project::all();

            // Return the list of projects with a 200 OK response
            return response()->json($projects, 200);
        } catch (\Exception $e) {
            // Handle unexpected errors
            return response()->json(['error' => 'Failed to fetch projects.'], 500);
        }
    }

    /**
     * Create a new Project.
     */
    public function store(Request $request)
    {
        try {
            // Validating the request
            $validatedData = $request->validate([
                'title' => 'required|string|max:255', // Title is required and must be a string
                'description' => 'nullable|string', // Description is optional
                'status' => 'required|in:open,in_progress,completed', // Status must be one of these values
            ]);

            // Create the new project with validated data
            $project = Project::create($validatedData);

            // Return the newly created project with a 201 Created response
            return response()->json($project, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            // Handle unexpected errors
            return response()->json(['error' => 'Failed to create project.'], 500);
        }
    }

    /**
     * Display the Project.
     */
    public function show(string $id)
    {
        try {
            // Find the project by its ID
            $project = Project::findOrFail($id);

            // Return the project details with a 200 OK response
            return response()->json($project, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle the case where the project is not found
            return response()->json(['error' => 'Project not found.'], 404);
        } catch (\Exception $e) {
            // Handle unexpected errors
            return response()->json(['error' => 'Failed to fetch project.'], 500);
        }
    }

    /**
     * Update the Project.
     */
    public function update(Request $request, string $id)
    {
        try {
            // Validate the incoming request
            $validatedData = $request->validate([
                'title' => 'required|string|max:255', // Title is required
                'description' => 'nullable|string', // Description is optional
                'status' => 'required|in:open,in_progress,completed', // Status must be valid
            ]);

            // Find the project by its ID
            $project = Project::findOrFail($id);

            // Update the project with the validated data
            $project->update($validatedData);

            // Return the updated project with a 200 OK response
            return response()->json($project, 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle the case where the project is not found
            return response()->json(['error' => 'Project not found.'], 404);
        } catch (\Exception $e) {
            // Handle unexpected errors
            return response()->json(['error' => 'Failed to update project.'], 500);
        }
    }

    /**
     * Remove the Project.
     */
    public function destroy(string $id) {
        try {
            // Find the project by its ID
            $project = Project::findOrFail($id);

            // Delete the project from the database
            $project->delete();

            // Return a success message with a 200 OK response
            return response()->json(['message' => 'Project deleted successfully.'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle the case where the project is not found
            return response()->json(['error' => 'Project not found.'], 404);
        } catch (\Exception $e) {
            // Handle unexpected errors 
            return response()->json(['error' => 'Failed to delete project.'], 500);
        }
    }
}
