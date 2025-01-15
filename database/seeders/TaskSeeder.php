<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\Project;

class TaskSeeder extends Seeder {
    public function run() {
        $project1 = Project::find(1);
        $project1->tasks()->create([
            'title' => 'Task 1 for Project 1',
            'status' => 'to_do',
        ]);

        $project2 = Project::find(2);
        $project2->tasks()->create([
            'title' => 'Task 1 for Project 2',
            'status' => 'in_progress',
        ]);
    }
}
