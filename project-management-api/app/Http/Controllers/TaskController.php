<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Get all tasks for a specific project
    public function index(Project $project)
    {
        return $project->tasks;
    }

    // Store a new task for a specific project
    public function store(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        return $project->tasks()->create($validated);
    }

    // Show a specific task
    public function show(Task $task)
    {
        return $task;
    }

    // Update a task
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $task->update($validated);

        return $task;
    }

    // Delete a task
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->noContent();
    }
}
