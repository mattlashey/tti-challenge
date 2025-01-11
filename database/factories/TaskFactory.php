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

    public function definition()
    {
        return [
            'title'         => $this->faker->sentence,
            'description'   => $this->faker->paragraph,
            'assigned_to'   => $this->faker->name,
            'due_date'      => $this->faker->dateTimeBetween('now', '+1 year'),
            'status'        => $this->faker->randomElement(['to_do', 'in_progress', 'done']),
            'project_id'    => Project::factory(),
        ];
    }
}
