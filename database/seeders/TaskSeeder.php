<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = ['to_do', 'in_progress', 'done'];

        $alert_app_project = DB::table('projects')->where('title', 'like', '%Alert App%')->first();
        $alert_app_titles = [
            'Gather App Requirements',
            'Build the Alert App',
            'Test and Deploy the App'
        ];
        $alert_app_desc = [
            'List down requirements.',
            'Code, design, code, more code...',
            'Release the app and test it. Duh!'
        ];
        $alert_app_due = [
            '01/16/2025',
            '01/28/2025',
            '01/29/2025'
        ];
        for ($i = 0; $i <= 2; $i++) {
            DB::table('tasks')->insert([
                'project_id' => $alert_app_project->id,
                'title' => $alert_app_titles[$i],
                'description' => $alert_app_desc[$i],
                'due_date' => Carbon::parse($alert_app_due[$i]),
                'status' => $statuses[array_rand($statuses)],
            ]);
        }

        $article_post_project = DB::table('projects')->where('title', 'like', '%Article Post%')->first();
        $article_post_titles = [
            'Play more Monster Hunter: World in the PS5.',
            'Write the article.'
        ];
        $article_post_desc = [
            'Make sure to use Charge Blade when playing',
            ''
        ];
        $article_post_due = [
            '01/30/2025',
            '02/14/2025'
        ];
        for ($i = 0; $i <= 1; $i++) {
            DB::table('tasks')->insert([
                'project_id' => $article_post_project->id,
                'title' => $article_post_titles[$i],
                'description' => $article_post_desc[$i],
                'due_date' => Carbon::parse($article_post_due[$i]),
                'status' => $statuses[array_rand($statuses)],
            ]);
        }

        $movie_project = DB::table('projects')->where('title', 'like', '%Movie Adaptation%')->first();
        $movie_project_titles = [
            'Cast the Actors',
            'Film the Movie',
            'Show the Movie'
        ];
        $movie_project_desc = [
            'Start casting...',
            'Cut, cut, and more CUT!',
            'Profit???'
        ];
        $movie_project_due = [
            '03/20/2025',
            '06/13/2025',
            '01/04/2026'
        ];
        for ($i = 0; $i <= 2; $i++) {
            DB::table('tasks')->insert([
                'project_id' => $movie_project->id,
                'title' => $movie_project_titles[$i],
                'description' => $movie_project_desc[$i],
                'due_date' => Carbon::parse($movie_project_due[$i]),
                'status' => $statuses[array_rand($statuses)],
            ]);
        }
    }
}
