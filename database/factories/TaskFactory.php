<?php

namespace Database\Factories;

use App\Enums\TaskStatusEnum;
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
            'project_id' => $this->faker->randomElement(Project::pluck('id')),
            'title' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'assigned_to' => $this->faker->word,
            'due_date' => $this->faker->date,
            'status' => $this->faker->randomElement(TaskStatusEnum::cases()),
        ];
    }
}
