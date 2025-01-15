<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskApiTest extends TestCase {
    use RefreshDatabase;

    /** @test */
    public function it_can_list_all_tasks()
    {
        $task = Task::factory()->create();

        $response = $this->get('/api/tasks');

        $response->assertStatus(200)
                 ->assertJsonFragment(['title' => $task->title]);
    }

    /** @test */
    public function it_can_list_tasks_for_a_project()
    {
        $project = Project::factory()->create();
        $task = Task::factory()->create(['project_id' => $project->id]);

        $response = $this->get("/api/projects/{$project->id}/tasks");

        $response->assertStatus(200)
                 ->assertJsonFragment(['title' => $task->title]);
    }

    /** @test */
    public function it_can_create_a_new_task()
    {
        $project = Project::factory()->create();

        $data = [
            'title' => 'New Task',
            'status' => 'to_do',
        ];

        $response = $this->post("/api/projects/{$project->id}/tasks", $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['title' => 'New Task']);
    }

    /** @test */
    public function it_can_show_a_single_task()
    {
        $task = Task::factory()->create();

        $response = $this->get("/api/tasks/{$task->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['title' => $task->title]);
    }

    /** @test */
    public function it_can_update_a_task()
    {
        $task = Task::factory()->create();

        $data = [
            'title' => 'Updated Task Title',
            'status' => 'in_progress',
        ];

        $response = $this->put("/api/tasks/{$task->id}", $data);

        $response->assertStatus(200)
                 ->assertJsonFragment(['title' => 'Updated Task Title']);
    }

    /** @test */
    public function it_can_delete_a_task()
    {
        $task = Task::factory()->create();

        $response = $this->delete("/api/tasks/{$task->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);  // Assert the task is deleted
    }
}

