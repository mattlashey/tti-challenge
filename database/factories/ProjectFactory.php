<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence, // Random sentence for the title
            'description' => $this->faker->paragraph, // Random paragraph for description
            'status' => $this->faker->randomElement(['open', 'in_progress', 'completed']), // Random status
        ];
    }
}
