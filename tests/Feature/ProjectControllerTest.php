<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class ProjectControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the index method to list all projects.
     *
     * @return void
     */
    public function test_index()
    {
        $project = Project::factory()->create();

        $response = $this->getJson('/api/projects');
        
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'data' => [
                         '*' => ['id', 'title', 'description', 'status'],
                     ]
                 ]);
    }

    /**
     * Test the store method to create a project successfully.
     *
     * @return void
     */
    public function test_store_success()
    {
        $projectData = [
            'title' => 'New Project',
            'description' => 'Project Description',
            'status' => 'open',
        ];

        $response = $this->postJson('/api/projects', $projectData);

        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Project created successfully!',
                 ]);

        $this->assertDatabaseHas('projects', $projectData);
    }

    /**
     * Test store method failure (validation or exception).
     *
     * @return void
     */
    public function test_store_failure()
    {
        // Missing required field 'name'
        $response = $this->postJson('/api/projects', [
            'title' => 'New Project',
            'description' => 'Project without name',
            'status' => 'open1',
        ]);

        $response->assertStatus(422)
                 ->assertJsonStructure([
                     'status',
                     'message',
                 ]);
    }

    /**
     * Test the show method to retrieve a project successfully.
     *
     * @return void
     */
    public function test_show_success()
    {
        $project = Project::factory()->create();

        $response = $this->getJson("/api/projects/{$project->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Project retrieved successfully!',
                 ]);
    }

    /**
     * Test show method failure when project not found.
     *
     * @return void
     */
    public function test_show_failure()
    {
        $response = $this->getJson('/api/projects/999');

        $response->assertStatus(404)
                 ->assertJson([
                     'status' => 'error',
                     'message' => 'Failed to find project!',
                 ]);
    }

    /**
     * Test update method to successfully update a project.
     *
     * @return void
     */
    public function test_update_success()
    {
        $project = Project::factory()->create();
        $updatedData = [
            'title' => 'Updated Project',
            'description' => 'Updated Description',
        ];

        $response = $this->putJson("/api/projects/{$project->id}", $updatedData);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Project updated successfully!',
                 ]);

        $this->assertDatabaseHas('projects', $updatedData);
    }

    /**
     * Test update method failure when project not found.
     *
     * @return void
     */
    public function test_update_failure()
    {
        $response = $this->putJson('/api/projects/999', [
            'title' => 'Non-existent project update',
            'description' => 'Updated Description',
        ]);

        $response->assertStatus(404)
                 ->assertJson([
                     'status' => 'error',
                     'message' => 'Failed to find project.Project not found!',
                 ]);
    }

    /**
     * Test destroy method to successfully delete a project.
     *
     * @return void
     */
    public function test_destroy_success()
    {
        $project = Project::factory()->create();

        $response = $this->deleteJson("/api/projects/{$project->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Project deleted successfully!',
                 ]);

        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }

    /**
     * Test destroy method failure when project not found.
     *
     * @return void
     */
    public function test_destroy_failure()
    {
        $response = $this->deleteJson('/api/projects/999');

        $response->assertStatus(404)
                 ->assertJson([
                     'status' => 'error',
                     'message' => 'Failed to find project.Project not found!',
                 ]);
    }

    /**
     * Test error handling when an unexpected exception occurs during store.
     *
     * @return void
     */
    public function test_store_error_handling()
    {
        // Simulate an exception during project creation
        Log::shouldReceive('error')
            ->once()
            ->with('Failed to create project: Database error', \Mockery::type('array'));

        $response = $this->postJson('/api/projects', [
            'title' => 'Error Project',
            'description' => 'This will cause an error',
            'status' => 'status invalid!',
        ]);

        $response->assertStatus(500)
                 ->assertJson([
                     'status' => 'error',
                     'message' => 'Failed to create project. Please try again later.',
                 ]);
    }
}
