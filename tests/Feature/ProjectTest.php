<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_new_project(): void
    {
        $project_data = [
            'title' => 'New Project',
            'description' => 'Description for new project',
            'status' => 'open'
        ];
        
        $response = $this->post('/api/projects', $project_data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('projects', $project_data);
    }
    
    public function test_can_update_project(): void
    {
        $project = Project::factory()->create();

        $new_project_data = [
            'title' => 'Changed Title',
            'description' => 'New description',
            'status' => 'completed'
        ];
        $response = $this->put("/api/projects/{$project->id}", $new_project_data);
        $response->assertStatus(200);
        $this->assertDatabaseHas('projects', $new_project_data);
    }
    
    public function test_can_delete_project(): void
    {
        $project = Project::factory()->create();

        $response = $this->delete("/api/projects/{$project->id}");
        $response->assertStatus(204);
        $this->assertModelMissing($project);
    }
}
