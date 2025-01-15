<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Task::paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'assigned_to' => ['nullable', 'string'],
            'project_id' => ['required', 'integer'],
            'due_date' => ['required', 'date', 'after_or_equal:today'],
            'status' => ['required', Rule::in([Task::STATUS_TO_DO, Task::STATUS_IN_PROGRESS, Task::STATUS_DONE])],
        ]);

        return response()->json(Task::create($data), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::where('id', $id)->first();
        if (empty($task)) {
            return response()->json($this->error("No Task with ID {$id} found!"), 404);
        }
        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Task::where('id', $id)->first();
        if (empty($task)) {
            return response()->json($this->error("No Task with ID {$id} found!"), 404);
        }

        $data = $request->validate([
            'title' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'assigned_to' => ['nullable', 'string'],
            'project_id' => ['nullable', 'integer'],
            'due_date' => ['nullable', 'date'],
            'status' => ['nullable', Rule::in([Task::STATUS_TO_DO, Task::STATUS_IN_PROGRESS, Task::STATUS_DONE])],
        ]);
        $task->update($data);
        return response()->json($task, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::where('id', $id)->first();
        if (empty($task)) {
            return response()->json($this->error("No Task with ID {$id} found!"), 404);
        }
        $task->delete();
        return response()->json(array(
            'success' => true,
            'id' => $task->id,
        ));
    }

}
