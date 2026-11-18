<?php

use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\CompleteTaskController;
use Illuminate\Support\Facades\Route;

// Route to handle CRUD operations for tasks
Route::apiResource('tasks', TaskController::class);
// Route to mark a task as complete
Route::post('/tasks/{task}/complete', CompleteTaskController::class);
