<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    
    public function index()
    {
        return response()->json(['status' => 'success','data' => Project::with('tasks')->get()], 200);
    }

    public function store(StoreProjectRequest $request)
    {
        try {
            $project = Project::create($request->validated());
            return response()->json([
                'status' => 'success',
                'message' => 'Project created successfully!',
                'project' => $project,
            ], 201);
        }catch (\Exception $e) {
            // Log the exception with line number
            Log::error('Failed to create project: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create project. Please try again later.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            // Attempt to find the project and load related tasks
            $project = Project::with('tasks')->findOrFail($id);
    
            // Return the project as JSON
            return response()->json([
                'status' => 'success',
                'message' => 'Project retrieved successfully!',
                'data' => $project,
            ], 200);
    
        }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Log not found exception with details
            Log::warning('Project not found', [
                'id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
    
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to find project!',
            ], 404);
    
        }catch(\Exception $e) {
            // Log unexpected exceptions with details
            Log::error('An error occurred while retrieving the project: ' . $e->getMessage(), [
                'id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
    
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to show project. Please try again later.',
            ], 500);
        }
    }

    public function update(UpdateProjectRequest $request, $id)
    {
        try {
            // Attempt to find the project
            $project = Project::findOrFail($id);
    
            // Update the project with validated data
            $project->update($request->validated());
    
            // Return the updated project
            return response()->json([
                'status' => 'success',
                'message' => 'Project updated successfully!',
                'data' => $project,
            ], 200);
    
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Log the exception if the project is not found
            Log::warning('Project not found for update', [
                'id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
    
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to find project.Project not found!',
            ], 404);
    
        } catch (\Exception $e) {
            // Log unexpected exceptions with details
            Log::error('An error occurred while updating the project: ' . $e->getMessage(), [
                'id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
    
            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred. Please try again later.',
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            // Attempt to find the project
            $project = Project::findOrFail($id);
    
            // Update the project with validated data
            $project->delete();
    
            // Return the updated project
            return response()->json([
                'status' => 'success',
                'message' => 'Project deleted successfully!',
            ], 200);
    
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Log the exception if the project is not found
            Log::warning('Project not found for delete', [
                'id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
    
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to find project.Project not found!',
            ], 404);
    
        } catch (\Exception $e) {
            // Log unexpected exceptions with details
            Log::error('An error occurred while deleting the project: ' . $e->getMessage(), [
                'id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
    
            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred. Please try again later.',
            ], 500);
        }
    }
}

