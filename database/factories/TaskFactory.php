<?php

namespace Database\Factories;

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
    public function definition(): array
    {
        return [
            'project_id' => \App\Models\Project::factory(), // Assuming a task is linked to a project
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'assigned_to' => $this->faker->name(),
            'due_date' => $this->faker->date(),
            'status' => $this->faker->randomElement(['to_do', 'in_progress', 'done']),
        ];
    }
}
