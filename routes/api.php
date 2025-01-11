<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Project;
use \App\Http\Controllers\Task;

// Project routes
Route::group(['prefix' => 'projects'], function () {
    Route::get('/', Project\GetAllController::class);
    Route::post('/', Project\CreateController::class);
    Route::get('/{id}', Project\GetController::class);
    Route::put('/{id}', Project\EditController::class);
    Route::delete('/{id}', Project\DeleteController::class);
    Route::get('/{project_id}/tasks', Task\GetByProjectController::class);
    Route::post('/{project_id}/tasks', Task\CreateController::class);
});

// Task routes
Route::group(['prefix' => 'tasks'], function () {
    Route::get('/', Task\GetAllController::class);
    Route::get('/{id}', Task\GetController::class);
    Route::put('/{id}', Task\EditController::class);
    Route::delete('/{id}', Task\DeleteController::class);
});

