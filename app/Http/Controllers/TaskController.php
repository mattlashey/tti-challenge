<?php
namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller {
    
    public function index() {
        try {
            $tasks = Task::all();
            return response()->json($tasks, 200);  // Return all tasks with status 200
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching tasks.'], 500);  // Internal server error
        }
    }

    public function store(Request $request, $project_id) {
        // Validate the input data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:to_do,in_progress,done',
        ], [
            'title.required' => 'The task title is required.',
            'title.string' => 'The task title must be a valid string.',
            'title.max' => 'The task title should not exceed 255 characters.',
            'status.required' => 'The task status is required.',
            'status.in' => 'The task status must be one of the following: to_do, in_progress, done.',
        ]);

        try {
            $project = Project::findOrFail($project_id);  // Handle project not found
            $task = $project->tasks()->create($request->all());  // Create task within the project
            return response()->json($task, 201);  // Return the created task with status 201
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Project not found.'], 404);  // Project not found error
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while creating the task.'], 500);  // Internal server error
        }
    }

    public function show($id) {
        try {
            $task = Task::findOrFail($id);  // Handle task not found
            return response()->json($task, 200);  // Return task with status 200
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Task not found.'], 404);  // Task not found error
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching the task.'], 500);  // Internal server error
        }
    }

    public function update(Request $request, $id) {
        // Validate the input data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:to_do,in_progress,done',
        ], [
            'title.required' => 'The task title is required.',
            'title.string' => 'The task title must be a valid string.',
            'title.max' => 'The task title should not exceed 255 characters.',
            'status.required' => 'The task status is required.',
            'status.in' => 'The task status must be one of the following: to_do, in_progress, done.',
        ]);

        try {
            $task = Task::findOrFail($id);  // Handle task not found
            $task->update($request->all());  // Update task with the request data
            return response()->json($task, 200);  // Return updated task with status 200
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Task not found.'], 404);  // Task not found error
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while updating the task.'], 500);  // Internal server error
        }
    }

    public function destroy($id) {
        try {
            $task = Task::findOrFail($id);  // Handle task not found
            $task->delete();  // Delete task
            return response()->json(null, 204);  // Return no content with status 204
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Task not found.'], 404);  // Task not found error
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while deleting the task.'], 500);  // Internal server error
        }
    }
}
