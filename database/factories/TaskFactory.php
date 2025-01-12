<?php

namespace Database\Factories;

use App\Models\Project;
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
            'project_id' => Project::factory(), // Automatically creates a related project
            'title' => fake()->sentence(3),
            'description' => fake()->text(80),
            'assigned_to' => fake()->name(),
            'due_date' => fake()->date(),
            'status' => $this->faker->randomElement(['to_do', 'in_progress', 'qa_review','done']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
