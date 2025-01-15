<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence, // Random title for the task
            'status' => $this->faker->randomElement(['to_do', 'in_progress', 'done']), // Random status
            'project_id' => Project::factory(), // Linking to a Project using Project factory
        ];
    }
}
