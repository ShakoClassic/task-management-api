<?php

namespace Database\Seeders;

use App\Models\Task; // add import factory
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

      Task::factory()->count(10)->create(); // generate 10 tasks using factory
    }
}
