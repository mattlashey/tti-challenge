<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the index method to list all tasks.
     *
     * @return void
     */
    public function test_index()
    {
        $task = Task::factory()->create();

        $response = $this->getJson('/api/tasks');
        
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'data' => [
                         '*' => ['id', 'title', 'description', 'assigned_to', 'due_date', 'status', 'project_id'],
                     ]
                 ]);
    }

    /**
     * Test the indexByProject method to list tasks by project ID.
     *
     * @return void
     */
    public function test_index_by_project()
    {
        $project = Project::factory()->create();
        $task = Task::factory()->create(['project_id' => $project->id]);

        $response = $this->getJson("/api/projects/{$project->id}/tasks");
        
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'data' => [
                         '*' => ['id', 'title', 'description', 'assigned_to', 'due_date', 'status', 'project_id'],
                     ]
                 ]);
    }

    /**
     * Test the store method to create a task successfully.
     *
     * @return void
     */
    public function test_store_success()
    {
        $project = Project::factory()->create();

        $taskData = [
            'title' => 'New Task',
            'description' => 'Task Description',
            'assigned_to' => 'John Doe',
            'due_date' => date('Y-m-d'),
            'status' => 'to_do',
        ];

        $response = $this->postJson("/api/projects/{$project->id}/tasks", $taskData);

        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Task created successfully!',
                 ]);

        $this->assertDatabaseHas('tasks', array_merge($taskData, ['project_id' => $project->id]));
    }

    /**
     * Test store method failure (validation or exception).
     *
     * @return void
     */
    public function test_store_failure()
    {
        $project = Project::factory()->create();

        // Missing required field 'title'
        $response = $this->postJson("/api/projects/{$project->id}/tasks", [
            'description' => 'Task without title',
            'assigned_to' => 'John Doe',
            'due_date' => date('Y-m-d'),
            'status' => 'to_do',
        ]);

        $response->assertStatus(422)
                 ->assertJsonStructure([
                     'status',
                     'message'
                 ]);
    }

    /**
     * Test the show method to retrieve a task successfully.
     *
     * @return void
     */
    public function test_show_success()
    {
        $task = Task::factory()->create();

        $response = $this->getJson("/api/tasks/{$task->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Task retrieved successfully!',
                 ]);
    }

    /**
     * Test show method failure when task not found.
     *
     * @return void
     */
    public function test_show_failure()
    {
        $response = $this->getJson('/api/tasks/999');

        $response->assertStatus(404)
                 ->assertJson([
                     'status' => 'error',
                     'message' => 'Failed to find task!',
                 ]);
    }

    /**
     * Test update method to successfully update a task.
     *
     * @return void
     */
    public function test_update_success()
    {
        $task = Task::factory()->create();

        $updatedData = [
            'title' => 'Updated Task',
            'description' => 'Updated Description',
            'assigned_to' => 'Jane Doe',
            'status' => 'in_progress',
        ];

        $response = $this->putJson("/api/tasks/{$task->id}", $updatedData);
        Log::info(json_encode($response));

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Task updated successfully!',
                 ]);

        $this->assertDatabaseHas('tasks', $updatedData);
    }

    /**
     * Test update method failure when task not found.
     *
     * @return void
     */
    public function test_update_failure()
    {
        $response = $this->putJson('/api/tasks/999', [
            'title' => 'Non-existent task update',
            'description' => 'Updated Description',
            'assigned_to' => 'Jane Doe',
            'status' => 'in_progress',
        ]);

        $response->assertStatus(404)
                 ->assertJson([
                     'status' => 'error',
                     'message' => 'Failed to find task.Task not found!',
                 ]);
    }

    /**
     * Test destroy method to successfully delete a task.
     *
     * @return void
     */
    public function test_destroy_success()
    {
        $task = Task::factory()->create();

        $response = $this->deleteJson("/api/tasks/{$task->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Task deleted successfully!',
                 ]);

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    /**
     * Test destroy method failure when task not found.
     *
     * @return void
     */
    public function test_destroy_failure()
    {
        $response = $this->deleteJson('/api/tasks/999');

        $response->assertStatus(404)
                 ->assertJson([
                     'status' => 'error',
                     'message' => 'Failed to find task.Task not found!',
                 ]);
    }
}
