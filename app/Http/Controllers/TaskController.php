<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    // Endpoint to List all tasks.
    // GET /api/tasks
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks, Response::HTTP_OK);
    }

    // Endpoint to List all tasks for a specific project.
    // GET /api/projects/{project_id}/tasks
    public function tasksByProject($projectId)
    {
        $project = Project::find($projectId);
        if (!$project) {
            return response()->json(['message' => 'Project not found'], Response::HTTP_NOT_FOUND);
        }

        $tasks = $project->tasks; // Using the relationship
        return response()->json($tasks, Response::HTTP_OK);
    }

    // Endpoint to Create a new task under a project.
    // POST /api/projects/{project_id}/tasks
    public function store(StoreTaskRequest $request, $projectId)
    {
        $project = Project::find($projectId);
        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        $validatedData = $request->validated();
        $validatedData['project_id'] = $projectId;

        $task = Task::create($validatedData);
        return response()->json($task, 201);
    }

    // Endpoint to Show details of a single task.
    // GET /api/tasks/{id}
    public function show($id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], Response::HTTP_NOT_FOUND);
        }
        return response()->json($task, Response::HTTP_OK);
    }

    // Endpoint to Update an existing task.
    // PUT /api/tasks/{id}
    public function update(UpdateTaskRequest $request, $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->update($request->validated());
        return response()->json($task, 200);
    }

    // Endpoint to Delete a task.
    // DELETE /api/tasks/{id}
    public function destroy($id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], Response::HTTP_NOT_FOUND);
        }

        $task->delete();
        return response()->json(['message' => 'Task deleted successfully'], Response::HTTP_OK);
    }
}
