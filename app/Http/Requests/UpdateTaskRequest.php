<?php

namespace App\Http\Requests;

use App\Enums\TaskPriorties;
use App\Enums\TaskStatus;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true; //if true allow all users to make authenticated requests.
    }


    public function rules(): array
    {
        // define the validation rules for updating a task
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'priority' => ['required', Rule::enum(TaskPriorties::class)],
            // 'status' => ['required', Rule::enum(TaskStatus::class)]
        ];
    }
}
