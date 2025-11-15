<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pagetitle = "Admin | Blog";
        $blogs = Blog::paginate(10);
        return view('admin.blog.index', compact('blogs', 'pagetitle'));
    }


    public function create()
    {
        $pagetitle = "Admin | Create Blog";
        return view('admin.blog.create', compact('pagetitle'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'slug' => 'required|string|max:255',
        ]);

        // Generate slug if not provided
    $counter = 1;

    // Keep incrementing until slug is unique
    while (Blog::where('slug', $validatedData['slug'])->exists()) {
        $validatedData['slug'] = $validatedData['slug'] . '-' . $counter;
        $counter++;
    }

       if ($request->hasFile('image')) {
    $image      = $request->file('image');
    $imageName  = time().'_'.$image->getClientOriginalName();
    $image->move(public_path('uploads/blogs'), $imageName);

    $validatedData['image'] = $imageName;
}

        $blog = Blog::create($validatedData);
        return back()->with('success', 'Blog created successfully');
    }

    public function edit(Blog $blog)
    {
        $pagetitle = "Admin | Edit Blog";
        return view('admin.blog.edit', compact('blog', 'pagetitle'));
    }
 
    public function update(Request $request, Blog $blog)
    {
        $validatedData = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'slug' => 'sometimes|required|string|max:255',
        ]);
      
        // Generate slug if not provided
    $counter = 1;
    // Keep incrementing until slug is unique
    while (Blog::where('slug', $validatedData['slug'])->where('id', '!=', $blog->id)->exists()) {
        $validatedData['slug'] = $validatedData['slug'] . '-' . $counter;
        $counter++;
    }

      if ($request->hasFile('image')) {
    $image      = $request->file('image');
    $imageName  = time().'_'.$image->getClientOriginalName();
    $image->move(public_path('uploads/blogs'), $imageName);

    $validatedData['image'] = $imageName;
}
        else {
            $validatedData['image'] = $blog->image;
        }
        $blog->update($validatedData);
        return back()->with('success', 'Blog updated successfully');
    }

    // public function show(Blog $blog)
    // {
    //     $blog = Blog::find($blog->id);
    //     return response()->json($blog);
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        if($blog->image){
            $imagePath = public_path('uploads/blogs/' . $blog->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $blog->delete();
        return back()->with('success', 'Blog deleted successfully');
    }
}
