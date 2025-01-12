<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample projects
        Project::create([
            'title' => 'Project 1',
            'description' => 'Description for Project 1',
            'status' => 'open',
        ]);

        Project::create([
            'title' => 'Project 2',
            'description' => 'Description for Project 2',
            'status' => 'in_progress',
        ]);

        Project::create([
            'title' => 'Project 3',
            'description' => 'Description for Project 3',
            'status' => 'completed',
        ]);
    }
}
