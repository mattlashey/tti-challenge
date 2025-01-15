<?php

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

// Project routes
Route::apiResource('projects', ProjectController::class);

// Task routes
Route::get('/tasks', [TaskController::class, 'index']); // Route to list all tasks globally
Route::get('projects/{project}/tasks', [TaskController::class, 'tasksByProject']); // List all tasks under a project
Route::post('projects/{project}/tasks', [TaskController::class, 'store']); // Create a task under a project
Route::apiResource('tasks', TaskController::class)->except(['index', 'store']); // Other task operations
