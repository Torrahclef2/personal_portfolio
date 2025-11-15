<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Project;
use Illuminate\Auth\Events\Failed;
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
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
{
    // Validate input
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'github_link' => 'nullable|url',
        'live_link' => 'nullable|url',
        'slug' => 'required|string|max:255|unique:projects,slug',
    ]);

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('public/uploads/projects');
        $validated['image'] = basename($imagePath);
    }

    // Check if user is authenticated
    if (!Auth::check()) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    // Create project using mass assignment
    $project = Project::create($validated);

    return response()->json([
        'message' => 'Project created successfully',
        'project' => $project
    ], 201);
}


    /**
     * Store a newly created resource in storage.
     */
   

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
       $project = Project::find($project->id);
       return response()->json($project);
    }

   
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'image' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'github_link' => 'sometimes|nullable|url',
            'live_link' => 'sometimes|nullable|url',
            'slug' => 'sometimes|required|string|max:255|unique:projects,slug,' . $project->id,
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($project->image) {
                Storage::delete('public/uploads/projects/' . $project->image);
            }
            $imagePath = $request->file('image')->store('public/uploads/projects');
            $validated['image'] = basename($imagePath);
        }else{
            $validated['image'] = $project->image;
        }
        
        $project->update($validated);

        return response()->json([
            'message' => 'Project updated successfully',
            'project' => $project
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if ($project->image) {
            Storage::delete('public/uploads/projects/' . $project->image);
        }
        $project->delete();

        return response()->json(['message' => 'Project deleted successfully']);
    }
}
