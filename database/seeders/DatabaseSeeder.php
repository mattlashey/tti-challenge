<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Task;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $projects = [
            [
                'title' => 'Website Redesign',
                'description' => 'Revamp the company website with modern design',
                'status' => 'in_progress'
            ],
            [
                'title' => 'Mobile App Development',
                'description' => 'Create a new mobile app for customers',
                'status' => 'open'
            ],
            [
                'title' => 'Database Migration',
                'description' => 'Migrate legacy database to new system',
                'status' => 'completed'
            ]
        ];

        foreach ($projects as $projectData) {
            $project = Project::create($projectData);

            for ($i = 1; $i <= rand(2, 3); $i++) {
                Task::create([
                    'project_id' => $project->id,
                    'title' => "Task {$i} for {$project->title}",
                    'description' => "Description for task {$i}",
                    'assigned_to' => "User {$i}",
                    'due_date' => now()->addDays($i * 7),
                    'status' => ['to_do', 'in_progress', 'done'][rand(0, 2)]
                ]);
            }
        }
    }
}
