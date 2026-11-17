<?php

use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\CompleteTaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('tasks', TaskController::class);
Route::post('/tasks/{task}/complete', CompleteTaskController::class);
