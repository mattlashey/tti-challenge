<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition()
    {
        return [
            'title'         => $this->faker->company,
            'description'   => $this->faker->paragraph,
            'status'        => $this->faker->randomElement(['open', 'in_progress', 'completed']),
        ];
    }
}
