<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Loop through each project and create 3 tasks
        Project::all()->each(function ($project) {
            Task::factory()
                ->count(3) // create 3 tasks
                ->create(['project_id' => $project->id]);
        });
    }
}
