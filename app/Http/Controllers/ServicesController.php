<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pagetitle = "Admin | Services";
        $services = Services::all();
        return view('admin.services.index', compact('services', 'pagetitle'));
    }

    public function create()
    {
        $pagetitle = "Admin | Create Service";
        return view('admin.services.create', compact('pagetitle'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $request->merge(['slug' => Str::slug($request->input('title'))]);

        // Generate slug if not provided
        $counter = 1;
        // Keep incrementing until slug is unique
        while (Services::where('slug', $request->input('slug'))->exists()) {
            $request->merge(['slug' => $request->input('slug') . '-' . $counter]);
            $counter++;
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $image      = $request->file('image');
            $imageName  = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('uploads/services'), $imageName);
            $request->merge(['image' => $imageName]);
        }

        $service = Services::create($request->all());
        return back()->with('success', 'Service created successfully');
    }

    public function edit(Services $services)
    {
        $pagetitle = "Admin | Edit Service";
        return view('admin.services.edit', compact('services', 'pagetitle'));
    }

    public function update(Request $request, Services $services)
    {
        $validated=$request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $validated['slug'] = $services->slug;
        if ($request->hasFile('image')) {
            $image      = $request->file('image');
            $imageName  = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('uploads/services'), $imageName);
            $validated['image'] = $imageName;
        }
        else {
            $validated['image'] = $services->image;
        }

        $services->update($validated);
        return back()->with('success', 'Service updated successfully');
    }

    // public function show(Services $services)
    // {
    //     $services = Services::find($services->id);
    //     return response()->json($services);
    // }
    
    public function destroy(Services $services)
    {
        if($services->image){
            $imagePath = public_path('uploads/services/' . $services->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $services->delete();
       
        return back()->with('success', 'Service deleted successfully');
    }
}
