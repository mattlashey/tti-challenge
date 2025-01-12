<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_return_a_list_of_tasks_successfully(): void
    {
        //Arrange
        $tasks = Task::factory()->count(3)->create();

        //Action
        $response = $this->getJson(route('tasks.index'));

        //Assertion
        $this->assertAllTasksJsonStructure($response);
    }

    public function test_get_all_tasks_by_a_project_successfully()
    {
        // Arrange
        $project = Project::factory()->create();
        Task::factory()->count(3)->create(['project_id' => $project->id]);

        //Action
        $response = $this->getJson(route('tasks.listByProject', $project->id));

        //Assert
        $this->assertAllTasksJsonStructure($response);
        $response->assertJsonCount(3);
    }

    protected function assertAllTasksJsonStructure($response)
    {
        $response->assertStatus(200)
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'title',
                    'description',
                    'assigned_to',
                    'due_date',
                    'status',
                    'project' => [
                        'id',
                        'title',
                        'description',
                        'status'
                    ]
                ]
            ]);
    }

    public function test_returns_404_project_is_not_found_when_getting_tasks_by_project()
    {
        // Action
        $response = $this->getJson(route('tasks.listByProject', 0));

        // Assert
        $response->assertStatus(404);
        $response->assertJson([
            'message' => 'Project not found.',
        ]);
    }


    public function test_create_a_task_successfully()
    {
        //Arrange
        $project = Project::factory()->create();
        $data = [
            "title" => "A sample task",
            "description" => "This is a testing task",
            "assigned_to" => "sai",
            "due_date" => "2025-01-30",
            "status" => "to_do",
        ];

        //Action
        $response = $this->postJson(route('tasks.store', $project->id), $data);

        //Assert
        $response->assertStatus(201);
        $this->assertDatabaseHas('tasks', $data);
    }

    public function test_return_404_project_not_found_when_creating_a_task_under_project()
    {
        //Arrange
        $data = [
            "title" => "A sample task",
            "description" => "This is a testing task",
            "assigned_to" => "sai",
            "due_date" => "2025-01-30",
            "status" => "to_do",
        ];

        //Action
        $response = $this->postJson(route('tasks.store', 0), $data);

        //Assert
        $response->assertStatus(404);
        $response->assertJson([
            'message' => 'Project not found.'
        ]);
    }

    public function test_get_a_task_successfully()
    {
        //Arrange
        $task = Task::factory()->create();
        //Action
        $response = $this->getJson(route('tasks.show', $task->id));
        //Assert
        $this->assertSingleTaskJsonStructure($response);
    }

    public function test_return_404_task_not_found_when_getting_a_task()
    {
        //Action
        $response = $this->getJson(route('tasks.show', 0));
        //Assert
        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Task not found.',
            ]);
    }

    public function test_update_a_task_successfully()
    {
        // Arrange
        $task = Task::factory()->create();
        $project = Project::factory()->create();
        $updatedData = [
            "title" => "Updated a sample task",
            "description" => "This is a updated testing task",
            "assigned_to" => "sai",
            "due_date" => "2025-01-30",
            "status" => "to_do",
            "project_id" => $project->id
        ];
        // Action
        $response = $this->putJson(route('tasks.update', $task->id), $updatedData);

        //Assert
        $response->assertStatus(200);
        $this->assertDatabaseHas('tasks', $updatedData);
    }

    public function test_return_404_task_not_found_when_updating_a_task()
    {
        //Arrange 
        $project = Project::factory()->create();
        $updatedData = [
            "title" => "Updated a sample task",
            "description" => "This is a updated testing task",
            "assigned_to" => "sai",
            "due_date" => "2025-01-30",
            "status" => "to_do",
            "project_id" => $project->id
        ];

        //Action
        $response = $this->putJson(route('tasks.update', 0), $updatedData);
        //Assert
        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Task not found.',
            ]);
    }

    public function test_return_422_validataion_error_when_updating_a_task()
    {
        //Arrange
        $task = Task::factory()->create();
        $project = Project::factory()->create();
        $updatedData = [
            "title" => "", //Empty title
            "description" => "This is a updated testing task",
            "assigned_to" => "sai",
            "due_date" => "2025-01-30",
            "status" => "to_do",
            "project_id" => $project->id
        ];

        //Action
        $response = $this->putJson(route('tasks.update', $task->id), $updatedData);
        //Assert
        $response->assertStatus(422);
    }

    public function test_return_404_project_not_found_when_updating_a_task()
    {
        //Arrange
        $task = Task::factory()->create();
        $updatedData = [
            "title" => "Updated task",
            "description" => "This is a updated testing task",
            "assigned_to" => "sai",
            "due_date" => "2025-01-30",
            "status" => "to_do",
            "project_id" => 0 // invalid project
        ];

        //Action
        $response = $this->putJson(route('tasks.update', $task->id), $updatedData);
        //Assert
        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Project not found.',
            ]);;
    }


    public function test_delete_a_task_successfully()
    {
        //Arrage
        $task = Task::factory()->create();

        //Action
        $response = $this->deleteJson(route('tasks.destroy', $task->id));

        //Assertion
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Task deleted successfully.',
            ]);
    }

    public function test_return_404_task_not_found_when_deleting_a_task()
    {
        //Action
        $response = $this->getJson(route('tasks.destroy', 0));
        //Assert
        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Task not found.',
            ]);
    }



    protected function assertSingleTaskJsonStructure($response)
    {
        $response->assertStatus(200)
            ->assertJsonStructure([
                'task' => [
                    'id',
                    'title',
                    'description',
                    'assigned_to',
                    'due_date',
                    'status',
                    'project' => [
                        'id',
                        'title',
                        'description',
                        'status'
                    ]
                ]
            ]);
    }
}
