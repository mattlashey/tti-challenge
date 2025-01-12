<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Testing\File;
use Tests\TestCase;
use App\Models\Project;

class ProjectApiTest extends TestCase
{
    use RefreshDatabase;

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_create_a_project()
    {
        $response = $this->postJson('/api/projects', [
            'title' => 'New Project',
            'description' => 'Project description',
            'status' => 'open',
        ]);

        $response->assertStatus(201)  // Assert 201 Created
                 ->assertJsonStructure([
                     'id',
                     'title',
                     'description',
                     'status',
                     'created_at',
                     'updated_at',
                 ]);
    }

   
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_fetch_all_projects()
    {
        $projects = Project::factory()->count(3)->create();

        $response = $this->getJson('/api/projects');

        $response->assertStatus(200)  // Assert 200 OK
                 ->assertJsonCount(3);  // Assert 3 projects are returned
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_fetch_a_single_project()
    {
        $project = Project::factory()->create();

        $response = $this->getJson("/api/projects/{$project->id}");

        $response->assertStatus(200)  // Assert 200 OK
                 ->assertJson([
                     'id' => $project->id,
                     'title' => $project->title,
                 ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_returns_404_when_project_not_found()
    {
        $response = $this->getJson('/api/projects/999');

        $response->assertStatus(404)  // Assert 404 Not Found
                 ->assertJson([
                     'message' => 'Project not found',
                 ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_update_a_project()
    {
        $project = Project::factory()->create();

        $response = $this->putJson("/api/projects/{$project->id}", [
            'title' => 'Updated Project',
            'description' => 'Updated description',
            'status' => 'completed',
        ]);

        $response->assertStatus(200)  // Assert 200 OK
                 ->assertJson([
                     'title' => 'Updated Project',
                     'status' => 'completed',
                 ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_delete_a_project()
    {
        $project = Project::factory()->create();

        $response = $this->deleteJson("/api/projects/{$project->id}");

        $response->assertStatus(204);  // Assert 204 No Content
    }
}
