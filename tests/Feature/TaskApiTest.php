<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_tasks_for_a_project()
    {
        $project = Project::factory()->create();
        Task::factory()->count(3)->create(['project_id' => $project->id]);

        $response = $this->getJson("/api/projects/{$project->id}/tasks");

        $response->assertStatus(200)
                ->assertJsonCount(3);
    }

    /** @test */
    public function it_can_create_a_task_for_a_project()
    {
        $project = Project::factory()->create();

        $data = [
            'title' => 'New Task',
            'description' => 'Task description',
            'assigned_to' => 'John Doe',
            'due_date' => now()->addWeek()->format('Y-m-d'),
            'status' => 'to_do',
        ];

        $response = $this->postJson("/api/projects/{$project->id}/tasks", $data);

        $response->assertStatus(201)
                ->assertJsonFragment($data);

        $this->assertDatabaseHas('tasks', $data);
    }

    /** @test */
    public function it_requires_a_title_when_creating_a_task()
    {
        $project = Project::factory()->create();

        $response = $this->postJson("/api/projects/{$project->id}/tasks", [
            'description' => 'Task without title',
        ]);

        $response->assertStatus(422)
                ->assertJsonValidationErrors(['title']);
    }

    /** @test */
    public function it_can_show_a_task()
    {
        $task = Task::factory()->create();

        $response = $this->getJson("/api/tasks/{$task->id}");

        $response->assertStatus(200)
                ->assertJsonFragment([
                    'title' => $task->title,
                    'description' => $task->description,
                ]);
    }

    /** @test */
    public function it_returns_404_for_non_existent_task()
    {
        $response = $this->getJson('/api/tasks/999');

        $response->assertStatus(404);
    }

    /** @test */
    public function it_can_update_a_task()
    {
        $task = Task::factory()->create();

        $data = [
            'title' => 'Updated Task Title',
            'description' => 'Updated Task Description',
            'status' => 'in_progress',
        ];

        $response = $this->putJson("/api/tasks/{$task->id}", $data);

        $response->assertStatus(200)
                ->assertJsonFragment($data);

        $this->assertDatabaseHas('tasks', $data);
    }

    /** @test */
    public function it_can_delete_a_task()
    {
        $task = Task::factory()->create();

        $response = $this->deleteJson("/api/tasks/{$task->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
