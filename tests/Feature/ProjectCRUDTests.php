<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectCRUDTests extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_a_project()
    {
        $response = $this->postJson('/api/projects', [
            'title'       => 'Test Project',
            'description' => 'This is a test project',
            'status'      => 'open',
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'data' => [
                    'title'       => 'Test Project',
                    'description' => 'This is a test project',
                    'status'      => 'open'
                ],
            ]);
    }

    public function test_it_can_update_a_project()
    {
        $project = Project::factory()->create();

        $response = $this->putJson("/api/projects/{$project->id}", [
            'title'       => 'Updated Project',
            'description' => 'Updated description',
            'status'      => 'in_progress'
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'title'       => 'Updated Project',
                    'description' => 'Updated description',
                    'status'      => 'in_progress',
                ],
            ]);
    }

    public function test_it_can_delete_a_project()
    {
        $project = Project::factory()->create();

        $response = $this->deleteJson("/api/projects/{$project->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }
}
