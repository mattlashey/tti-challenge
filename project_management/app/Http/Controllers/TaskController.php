<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;

class TaskController extends Controller
{
    /**
     * List all tasks
     */
    public function index()
    {
        $tasks = Task::all(); // Get all tasks
        return response()->json($tasks, 200);
    }

    /**
     * Create a new task under a project
     */
    public function store(Request $request, $project_id)
    {
        $project = Project::find($project_id);
        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => 'nullable|string|max:255',
            'due_date' => 'nullable|date',
            'status' => 'required|string|in:to_do,in_progress,done',
        ],[
            'title.required' => 'Please provide a title for the task.',
            'title.string' => 'The task title must be a string.',
            'title.max' => 'The task title may not be longer than 255 characters.',
            'description.string' => 'The description must be a string.',
            'assigned_to.string' => 'The assigned_to field must be a string.',
            'assigned_to.max' => 'The assigned_to field may not be longer than 255 characters.',
            'due_date.date' => 'The due date must be a valid date.',
            'status.required' => 'Please select a status for the task.',
            'status.in' => 'The status must be one of the following: to_do, in_progress, done.',
        ]);

        $task = $project->tasks()->create($validated); 

        return response()->json($task, 201); 
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }
        return response()->json($task, 200);
    }


    //List tasks for a specified project
    public function projectTasks($project_id)
    {
        $project = Project::find($project_id);
        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }
        
        $tasks = $project->tasks;
        return response()->json($tasks, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => 'nullable|string|max:255',
            'due_date' => 'nullable|date',
            'status' => 'required|string|in:to_do,in_progress,done',
        ], [
            'title.required' => 'Please provide a title for the task.',
            'title.string' => 'The task title must be a string.',
            'title.max' => 'The task title may not be longer than 255 characters.',
            'description.string' => 'The description must be a string.',
            'assigned_to.string' => 'The assigned_to field must be a string.',
            'assigned_to.max' => 'The assigned_to field may not be longer than 255 characters.',
            'due_date.date' => 'The due date must be a valid date.',
            'status.required' => 'Please select a status for the task.',
            'status.in' => 'The status must be one of the following: to_do, in_progress, done.',
        ]);

        $task->update($validated);

        return response()->json($task, 200);
    }

    /**
     * Delete a task
     */
    public function destroy( $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->delete();

        return response()->json(null, 204);
    }
}
