<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
     public function index()
    {
        $projects = Auth::user()->role === 'admin'
            ? Project::with('tasks')->latest()->get()
            : Auth::user()->projects()->with('tasks')->latest()->get();

        return response()->json([
            'status' => 200,
            'message' => 'Projects fetched successfully',
            'data' => $projects
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',

        ]);

        $project = Auth::user()->projects()->create($validated);

        return response()->json([
            'status' => 201,
            'message' => 'Project created successfully',
            'data' => $project,
            'user_id' => Auth::id() // Assuming you want to store the user ID
        ], 201);
    }

    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project); // If using policies

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project->update($validated);

        return response()->json([
            'status' => 200,
            'message' => 'Project updated successfully',
            'data' => $project
        ]);
    }

    public function destroy(Project $project)
    {
        $this->authorize('delete', $project); // If using policies

        $project->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Project deleted successfully',
        ]);
    }
}
