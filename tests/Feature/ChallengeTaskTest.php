<?php

use Illuminate\Testing\Fluent\AssertableJson;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

function isTask(AssertableJson $json) {
    return $json->whereAllType(array(
            'id' => 'integer',
            'project_id' => 'integer',
            'title' => 'string',
            'description' => 'string',
            'status' => 'string',
            'assigned_to' => 'string',
        ));
}

test('test tasks list', function () {
    $project = \App\Models\Project::factory()->create();
    \App\Models\Task::factory()->create(array(
        'project_id' => $project->id,
    )); // create at least one project to test
    $response = $this->getJson('/api/tasks');

    $response->assertStatus(200);

    $response->assertJson(function (AssertableJson $json) {
        $json->has('data', null, function(AssertableJson $data) {
            isTask($data)
                ->etc();
        })->etc();
    });

    expect($response->json())->toBeArray();
});


test('test task get', function () {
    $project = \App\Models\Project::factory()->create();
    $task = \App\Models\Task::factory()->create([
        'project_id' => $project->id,
    ]);
    $response = $this->getJson('/api/tasks/'.$task->id);
    $response->assertStatus(200);
    $response->assertJson(function (AssertableJson $json) use ($task) {
        isTask($json)
            ->where('id', $task->id)
            ->where('project_id', $task->project_id)
            ->where('title', $task->title)
            ->where('description', $task->description)
            ->where('status', $task->status)
            ->where('assigned_to', $task->assigned_to)
            ->etc();
    });
});

describe('create', function () {

    test('test task create', function () {
        $title = "Test Task Title Goes Here";
        $description = "Test task description is here.";
        $assigned_to = "John Doe";
        $due_date = "2030-10-13";
        $status = \App\Models\Task::STATUS_IN_PROGRESS;

        $project = \App\Models\Project::factory()->create()->first();

        $response = $this->post('/api/tasks', array(
            'title' => $title,
            'description' => $description,
            'assigned_to' => $assigned_to,
            'due_date' => $due_date,
            'project_id' => $project->id,
            'status' => $status,
        ));
        $response->assertStatus(201);
        $response->assertJson(function (AssertableJson $json) use ($title, $description, $assigned_to, $due_date, $project, $status) {
            isProject($json)
                ->where('title', $title)
                ->where('description', $description)
                ->where('assigned_to', $assigned_to)
                ->whereContains('due_date', $due_date)
                ->where('project_id', $project->id)
                ->where('status', $status)
                ->etc();
        });

        $task = \App\Models\Task::where('id', $response['id'])->first();
        expect($task->id)->toBe($task->id)
            ->and($task->title)->toBe($task->title)
            ->and($task->description)->toBe($task->description)
            ->and($task->assigned_to)->toBe($task->assigned_to)
            ->and($task->due_date)->toContain($task->due_date)
            ->and($task->project_id)->toBe($task->project_id)
            ->and($task->status)->toBe($task->status);
    });

    test('test task create fails when no title', function () {
        $title = "Test Task Title Goes Here";
        $description = "Test task description is here.";
        $assigned_to = "John Doe";
        $due_date = "2030-10-13";
        $status = \App\Models\Task::STATUS_IN_PROGRESS;

        $project = \App\Models\Project::factory()->create()->first();

        $response = $this->post('/api/tasks', array(
            'description' => $description,
            'assigned_to' => $assigned_to,
            'due_date' => $due_date,
            'project_id' => $project->id,
            'status' => $status,
        ));
        $response->assertStatus(400);
    });

    test('test task create fails when no project id', function () {
        $title = "Test Task Title Goes Here";
        $description = "Test task description is here.";
        $assigned_to = "John Doe";
        $due_date = "2030-10-13";
        $status = \App\Models\Task::STATUS_IN_PROGRESS;

        $project = \App\Models\Project::factory()->create()->first();

        $response = $this->post('/api/tasks', array(
            'title' => $title,
            'description' => $description,
            'assigned_to' => $assigned_to,
            'due_date' => $due_date,
            'status' => $status,
        ));
        $response->assertStatus(400);
    });

    test('test task create fails when no status', function () {
        $title = "Test Task Title Goes Here";
        $description = "Test task description is here.";
        $assigned_to = "John Doe";
        $due_date = "2030-10-13";
        $status = \App\Models\Task::STATUS_IN_PROGRESS;

        $project = \App\Models\Project::factory()->create()->first();

        $response = $this->post('/api/tasks', array(
            'title' => $title,
            'description' => $description,
            'assigned_to' => $assigned_to,
            'due_date' => $due_date,
            'project_id' => $project->id,
        ));
        $response->assertStatus(400);
    });
});

