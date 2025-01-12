<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Project;
use App\Models\Task;

class TaskApiTest extends TestCase
{
    use RefreshDatabase;

    #[\PHPUnit\Framework\Attributes\Test]
     public function it_can_create_a_task_for_a_project()
     {
         $project = Project::factory()->create();
 
         $response = $this->postJson("/api/projects/{$project->id}/tasks", [
             'title' => 'New Task',
             'description' => 'Task description',
             'assigned_to' => 'Test User',
             'due_date' => '2025-01-11',
             'status' => 'to_do',
             'project_id' => $project->id,
         ]);
 
         $response->assertStatus(201)  // Assert 201 Created
                  ->assertJsonStructure([
                      'id',
                      'title',
                      'description',
                      'assigned_to',
                      'due_date',
                      'status',
                  ]);
     }
    
     #[\PHPUnit\Framework\Attributes\Test]
     public function it_can_fetch_all_tasks_for_a_project()
     {
         $project = Project::factory()->create();
         $tasks = Task::factory()->count(3)->create(['project_id' => $project->id]);
 
         $response = $this->getJson("/api/projects/{$project->id}/tasks");
 
         $response->assertStatus(200)  // Assert 200 OK
                  ->assertJsonCount(3);  // Assert 3 tasks are returned
     }
 
     #[\PHPUnit\Framework\Attributes\Test]
     public function it_can_update_a_task()
     {
        $project = Project::factory()->create();
        $task = Task::factory()->create(['project_id' => $project->id]);
    
        $response = $this->putJson("/api/tasks/{$task->id}", [
             'title' => 'Updated Task',
             'description' => 'Updated description',
             'assigned_to' => 'Test User',
             'status' => 'in_progress',
             'project_id' => $project->id,
        ]);
 
         $response->assertStatus(200)  // Assert 200 OK
                  ->assertJson([
                      'title' => 'Updated Task',
                      'assigned_to' => 'Test User',
                      'status' => 'in_progress',
                  ]);
     }
 
     #[\PHPUnit\Framework\Attributes\Test]
     public function it_can_delete_a_task()
     {
         $task = Task::factory()->create();
 
         $response = $this->deleteJson("/api/tasks/{$task->id}");
 
         $response->assertStatus(204);  // Assert 204 No Content
     }
 
     #[\PHPUnit\Framework\Attributes\Test]
     public function it_returns_404_when_task_not_found()
     {
         $response = $this->getJson('/api/tasks/999');
 
         $response->assertStatus(404)  // Assert 404 Not Found
                  ->assertJson([
                      'message' => 'Task not found',
                  ]);
     }

}
