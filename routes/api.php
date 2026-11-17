<?php

use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\CompleteTaskController;
use Illuminate\Support\Facades\Route;


Route::apiResource('tasks', TaskController::class);
// Route to handle CRUD operations for tasks
Route::post('/tasks/{task}/complete', CompleteTaskController::class);
// Route to mark a task as complete
