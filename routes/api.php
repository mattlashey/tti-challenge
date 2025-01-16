<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::prefix('projects')->group(function () {
    Route::get('/', [ProjectController::class, 'index']);
    Route::get('/{id}', [ProjectController::class, 'show']);

    Route::post('/', [ProjectController::class, 'store']);

    Route::put('/{id}', [ProjectController::class, 'update']);

    Route::delete('/{id}', [ProjectController::class, 'destroy']);
    
    Route::get('/{project_id}/tasks', [TaskController::class, 'showByProject']);
    Route::post('/{project_id}/tasks', [TaskController::class, 'store']);
});

Route::prefix('tasks')->group(function () {
    Route::get('/', [TaskController::class, 'index']);
    Route::get('/{id}', [TaskController::class, 'show']);

    Route::put('/{id}', [TaskController::class, 'update']);

    Route::delete('/{id}', [TaskController::class, 'destroy']);

});