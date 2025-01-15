<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Project::paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['string', 'required'],
            'description' => ['nullable', 'string'],
            'status' => ['required', Rule::in([Project::STATUS_OPEN, Project::STATUS_IN_PROGRESS, Project::STATUS_COMPLETED])],
        ]);
        return response()->json(Project::create($data), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::where('id', $id)->first();
        if (empty($project)) {
            return response()->json($this->error("No Project with ID {$id} found!"), 404);
        }
        return response()->json($project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $project = Project::where('id', $id)->first();
        if (empty($project)) {
            return response()->json($this->error("No Project with ID {$id} found!"), 404);
        }

        $data = $request->validate([
            'title' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', Rule::in([Project::STATUS_OPEN, Project::STATUS_IN_PROGRESS, Project::STATUS_COMPLETED])],
        ]);
        $project->update($data);
        return response()->json($project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::where('id', $id)->first();
        if (empty($project)) {
            return response()->json($this->error("No Project with ID {$id} found!"), 404);
        }
        $project->delete();
        return response()->json(array(
            'success' => true,
            'id' => $project->id,
        ));
    }

    public function tasks(string $id) {

        $project = Project::where('id', $id)->first();
        if (empty($project)) {
            return response()->json($this->error("No Project with ID {$id} found!"), 404);
        }
        return response()->json($project->tasks()->paginate());
    }
}
