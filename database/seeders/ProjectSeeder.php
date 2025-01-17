<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Task;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        Project::factory(10)
            ->create()
            ->each(function ($project) {
                Task::factory(rand(2, 3))->create([
                    'project_id' => $project->id
                ]);
            });
    }
}
