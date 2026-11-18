<?php

namespace Database\Factories;

use App\Models\Task;
use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = fake()->randomElement(TaskStatus::cases());
        return [
            'title'       => fake()->sentence(4),

            'description' => fake()->paragraph(),

            'priority'    => fake()->randomElement(['low', 'medium', 'high']),

            'status'      => $status,
            'due_date' => fake()->dateTimeBetween(now()->addDay(), now()->addWeek()),
            // set completed_at if status is completed
            'completed_at' => $status === TaskStatus::Completed ? fake()->dateTimeBetween(now()->subWeek(), now()) : null,
        ];
    }
}
