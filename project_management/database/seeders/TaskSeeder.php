<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\Project;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Create sample tasks for each project
         $project1 = Project::find(1); // Project 1
         $project2 = Project::find(2); // Project 2
         $project3 = Project::find(3); // Project 3
 
         // Create tasks for Project 1
         Task::create([
             'project_id' => $project1->id,
             'title' => 'Task 1 for Project 1',
             'description' => 'Description for Task 1 of Project 1',
             'status' => 'to_do',
         ]);
 
         Task::create([
             'project_id' => $project1->id,
             'title' => 'Task 2 for Project 1',
             'description' => 'Description for Task 2 of Project 1',
             'status' => 'in_progress',
         ]);
 
         // Create tasks for Project 2
         Task::create([
             'project_id' => $project2->id,
             'title' => 'Task 1 for Project 2',
             'description' => 'Description for Task 1 of Project 2',
             'status' => 'to_do',
         ]);
 
         Task::create([
             'project_id' => $project2->id,
             'title' => 'Task 2 for Project 2',
             'description' => 'Description for Task 2 of Project 2',
             'status' => 'in_progress',
         ]);
 
         // Create tasks for Project 3
         Task::create([
             'project_id' => $project3->id,
             'title' => 'Task 1 for Project 3',
             'description' => 'Description for Task 1 of Project 3',
             'status' => 'done',
         ]);

        // Create tasks for Project 3
        Task::create([
            'project_id' => $project3->id,
            'title' => 'Task 2 for Project 3',
            'description' => 'Description for Task 2 of Project 3',
            'status' => 'done',
        ]);
       
        
    }
}
