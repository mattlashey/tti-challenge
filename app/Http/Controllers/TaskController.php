<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function index()
    {
        return response()->json(['status' => 'success','data' => Task::get()], 200);
    }

    public function indexByProject($projectId)
    {
        $data = Task::where('project_id', $projectId)->get();
        return response()->json(['status' => 'success','data' => $data], 200);
    }

    public function store(StoreTaskRequest $request, $projectId)
    {
        try {
            $task = Task::create(array_merge($request->validated(), ['project_id' => $projectId]));
            return response()->json([
                'status' => 'success',
                'message' => 'Task created successfully!',
                'task' => $task,
            ], 201);
        }catch (\Exception $e) {
            // Log the exception with line number
            Log::error('Failed to create task: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create task. Please try again later.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            // Attempt to find the task and load related tasks
            $task = Task::findOrFail($id);
    
            // Return the task as JSON
            return response()->json([
                'status' => 'success',
                'message' => 'Task retrieved successfully!',
                'data' => $task,
            ], 200);
    
        }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Log not found exception with details
            Log::warning('Task not found', [
                'id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
    
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to find task!',
            ], 404);
    
        }catch(\Exception $e) {
            // Log unexpected exceptions with details
            Log::error('An error occurred while retrieving the task: ' . $e->getMessage(), [
                'id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
    
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to show task. Please try again later.',
            ], 500);
        }
    }

    public function update(UpdateTaskRequest $request, $id)
    {
        try {
            // Attempt to find the task
            $task = Task::findOrFail($id);
    
            // Update the task with validated data
            $task->update($request->validated());
    
            // Return the updated task
            return response()->json([
                'status' => 'success',
                'message' => 'Task updated successfully!',
                'data' => $task,
            ], 200);
    
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Log the exception if the task is not found
            Log::warning('Task not found for update', [
                'id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
    
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to find task.Task not found!',
            ], 404);
    
        } catch (\Exception $e) {
            // Log unexpected exceptions with details
            Log::error('An error occurred while updating the task: ' . $e->getMessage(), [
                'id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
    
            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred. Please try again later.',
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            // Attempt to find the task
            $task = Task::findOrFail($id);
    
            // Update the task with validated data
            $task->delete();
    
            // Return the updated task
            return response()->json([
                'status' => 'success',
                'message' => 'Task deleted successfully!',
            ], 200);
    
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Log the exception if the task is not found
            Log::warning('Task not found for delete', [
                'id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
    
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to find task.Task not found!',
            ], 404);
    
        } catch (\Exception $e) {
            // Log unexpected exceptions with details
            Log::error('An error occurred while deleting the task: ' . $e->getMessage(), [
                'id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
    
            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred. Please try again later.',
            ], 500);
        }
    }
}
