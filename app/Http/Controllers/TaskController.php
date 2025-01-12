<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Project;
use App\Models\Task;

class TaskController extends Controller
{
    //List all tasks : /api/tasks
    public function index()
    {
        try {
            $tasks = TaskResource::collection(Task::all());
            return response()->json($tasks);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    //List all tasks : /api/projects/{project_id}/tasks
    public function listByProject($projectId)
    {
        try {
            $project = Project::findOrFail($projectId);
            return response()->json(TaskResource::collection($project->tasks));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Project not found.',
            ], 404);
        } catch (\Exception $e) {

            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    //Create a new task under a project : /api/projects/{project_id}/tasks
    public function store(TaskRequest $request, $projectId)
    {

        try {
            Project::findOrFail($projectId);
            $task = Task::create($request->validated() + ['project_id' => $projectId]);
            return response()->json(new TaskResource($task), 201);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Project not found.',
            ], 404);
        } catch (\Exception $e) {

            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // Show details of a single task : /api/tasks/{id}
    public function show($id)
    {
        try {
            $task = Task::findOrFail($id);

            return response()->json([
                'task' => new TaskResource($task),
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Task not found.',
            ], 404);
        } catch (\Exception $e) {

            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    //Update an existing task : /api/tasks/{id}
    public function update(TaskRequest $request, $id)
    {
        try {
            $task = Task::findOrFail($id);

            if ($request->has('project_id')) {
                $project = Project::find($request->project_id);
                if (!$project) {
                    return response()->json([
                        'message' => 'Project not found.',
                    ], 404);
                }
            }

            $task->update($request->validated());

            return response()->json([
                'message' => 'Task updated successfully.',
                'task' => new TaskResource($task),
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Task not found.',
            ], 404);
        } catch (\Exception $e) {

            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // Delete a task :  /api/tasks/{id}
    public function destroy($id)
    {
        try {
            $task = Task::findOrFail($id);
            $task->delete();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Task not found.',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }

        return response()->json([
            'message' => 'Task deleted successfully.'
        ]);
    }
}
