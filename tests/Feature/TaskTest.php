<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_can_create_new_task(): void
    {
        $project = Project::factory()->create();

        $task = [
            'project_id' => $project->id,
            'title' => 'New Task',
            'description' => 'Task description',
            'assigned_to' => 'Person',
            'due_date' => now()->toDateString(),
            'status' => 'to_do',
        ];
        
        $response = $this->post("/api/projects/{$project->id}/tasks", $task);
        $response->assertStatus(201);
        $this->assertDatabaseHas('tasks', $task);
    }
    
    public function test_can_update_task(): void
    {
        $project = Project::factory()->create();
        $task = Task::factory()->create([
            'project_id' => $project->id
        ]);

        $new_task_data = [
            'project_id' => $project->id,
            'title' => 'New Task',
            'description' => 'Task description',
            'assigned_to' => 'Person',
            'due_date' => now()->toDateString(),
            'status' => 'to_do',
        ];
        $response = $this->put("/api/tasks/{$task->id}", $new_task_data);
        $response->assertStatus(200);
        $this->assertDatabaseHas('tasks', $new_task_data);
    }
    
    public function test_can_delete_task(): void
    {
        $project = Project::factory()->create();
        $task = Task::factory()->create([
            'project_id' => $project->id
        ]);

        $response = $this->delete("/api/tasks/{$task->id}");
        $response->assertStatus(204);
        $this->assertModelMissing($task);
    }
}
