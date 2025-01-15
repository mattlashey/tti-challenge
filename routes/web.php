<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('api')->group(function () {
	// Projects routes
	Route::get('/csrfToken', [TokenController::class, 'csrfToken']);
	Route::get('/projects', [ProjectController::class, 'index']);
	Route::post('/projects', [ProjectController::class, 'store']);
	Route::get('/projects/{id}', [ProjectController::class, 'show']);
	Route::put('/projects/{id}', [ProjectController::class, 'update']);
	Route::delete('/projects/{id}', [ProjectController::class, 'destroy']);

	// Tasks routes
	Route::get('/tasks', [TaskController::class, 'index']); // Optional
	Route::get('/projects/{project_id}/tasks', [TaskController::class, 'index']); // List tasks for a specific project
	Route::post('/projects/{project_id}/tasks', [TaskController::class, 'store']);
	Route::get('/tasks/{id}', [TaskController::class, 'show']);
	Route::put('/tasks/{id}', [TaskController::class, 'update']);
	Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);
});