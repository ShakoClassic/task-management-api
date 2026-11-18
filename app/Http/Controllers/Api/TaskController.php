<?php

namespace App\Http\Controllers\Api;

use App\Enums\TaskStatus;
use App\Enums\TaskPriorties;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{

    //show all tasks
    public function index(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'status' => ['nullable', 'string', Rule::enum(TaskStatus::class)],
            'priority' => ['nullable', 'string', Rule::enum(TaskPriorties::class)],
        ]);
        // Start a query on the Task model
        $tasks = Task::query()
            // Conditionally apply a filter based on the request parameters
            ->when(
                $request->filled('status'),
                function ($query) use ($request) {
                    $query->where('status', $request->status);
                }
            )->when(
                $request->filled('priority'),
                function ($query) use ($request) {
                    $query->where('priority', $request->priority);
                }
            )->latest()->get();


        return response()->json([
            'tasks' => TaskResource::collection($tasks),
        ]);
    }

    //save a new task
    public function store(StoreTaskRequest $request)
    {
        // Create a new task using the validated data from the request
        $newTask  = Task::create($request->validated());

        return response()->json([
            'message' => 'task created.',
            "data" => TaskResource::make($newTask),
        ]);
    }

    //show one task
    public function show(Task $task)
    {

        return response()->json([
            'task' => TaskResource::make($task),
        ]);
    }

    //update a task
    public function update(UpdateTaskRequest $request, Task $task)
    {
        // Update the task with the validated data from the request
        $task->update($request->validated());

        return response()->json([
            'message' => 'task updated.',
            "data" => TaskResource::make($task),
        ]);
    }

    //delete a task
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json([
            'message' => 'task deleted.'
        ]);
    }
}
