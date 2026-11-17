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
    public function __invoke(Task $task) // This method is invoked when the controller is called as a single-action controller
    {
        // Check if the task is already completed

        if ($task->isComplete()) {
            throw ValidationException::withMessages([
                'task' => 'the task is already completed',
            ]);
        }
        // Update the task status to completed and set the completed_at timestamp
        $task->update([
            'status' => TaskStatus::Completed,
            'completed_at' => now(),
        ]);
        // Return a JSON response indicating the task has been completed
        return response()->json([
            'message' => 'task completed.',
            "data" => TaskResource::make($task),
        ]);
    }
}
