<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_projects()
    {
        Project::factory()->count(3)->create();

        $response = $this->getJson('/api/projects');

        $response->assertStatus(200)
                ->assertJsonCount(3);
    }
    /** @test */
    public function it_can_create_a_project()
    {
        $data = [
            'title' => 'Test Project',
            'description' => 'Test Description',
            'status' => 'open',
        ];

        $response = $this->postJson('/api/projects', $data);

        $response->assertStatus(201)
                ->assertJsonFragment($data);
    }

    /** @test */
    public function it_can_update_a_project()
    {
        $project = Project::factory()->create();

        $data = [
            'title' => 'Updated Title',
            'description' => 'Updated Description',
            'status' => 'in_progress',
        ];

        $response = $this->putJson("/api/projects/{$project->id}", $data);

        $response->assertStatus(200)
                ->assertJsonFragment($data);

        $this->assertDatabaseHas('projects', $data);
    }

    /** @test */
    public function it_can_delete_a_project()
    {
        $project = Project::factory()->create();

        $response = $this->deleteJson("/api/projects/{$project->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }
}
