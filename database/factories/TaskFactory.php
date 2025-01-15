<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'project_id' => \App\Models\Project::factory(),
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'assigned_to' => $this->faker->name,
            'due_date' => $this->faker->date,
            'status' => $this->faker->randomElement(['to_do', 'in_progress', 'done']),
        ];
    }
}
