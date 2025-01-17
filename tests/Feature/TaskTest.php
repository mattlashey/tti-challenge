<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Task;
use App\Models\Project;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    // Show all tasks test
    public function test_it_can_list_all_tasks()
    {
        Task::factory()->count(5)->create();
        $response = $this->getJson('/api/tasks');
        $response->assertStatus(200)
                 ->assertJsonCount(5);
    }

    // Show all tasks for a project test
    public function test_it_can_list_tasks_for_a_project()
    {
        $project = Project::factory()->create();
        Task::factory()->count(3)->create(['project_id' => $project->id]);

        $response = $this->getJson("/api/projects/{$project->id}/tasks");

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    // Create tasks test
    public function test_it_can_create_a_task_for_a_project()
    {
        $project = Project::factory()->create();

        $data = [
            'title'       => 'New Task',
            'description' => 'Task description',
            'assigned_to' => 'John Doe',
            'due_date'    => '2025-12-31',
            'status'      => 'to_do'
        ];

        $response = $this->postJson("/api/projects/{$project->id}/tasks", $data);

        $response->assertStatus(201)
                 ->assertJsonFragment([
                     'title' => 'New Task',
                     'status' => 'to_do'
                 ]);

        $this->assertDatabaseHas('tasks', [
            'title'      => 'New Task',
            'project_id' => $project->id,
        ]);
    }

    // Show single task test
    public function test_it_can_show_a_single_task()
    {
        $task = Task::factory()->create([
            'title' => 'View Me'
        ]);

        $response = $this->getJson("/api/tasks/{$task->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'title' => 'View Me'
                 ]);
    }

    // Update task test
    public function test_it_can_update_a_task()
    {
        $task = Task::factory()->create([
            'title' => 'Old Task Title',
            'status' => 'to_do'
        ]);

        $response = $this->putJson("/api/tasks/{$task->id}", [
            'title'  => 'Updated Task Title',
            'status' => 'in_progress'
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'title'  => 'Updated Task Title',
                     'status' => 'in_progress'
                 ]);

        $this->assertDatabaseHas('tasks', [
            'id'    => $task->id,
            'title' => 'Updated Task Title',
            'status' => 'in_progress'
        ]);
    }

    // Delete task test
    public function test_it_can_delete_a_task()
    {
        $task = Task::factory()->create();

        $response = $this->deleteJson("/api/tasks/{$task->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Task deleted successfully'
                 ]);

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id
        ]);
    }
}
