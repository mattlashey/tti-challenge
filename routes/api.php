<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

Route::middleware('json.response')->group(function () {
    Route::apiResource('projects', ProjectController::class);
    Route::apiResource('projects.tasks', TaskController::class)->shallow();
});


Route::get('/test', function() {
    return response()->json(['message' => 'API is working!']);
});
