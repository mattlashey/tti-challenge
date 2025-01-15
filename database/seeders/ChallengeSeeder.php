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
        $p_limit = env('PROJECTS', 3);
        $t_limit_min = env('TASKS_MIN', 2);
        $t_limit_max = env('TASKS_MAX', 3);

        $projects = Project::factory()->count($p_limit)->create();
        $projects->each(function (Project $project) use ($t_limit_min, $t_limit_max) {
            Task::factory()->count(random_int($t_limit_min, $t_limit_max))->create([
                'project_id' => $project->id,
            ]);
        });
    }
}
