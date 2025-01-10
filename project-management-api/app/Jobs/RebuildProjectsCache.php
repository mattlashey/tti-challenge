<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable; 
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use App\Models\Project;

class RebuildProjectsCache implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Cache the projects with their tasks for 1 hour
        Cache::put('projects', Project::with('tasks')->get(), 3600);
    }
}
