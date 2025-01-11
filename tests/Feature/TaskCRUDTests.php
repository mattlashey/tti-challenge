<?php
namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskCRUDTests extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_task()
    {
        $project = Project::factory()->create();

        $dueDate = now()->addDays(10)->toDateString();

        $data = [
            'title'       => 'Test Task',
            'description' => 'Test task description',
            'assigned_to' => 'user@example.com',
            'due_date'    => $dueDate,
            'status'      => 'to_do',
        ];

        $response = $this->postJson("/api/projects/{$project->id}/tasks", $data);

        $response->assertStatus(201)
            ->assertJson([
                'data' => [
                    'title'       => 'Test Task',
                    'description' => 'Test task description',
                    'assigned_to' => 'user@example.com',
                    'status'      => 'to_do',
                    'due_date'    => $dueDate,
                ]
            ]);

        $this->assertDatabaseHas('tasks', [
            'title'       => 'Test Task',
            'description' => 'Test task description',
            'assigned_to' => 'user@example.com',
            'status'      => 'to_do',
            'project_id'  => $project->id,
            'due_date'    => $dueDate,
        ]);
    }

    /** @test */
    public function it_can_update_a_task()
    {
        $task = Task::factory()->create();
        $updatedData = [
            'title'       => 'Updated Task Title',
            'description' => 'Updated task description',
            'assigned_to' => 'newuser@example.com',
            'status'      => 'in_progress',
        ];

        $response = $this->putJson("/api/tasks/{$task->id}", $updatedData);

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'title'       => 'Updated Task Title',
                    'description' => 'Updated task description',
                    'assigned_to' => 'newuser@example.com',
                    'status'      => 'in_progress',
                ]
            ]);

        $this->assertDatabaseHas('tasks', array_merge($updatedData, ['id' => $task->id]));
    }

    /** @test */
    public function it_can_delete_a_task()
    {
        $task = Task::factory()->create();

        $response = $this->deleteJson("/api/tasks/{$task->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    /** @test */
    public function it_can_fetch_tasks_by_project()
    {
        $project = Project::factory()->create();

        Task::factory()->count(3)->create(['project_id' => $project->id]);

        $this->assertCount(3, Task::where('project_id', $project->id)->get());

        $response = $this->getJson('/api/projects/' . $project->id . '/tasks');
        $response->assertJsonCount(3, 'data');
    }
}
