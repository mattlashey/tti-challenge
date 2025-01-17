<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskUpdateRequest;
use App\Models\Task;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $task = Task::where('id', $id)->firstOrFail();
            return response()->json($task);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success'   => false,
                'message'   => 'Task ID: ' . $id . ' not found.'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskUpdateRequest $request, string $id)
    {
        try {
            $task = Task::findOrFail($id);
            $task->update($request->validated());
            return response()->json($task);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success'   => false,
                'message'   => 'Project ID: ' . $id . ' not found.'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $task = Task::where('id', $id)->firstOrFail();
            $task->delete();
            return response()->json([
                'success'   => true,
                'message'   => 'Task ID: ' . $id . ' deleted.'
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success'   => false,
                'message'   => 'Task ID: ' . $id . ' not found.'
            ], 404);
        }
    }
}
