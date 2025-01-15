<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_id' => $this->faker->randomElement(Project::all()),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->sentences(3, true),
            'assigned_to' => $this->faker->name(),
            'due_date' => $this->faker->optional(.9)->dateTimeBetween('now', '+100 years'),
            'status' => $this->faker->randomElement([
                Task::STATUS_TO_DO, Task::STATUS_IN_PROGRESS, Task::STATUS_DONE]),
        ];
    }
}
