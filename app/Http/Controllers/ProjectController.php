<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Models\Project;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return response()->json($projects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectStoreRequest $request)
    {
        $new_project = Project::create($request->validated());
        return response()->json($new_project, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $project = Project::where('id', $id)->firstOrFail();
            return response()->json($project);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success'   => false,
                'message'   => 'Project ID: ' . $id . ' not found.'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectUpdateRequest $request, string $id)
    {
        try {
            $project = Project::findOrFail($id);
            $project->update($request->validated());
            return response()->json($project);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success'   => false,
                'message'   => 'Project ID: ' . $id . ' not found.'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $project = Project::where('id', $id)->firstOrFail();
            $project->delete();
            return response()->json([
                'success'   => true,
                'message'   => 'Project ID: ' . $id . ' deleted.'
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success'   => false,
                'message'   => 'Project ID: ' . $id . ' not found.'
            ], 404);
        }
    }
}
