<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use Database\Factories\ProjectFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChallengeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = Project::factory()->count(3)->create();
        $projects->each(function (Project $project) {
            Task::factory()->count(random_int(2, 3))->create([
                'project_id' => $project->id,
            ]);
        });
    }
}
