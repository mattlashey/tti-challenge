<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Project;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    // Add project test
    public function test_it_can_create_a_project()
    {
        $data = [
            'title' => 'Test Project',
            'description' => 'Some description',
            'status' => 'open'
        ];

        $response = $this->postJson('/api/projects', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment([
                     'title' => 'Test Project',
                     'description' => 'Some description',
                     'status' => 'open'
                 ]);

        $this->assertDatabaseHas('projects', [
            'title' => 'Test Project'
        ]);
    }

    // List projects test
    public function test_it_can_list_projects()
    {
        Project::factory()->count(3)->create();

        $response = $this->getJson('/api/projects');

        $response->assertStatus(200)
                 ->assertJsonCount(3)
                 ->assertJsonStructure([
                     '*' => ['id', 'title', 'description', 'status', 'created_at', 'updated_at']
                 ]);
    }

    // Show project test
    public function test_it_can_show_a_single_project()
    {
        $project = Project::factory()->create([
            'title' => 'Single Project',
            'description' => 'A single test project',
            'status' => 'open'
        ]);

        $response = $this->getJson("/api/projects/{$project->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'title' => 'Single Project',
                     'description' => 'A single test project',
                     'status' => 'open'
                 ]);
    }

    // Update project test
    public function test_it_can_update_a_project()
    {
        $project = Project::factory()->create([
            'title' => 'Old Title',
            'status' => 'open'
        ]);

        $response = $this->putJson("/api/projects/{$project->id}", [
            'title' => 'Updated Title',
            'status' => 'in_progress'
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'title' => 'Updated Title',
                     'status' => 'in_progress'
                 ]);

        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'title' => 'Updated Title',
            'status' => 'in_progress'
        ]);
    }

    // Delete project test
    public function test_it_can_delete_a_project()
    {
        $project = Project::factory()->create();

        $response = $this->deleteJson("/api/projects/{$project->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Project deleted successfully'
                 ]);

        $this->assertDatabaseMissing('projects', [
            'id' => $project->id
        ]);
    }
}
