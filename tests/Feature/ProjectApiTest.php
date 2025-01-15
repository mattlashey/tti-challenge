<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_all_projects()
    {
        $project = Project::factory()->create();  // Create a sample project

        $response = $this->get('/api/projects');

        $response->assertStatus(200)
                 ->assertJsonFragment(['title' => $project->title]);
    }

    /** @test */
public function it_can_create_a_new_project() {
    // Generate CSRF token using Laravel's helper method
    $csrfToken = csrf_token();

    $data = [
        'name' => 'New Project',
        'description' => 'This is a new project.',
        'status' => 'open',
    ];

    // Send the CSRF token along with the request
    $response = $this->withHeaders([
        'X-CSRF-TOKEN' => $csrfToken
    ])->post('/api/projects', $data);

    $response->assertStatus(201)
             ->assertJsonFragment(['title' => 'New Project']);
}


    /** @test */
    public function it_can_show_a_single_project()
    {
        $project = Project::factory()->create();

        $response = $this->get("/api/projects/{$project->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['title' => $project->title]);
    }

    /** @test */
    public function it_can_update_a_project()
    {
        $project = Project::factory()->create();

        $data = [
            'title' => 'Updated Project Title',
            'description' => 'Updated description.',
            'status' => 'in_progress',
        ];

        $response = $this->put("/api/projects/{$project->id}", $data);

        $response->assertStatus(200)
                 ->assertJsonFragment(['title' => 'Updated Project Title']);
    }

    /** @test */
    public function it_can_delete_a_project() {
        $project = Project::factory()->create();

        $response = $this->delete("/api/projects/{$project->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('projects', ['id' => $project->id]);  // Assert the project is deleted
    }
}

