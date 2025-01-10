<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Redis;

// Routes for Projects
Route::apiResource('projects', ProjectController::class);

// Nested Routes for Tasks under Projects
Route::apiResource('projects.tasks', TaskController::class)->shallow();

Route::get('/redis-test', function () {
    Redis::set('test_key', 'Redis is working!');
    return Redis::get('test_key');
});