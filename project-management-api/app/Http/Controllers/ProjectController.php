<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Jobs\RebuildProjectsCache;

class ProjectController extends Controller
{
    // Get all projects with caching
    public function index()
    {
        // Cache projects for 1 hour (3600 seconds)
        return Cache::remember('projects', 3600, function () {
            return Project::with('tasks')->get();
        });
    }

    // Store a new project and its tasks using transactions
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'tasks' => 'nullable|array',
            'tasks.*.name' => 'required|string|max:255',
            'tasks.*.status' => 'required|in:pending,in_progress,completed',
        ]);
    
        DB::beginTransaction();
    
        try {
            // Create the project
            $project = Project::create([
                'name' => $validated['name'],
                'description' => $validated['description'],
            ]);
    
            // Create tasks if provided
            if (!empty($validated['tasks'])) {
                foreach ($validated['tasks'] as $task) {
                    $project->tasks()->create($task);
                }
            }
    
            DB::commit(); // Commit the transaction
    
            // Dispatch cache rebuilding job
            RebuildProjectsCache::dispatch();
    
            return $project->load('tasks');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaction on failure
            return response()->json(['error' => 'Project creation failed'], 500);
        }
    }

    // Show a specific project
    public function show(Project $project)
    {
        return $project->load('tasks');
    }

    // Update a project and clear cache
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project->update($validated);

        // Clear the projects cache
        Cache::forget('projects');

        return $project;
    }

    // Delete a project and its tasks
    public function destroy(Project $project)
    {
        $project->delete();

        // Clear the projects cache
        Cache::forget('projects');

        return response()->noContent();
    }
}
