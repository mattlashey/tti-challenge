<?php

use Illuminate\Testing\Fluent\AssertableJson;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('test projects list task', function () {
    $project = \App\Models\Project::factory()->create()->first();
    $tasks = \App\Models\Task::factory()->count(10)->create([
        'project_id' => $project->id,
    ]);

    $response = $this->get('/api/projects/'.$project->id.'/tasks');
    $response->assertStatus(200);

    $response->assertJson(function (AssertableJson $json) use ($project, $tasks) {
        $json->has('data', null, function(AssertableJson $data) use ($project, $tasks) {
            isTask($data)
                ->where('project_id', $project->id)
                ->etc();
        })->etc();
    });
});
