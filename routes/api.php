<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectTaskController;
use App\Http\Controllers\TaskController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResources([
    'projects' => ProjectController::class
]);

Route::resource('tasks', TaskController::class)->only(['index', 'show', 'update', 'destroy']);

Route::resource('projects/{project_id}/tasks', ProjectTaskController::class)->only(['index', 'store']);