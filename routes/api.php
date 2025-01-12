<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

Route::prefix('projects')->group(function () {
    Route::get('/', [ProjectController::class, 'index'])->name('projects.index'); //  List all projects.
    Route::post('/', [ProjectController::class, 'store'])->name('projects.store'); // Create a new project
    Route::get('/{id}', [ProjectController::class, 'show'])->name('projects.show'); // Show details of a single project
    Route::put('/{id}', [ProjectController::class, 'update'])->name('projects.update'); // Update a existing project
    Route::delete('/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy'); // Delete a project
});

Route::prefix('tasks')->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('tasks.index'); // List all tasks
    Route::get('/{id}', [TaskController::class, 'show'])->name('tasks.show'); // Show details of a single task
    Route::put('/{id}', [TaskController::class, 'update'])->name('tasks.update'); // Update an existing task
    Route::delete('/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy'); // Delete a task.
});

Route::prefix('projects/{project_id}/tasks')->group(function() {
    Route::get('/', [TaskController::class, 'listByProject'])->name('tasks.listByProject'); // List all tasks for a specific project.
    Route::post('/', [TaskController::class, 'store'])->name('tasks.store'); //  Create a new task under a project
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
