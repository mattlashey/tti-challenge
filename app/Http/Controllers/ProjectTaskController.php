<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectTaskStoreRequest;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProjectTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $project_id)
    {
        try {
            $project = Project::with('tasks')->where('id', $project_id)->firstOrFail();
            return response()->json($project);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success'   => false,
                'message'   => 'Project ID: ' . $project_id . ' not found.'
            ], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectTaskStoreRequest $request)
    {
        $new_task = Task::create($request->validated());
        return response()->json($new_task, 201);
    }
}
