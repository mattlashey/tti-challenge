<?php

use Illuminate\Testing\Fluent\AssertableJson;

function isProject(AssertableJson $json)
{
    return $json->whereAllType(array(
        'id' => 'integer',
        'title' => 'string',
        'description' => 'string',
        'status' => 'string',
    ));
}

test('test projects list', function () {
    $response = $this->getJson('/api/projects');

    $response->assertStatus(200);

    $response->assertJson(function (AssertableJson $json) {
        $json->has('data', null, function(AssertableJson $data) {
            isProject($data)
                ->etc();
        })->etc();
    });

    expect($response->json())->toBeArray();
});

test('test project get', function () {
    $project = \App\Models\Project::factory()->create();
    $response = $this->getJson('/api/projects/'.$project->id);
    $response->assertStatus(200);
    $response->assertJson(function (AssertableJson $json) use ($project) {
        isProject($json)
            ->where('id', $project->id)
            ->where('title', $project->title)
            ->where('description', $project->description)
            ->where('status', $project->status)
            ->etc();
    });
});

test('test project create', function () {
    $title = "Test Project Title Goes Here";
    $description = "Test project description is here.";
    $status = \App\Models\Project::STATUS_IN_PROGRESS;

    $response = $this->post('/api/projects', array(
        'title' => $title,
        'description' => $description,
        'status' => $status,
    ));
    $response->assertStatus(201);
    $response->assertJson(function (AssertableJson $json) use ($title, $description, $status) {
        isProject($json)
            ->where('title', $title)
            ->where('description', $description)
            ->where('status', $status)
            ->etc();
    });

    $project = \App\Models\Project::where('id', $response['id'])->first();
    expect($project->id)->toBe($response['id'])
        ->and($project->title)->toBe($title)
        ->and($project->description)->toBe($description)
        ->and($project->status)->toBe($status);
});

test('test project update', function () {
    $project = \App\Models\Project::factory()->create();

    $title_alt = "Altered Test Project Title Goes Here";
    $description_alt = "Altered Test project description is here.";
    $status_alt = \App\Models\Project::STATUS_OPEN;

    $putresponse = $this->put('/api/projects/'.$project->id, [
        'title' => $title_alt,
        'description' => $description_alt,
        'status' => $status_alt,
    ]);
    $putresponse->assertStatus(200);
    $putresponse->assertJson(function (AssertableJson $json) use ($title_alt, $description_alt, $status_alt, $project) {
        isProject($json)
            ->where('id', $project->id)
            ->where('title', $title_alt)
            ->where('description', $description_alt)
            ->where('status', $status_alt)
            ->etc();
    });

    $project->refresh();
    expect($project->id)->toBe($project->id)
        ->and($project->title)->toBe($title_alt)
        ->and($project->description)->toBe($description_alt)
        ->and($project->status)->toBe($status_alt);
});

test('test projects delete', function () {
    $project = \App\Models\Project::factory()->create();

    $deleteresposne = $this->delete('/api/projects/'.$project->id);
    $deleteresposne->assertStatus(200);

    expect(\App\Models\Project::where('id', $project->id)->get())->toBeEmpty();
});
