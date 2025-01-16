<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * List all tasks in the db.
     */
    public function index()
    {
        try {
            // Fetch all tasks from the db
            $tasks = Task::all();

            // Return the list of tasks with a 200 OK response
            return response()->json($tasks, 200);
        } catch (\Exception $e) {
            // Handle unexpected errors
            return response()->json(['error' => 'Failed to fetch tasks.'], 500);
        }
    }

    /**
     * List all tasks for a specific project.
     */
    public function tasksByProject($projectId)
    {
        try {
            // Check if the project exists
            $project = Project::findOrFail($projectId);

            // Fetch tasks related to the specific project
            $tasks = $project->tasks;

            // Return the tasks related to the project with a 200 OK response
            return response()->json($tasks, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle the case where the project is not found
            return response()->json(['error' => 'Project not found.'], 404);
        } catch (\Exception $e) {
            // Handle unexpected errors
            return response()->json(['error' => 'Failed to fetch project tasks.'], 500);
        }
    }

    /**
     * Create a new task for a specific project.
     */
    public function store(Request $request, $projectId)
    {
        try {
            // Check the project exists
            $project = Project::findOrFail($projectId);

            // Validate the  request
            $validatedData = $request->validate([
                'title' => 'required|string|max:255', // Title is required
                'description' => 'nullable|string', // Description is optional
                'assigned_to' => 'nullable|string|max:255', // Assigned user is optional
                'due_date' => 'nullable|date', // Due date is optional but must be a valid date
                'status' => 'required|in:to_do,in_progress,done', // Status must be valid
            ]);

            // Add the project ID to the validated data
            $validatedData['project_id'] = $project->id;

            // Create the new task
            $task = Task::create($validatedData);

            // Return the newly created task with a 201 Created response
            return response()->json($task, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle the case where the project is not found
            return response()->json(['error' => 'Project not found.'], 404);
        } catch (\Exception $e) {
            // Handle unexpected errors
            return response()->json(['error' => 'Failed to create task.'], 500);
        }
    }

    /**
     * Show details of a  task by its ID.
     */
    public function show($id)
    {
        try {
            // Find the task by its ID
            $task = Task::findOrFail($id);

            // Return the task details with a 200 OK response
            return response()->json($task, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle the case where the task is not found
            return response()->json(['error' => 'Task not found.'], 404);
        } catch (\Exception $e) {
            // Handle unexpected errors
            return response()->json(['error' => 'Failed to fetch task.'], 500);
        }
    }

    /**
     * Update an existing task by its ID.
     */
    public function update(Request $request, $id)
    {
        try {
            // Validate the request
            $validatedData = $request->validate([
                'title' => 'required|string|max:255', // Title is required
                'description' => 'nullable|string', // Description is optional
                'assigned_to' => 'nullable|string|max:255', // Assigned user is optional
                'due_date' => 'nullable|date', // Due date is optional but must be a valid date
                'status' => 'required|in:to_do,in_progress,done', // Status must be valid
            ]);

            // Find the task by its ID
            $task = Task::findOrFail($id);

            // Update the task with the validated data
            $task->update($validatedData);

            // Return the updated task with a 200 OK response
            return response()->json($task, 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle the case where the task is not found
            return response()->json(['error' => 'Task not found.'], 404);
        } catch (\Exception $e) {
            // Handle unexpected errors
            return response()->json(['error' => 'Failed to update task.'], 500);
        }
    }

    /**
     * Delete a task by its ID.
     */
    public function destroy($id)
    {
        try {
            // Find the task by its ID
            $task = Task::findOrFail($id);

            // Delete the task from the database
            $task->delete();

            // Return a success message with a 200 OK response
            return response()->json(['message' => 'Task deleted successfully.'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle the case where the task is not found
            return response()->json(['error' => 'Task not found.'], 404);
        } catch (\Exception $e) {
            // Handle unexpected errors
            return response()->json(['error' => 'Failed to delete task.'], 500);
        }
    }
}
