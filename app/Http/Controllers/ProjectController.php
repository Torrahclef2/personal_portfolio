<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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
        $pagetitle = "Admin | Projects";
      $projects = Project::paginate(10);
        return view('admin.projects.index', compact('projects', 'pagetitle'));
        
    }

    public function create()
    {
        $pagetitle = "Admin | Create Project";
        return view('admin.projects.create', compact('pagetitle'));
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
    ]);

    //Generate slug from title
    $validated['slug'] = Str::slug($request->input('title'));
    // Generate slug if not provided
    $counter = 1;
    // Keep incrementing until slug is unique
    while (Project::where('slug', $validated['slug'])->exists()) {
        $validated['slug'] = $validated['slug'] . '-' . $counter;
        $counter++;
    }
    
    // Handle image upload
    if ($request->hasFile('image')) {
    $image      = $request->file('image');
    $imageName  = time().'_'.$image->getClientOriginalName();
    $image->move(public_path('uploads/projects'), $imageName);

    $validated['image'] = $imageName;
   }

    // Create project using mass assignment
    $project = Project::create($validated);

    return back()->with('success', 'Project created successfully');
}


    public function edit(Project $project)
    {
        $pagetitle = "Admin | Edit Project";
        return view('admin.projects.edit', compact('project', 'pagetitle'));
    }

   
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'image' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'github_link' => 'sometimes|nullable|url',
            'live_link' => 'sometimes|nullable|url',
        ]);

        // Generate slug from title
       $validated['slug'] = Project::where('id', $project->id)->value('slug');
    
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($project->image) {
                $imagePath = public_path('uploads/projects/' . $project->image);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
            }
            $image      = $request->file('image');
            $imageName  = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('uploads/projects'), $imageName);
            $validated['image'] = $imageName;
        }
        
        $project->update($validated);

        return back()->with('success', 'Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if ($project->image) {
          $imagePath = public_path('uploads/projects/' . $project->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $project->delete();

        return back()->with('success', 'Project deleted successfully');
    }
}
