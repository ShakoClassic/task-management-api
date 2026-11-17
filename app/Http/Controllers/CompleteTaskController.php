<?php

namespace App\Http\Controllers;

use App\Enums\TaskStatus;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CompleteTaskController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Task $task)
    {

        if ($task->isComplete()) {
            throw ValidationException::withMessages([
                'task' => 'the task is already completed',
            ]);
        }

        $task->update([
            'status' => TaskStatus::Completed
        ]);

        return response()->json([
            'message' => 'task completed.',
            "data" => TaskResource::make($task),
        ]);
    }
}
