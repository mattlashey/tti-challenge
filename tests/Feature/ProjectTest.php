<?php

namespace Tests\Feature;

use App\Models\Project;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Mockery\MockInterface;

class ProjectTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_return_a_list_of_projects_successfully(): void
    {

        //Arrange
        $projects = Project::factory()->count(3)->create();

        //Action
        $response = $this->getJson(route('projects.index'));

        //Assertion
        $response->assertStatus(200)
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'title',
                    'description',
                    'status'
                ]
            ]);
    }

    public function test_create_a_project_successfully()
    {
        //Arrange
        $data = $this->projectData();

        //Action
        $response = $this->postJson(route('projects.store'), $data);

        //Assert
        // $this->assertProjectStoreJson($response, $data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('projects', $data);
    }

    public function test_return_422_validattion_error_when_creating_a_project()
    {
        //Arrange
        $data = [
            'title' => '',
            'description' => "testing description",
            'status' => 'open',
        ];

        // Action
        $response = $this->postJson(route('projects.store'), $data);

        //Assert
        $response->assertStatus(422);
    }

    public function test_get_a_project_successfully()
    {
        //Arrange
        $project = Project::factory()->create();
        //Action
        $response = $this->getJson(route('projects.show', $project->id));
        //Assert
        $response->assertStatus(200)
            ->assertJson([
                'project' => [
                    'id' => $project->id,
                    'title' => $project->title,
                    'description' => $project->description,
                    'status' => $project->status,
                ],
            ]);
    }

    public function test_return_404_project_not_found_when_getting_a_project()
    {
        //Action
        $response = $this->getJson(route('projects.show', 0));
        //Assert
        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Project not found.',
            ]);
    }

    public function test_update_a_project_successfully()
    {
        // Arrange
        $project = Project::factory()->create();

        $updatedData = $this->projectData();
        // Action
        $response = $this->putJson(route('projects.update', $project->id), $updatedData);

        //Assert
        $response->assertStatus(200);
        $this->assertDatabaseHas('projects', $updatedData);
    }

    public function test_return_422_validattion_error_when_updating_a_project()
    {
        // Arrange
        $project = Project::factory()->create();

        $data = [
            'title' => '',
            'description' => "testing description",
            'status' => 'open',
        ];

        // Action
        $response = $this->putJson(route('projects.update', $project->id), $data);

        //Assert
        $response->assertStatus(422);
    }

    public function test_return_404_project_not_found_when_updating_a_project()
    {
        $data = [
            'title' => 'A testing project',
            'description' => "testing description",
            'status' => 'open',
        ];
        //Action
        $response = $this->putJson(route('projects.update', 0), $data);
        //Assert
        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Project not found.',
            ]);
    }

    public function test_delete_a_project_successfully()
    {
        //Arrage
        $project = Project::factory()->create();

        //Action
        $response = $this->deleteJson(route('projects.destroy', $project->id));

        //Assertion
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Project deleted successfully.',
            ]);
    }

    public function test_return_404_project_not_found_when_deleting_a_project()
    {
        //Action
        $response = $this->getJson(route('projects.destroy', 0));
        //Assert
        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Project not found.',
            ]);
    }

    protected function projectData()
    {
        return [
            'title' => 'Personal Web',
            'description' => 'This is a personal web project.',
            'status' => 'open',
        ];
    }
}
