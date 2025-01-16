<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskPostRequest;
use App\Http\Requests\TaskPutRequest;
use App\Http\Resources\Task as TaskResource;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new TaskResource(Task::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskPostRequest $request, int $project_id)
    {
        $project = Project::find($project_id);

        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Project not found',
            ], 404);
        }
        
        $request->merge(['project_id' => $project_id]);
        $task = Task::create($request->all());
        return TaskResource::make($task)->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found',
            ], 404);
        }

        return new TaskResource($task);
    }

    public function showByProject(int $project_id)
    {
        $project = Project::find($project_id);

        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Project not found',
            ], 404);
        }
        
        return TaskResource::collection(Task::where('project_id', $project_id)->get());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskPutRequest $request, int $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found',
            ], 404);
        }

        $project = Project::find($request->project_id);

        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Project not found',
            ], 404);
        }

        $task->update($request->all());

        return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found',
            ], 404);
        }
        Task::destroy($id);
        
        return response()->json([
            'message' => 'Task deleted succesfully'
        ], 204);
    }
}
