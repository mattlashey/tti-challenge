<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Task;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        $project = Project::create(['name' => 'Example Project', 'description' => 'A sample project.']);

        $project->tasks()->createMany([
            ['name' => 'Task 1', 'status' => 'pending'],
            ['name' => 'Task 2', 'status' => 'in_progress'],
            ['name' => 'Task 3', 'status' => 'completed'],
        ]);
    }
}
