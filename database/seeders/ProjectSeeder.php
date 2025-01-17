<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $titles = [
            'NVIDIA RTX 50 Series Sale Alert App',
            'Article Post: About Charge Blade in Monster Hunter',
            'Night of the Grizzlies Live-Action Movie Adaptation'
        ];
        $descriptions = [
            'Build an app that can alert an end-user once NVIDIA RTX 50 series goes on sale.',
            'Explain why the charge blade weapon in Monster Hunter: World is the most fun and complex weapon.',
            'A project on making the book by Jack Olsen a full-featured film.'
        ];
        $statuses = ['open', 'in_progress', 'completed'];

        for ($i = 0; $i <= 2; $i++) {
            DB::table('projects')->insert([
                'title' => $titles[$i],
                'description' => $descriptions[$i],
                'status' => $statuses[array_rand($statuses)],
            ]);
        }
    }
}
