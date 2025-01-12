<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::prefix('projects')->group(function () {
    Route::get('/', [ProjectController::class, 'index']); // List all projects
    Route::post('/', [ProjectController::class, 'store']); // Create a new project
    Route::get('{id}', [ProjectController::class, 'show']); // Show details of a single project
    Route::put('{id}', [ProjectController::class, 'update']); // Update an existing project
    Route::delete('{id}', [ProjectController::class, 'destroy']); // Delete a project

    // Nested group for tasks under projects
    Route::prefix('{project_id}/tasks')->group(function () {
        Route::get('/', [TaskController::class, 'projectTasks']); // List tasks for a specific project
        Route::post('/', [TaskController::class, 'store']); // Create a new task under a project
    });
});

// Group routes with 'tasks' prefix for standalone tasks operations
Route::prefix('tasks')->group(function () {
    Route::get('/', [TaskController::class, 'index']); // List all tasks
    Route::get('{id}', [TaskController::class, 'show']); // Show details of a single task
    Route::put('{id}', [TaskController::class, 'update']); // Update an existing task
    Route::delete('{id}', [TaskController::class, 'destroy']); // Delete a task
});