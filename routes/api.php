<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('/')->group(function () {
    Route::get('projects/{id}/tasks', [ProjectController::class, 'tasks']);
    Route::apiResource('projects', ProjectController::class);

    Route::apiResource('tasks', TaskController::class);
});
