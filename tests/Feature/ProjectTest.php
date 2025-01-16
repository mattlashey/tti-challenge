<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Project;

class ProjectTest extends TestCase
{

    use RefreshDatabase;

    public  function list_all_projects_test()
    {
        // Arrange: Create sample projects
        Project::factory()->count(3)->create();

        // Act: Make a GET request to the projects endpoint
        $response = $this->getJson('/api/projects');

        // Assert: Check the response status and structure
        $response->assertStatus(200)
            ->assertJsonCount(3, 'data') // Ensures 3 projects are returned
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'title', 'description', 'status', 'created_at', 'updated_at']
                ]
            ]);
    }


    public function create_a_project_test()
    {
        // Arrange: Define project data
        $data = [
            'title' => 'Test Project',
            'description' => 'A description for the Test project',
            'status' => 'open',
        ];

        // Act: Make a POST request to create a project
        $response = $this->postJson('/api/projects', $data);

        // Assert: Check response and database
        $response->assertStatus(201)
            ->assertJsonFragment(['title' => 'Test Project']);
        $this->assertDatabaseHas('projects', $data);
    }


    public function show_a_project_test()
    {
        // Arrange: Create a project
        $project = Project::factory()->create();

        // Act: Make a GET request to retrieve the project
        $response = $this->getJson("/api/projects/{$project->id}");

        // Assert: Check response structure and content
        $response->assertStatus(200)
            ->assertJsonFragment(['title' => $project->title]);
    }


    public function update_a_project_test()
    {
        // Arrange: Create a project
        $project = Project::factory()->create();

        // Act: Make a PUT request to update the project
        $updatedData = ['title' => 'Updated test project', 'status' => 'in_progress'];
        $response = $this->putJson("/api/projects/{$project->id}", $updatedData);

        // Assert: Check response and database
        $response->assertStatus(200)
            ->assertJsonFragment(['title' => 'Updated test project']);
        $this->assertDatabaseHas('projects', $updatedData);
    }


    public function it_can_delete_a_project()
    {
        // Arrange: Create a project
        $project = Project::factory()->create();

        // Act: Make a DELETE request to remove the project
        $response = $this->deleteJson("/api/projects/{$project->id}");

        // Assert: Check response and database
        $response->assertStatus(200);
        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }
}