describe('update', function() {

    test('test task update', function () {
        $project = \App\Models\Project::factory()->create()->first();
        $task = \App\Models\Task::factory()->create([
            'project_id' => $project->id,
        ]);

        $title_alt = "Modified Test Task Title Goes Here";
        $description_alt = "Modified Test task description is here.";
        $assigned_to_alt = "Jane Appleseed";
        $due_date_alt = "2040-10-13";
        $status_alt = \App\Models\Task::STATUS_TO_DO;

        $project_alt = \App\Models\Project::factory()->create()->first();

        $putresponse = $this->put('/api/tasks/'.$task->id, [
            'title' => $title_alt,
            'description' => $description_alt,
            'assigned_to' => $assigned_to_alt,
            'due_date' => $due_date_alt,
            'project_id' => $project_alt->id,
            'status' => $status_alt,
        ]);
        $putresponse->assertStatus(200);
        $putresponse->assertJson(function (AssertableJson $json) use ($title_alt, $description_alt, $status_alt, $assigned_to_alt, $due_date_alt, $project_alt, $task) {
            isProject($json)
                ->where('id', $task->id)
                ->where('title', $title_alt)
                ->where('description', $description_alt)
                ->where('assigned_to', $assigned_to_alt)
                ->whereContains('due_date', $due_date_alt)
                ->where('project_id', $project_alt->id)
                ->where('status', $status_alt)
                ->etc();
        });

        $task = \App\Models\Task::where('id', $task->id)->first();
        expect($task->id)->toBe($task->id)
            ->and($task->title)->toBe($title_alt)
            ->and($task->description)->toBe($description_alt)
            ->and($task->assigned_to)->toBe($assigned_to_alt)
            ->and($task->due_date)->toContain($due_date_alt)
            ->and($task->project_id)->toBe($project_alt->id)
            ->and($task->status)->toBe($status_alt);
    });

    test('test task update succeeds when only title', function () {
        $project = \App\Models\Project::factory()->create()->first();
        $task = \App\Models\Task::factory()->create([
            'project_id' => $project->id,
        ]);

        $title_alt = "Modified Test Task Title Goes Here";

        $putresponse = $this->put('/api/tasks/'.$task->id, [
            'title' => $title_alt,
        ]);
        $putresponse->assertStatus(200);
    });

    test('test task update succeeds when only description', function () {
        $project = \App\Models\Project::factory()->create()->first();
        $task = \App\Models\Task::factory()->create([
            'project_id' => $project->id,
        ]);

        $description_alt = "Modified Test task description is here.";

        $putresponse = $this->put('/api/tasks/'.$task->id, [
            'description' => $description_alt,
        ]);
        $putresponse->assertStatus(200);
    });

    test('test task update succeeds when only assigned to', function () {
        $project = \App\Models\Project::factory()->create()->first();
        $task = \App\Models\Task::factory()->create([
            'project_id' => $project->id,
        ]);

        $assigned_to_alt = "Jane Appleseed";

        $putresponse = $this->put('/api/tasks/'.$task->id, [
            'assigned_to' => $assigned_to_alt,
        ]);
        $putresponse->assertStatus(200);
    });

    test('test task update succeeds when only due date', function () {
        $project = \App\Models\Project::factory()->create()->first();
        $task = \App\Models\Task::factory()->create([
            'project_id' => $project->id,
        ]);

        $due_date_alt = "2040-10-13";

        $putresponse = $this->put('/api/tasks/'.$task->id, [
            'due_date' => $due_date_alt,
        ]);
        $putresponse->assertStatus(200);
    });

    test('test task update succeeds when only project id', function () {
        $project = \App\Models\Project::factory()->create()->first();
        $task = \App\Models\Task::factory()->create([
            'project_id' => $project->id,
        ]);

        $project_alt = \App\Models\Project::factory()->create()->first();

        $putresponse = $this->put('/api/tasks/'.$task->id, [
            'project_id' => $project_alt->id,
        ]);
        $putresponse->assertStatus(200);
    });

    test('test task update succeeds when only status', function () {
        $project = \App\Models\Project::factory()->create()->first();
        $task = \App\Models\Task::factory()->create([
            'project_id' => $project->id,
        ]);

        $status_alt = \App\Models\Task::STATUS_TO_DO;

        $putresponse = $this->put('/api/tasks/'.$task->id, [
            'status' => $status_alt,
        ]);
        $putresponse->assertStatus(200);
    });
});

test('test projects delete', function () {
    $project = \App\Models\Project::factory()->create()->first();
    $task = \App\Models\Task::factory()->create([
        'project_id' => $project->id,
    ]);

    $deleteresponse = $this->delete('/api/tasks/'.$task->id);
    $deleteresponse->assertStatus(200);

    expect(\App\Models\Task::where('id', $task->id)->get())->toBeEmpty();
});
