<?php
namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller {

    public function csrfToken() {
        return csrf_token();
    }

    public function index() {
        try {
            $projects = Project::all();
            return response()->json($projects, 200);  // Return all projects with status 200
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching projects.'], 500);  // Internal server error
        }
    }

    public function store(Request $request) {
        // Validate the input data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:open,in_progress,completed',
        ], [
            'name.required' => 'The project title is required.',
            'name.string' => 'The project title must be a valid string.',
            'name.max' => 'The project title should not exceed 255 characters.',
            'status.required' => 'The project status is required.',
            'status.in' => 'The project status must be one of the following: open, in_progress, completed.',
        ]);

        try {
            $project = Project::create([
                'title' => $request->name,  // mapping 'name' to 'title'
                'description' => $request->description,
                'status' => $request->status,
            ]);
            return response()->json($project, 201);  // Return the created project with status 201
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while creating the project.'], 500);  // Internal server error
        }
    }

    public function show($id) {
        try {
            $project = Project::findOrFail($id);
            return response()->json($project, 200);  // Return the project with status 200
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Project not found.'], 404);  // Not found error
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching the project.'], 500);  // Internal server error
        }
    }

    public function update(Request $request, $id) {
        // Validate the input data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:open,in_progress,completed',
        ], [
            'title.required' => 'The project title is required.',
            'title.string' => 'The project title must be a valid string.',
            'title.max' => 'The project title should not exceed 255 characters.',
            'status.required' => 'The project status is required.',
            'status.in' => 'The project status must be one of the following: open, in_progress, completed.',
        ]);

        try {
            $project = Project::findOrFail($id);
            $project->update($request->all());
            return response()->json($project, 200);  // Return the updated project with status 200
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Project not found.'], 404);  // Not found error
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while updating the project.'], 500);  // Internal server error
        }
    }

    public function destroy($id) {
        try {
            $project = Project::findOrFail($id);
            $project->delete();
            return response()->json(null, 204);  // Return no content with status 204
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Project not found.'], 404);  // Not found error
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while deleting the project.'], 500);  // Internal server error
        }
    }
}
