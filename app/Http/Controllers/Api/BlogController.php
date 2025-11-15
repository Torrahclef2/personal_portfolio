<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::all();
        return response()->json($blogs);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'slug' => 'required|string|max:255|unique:blogs,slug',
        ]);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/uploads/blogs');
            $validatedData['image'] = basename($imagePath);
        }
        $blog = Blog::create($validatedData);
        return response(
            [
                'message' => 'Blog created successfully',
                'blog' => $blog
            ],
            201
        );
    }

 
    public function update(Request $request, Blog $blog)
    {
        $validatedData = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'slug' => 'sometimes|required|string|max:255|unique:blogs,slug,' . $blog->id,
        ]);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/uploads/blogs');
            $validatedData['image'] = basename($imagePath);
        } else {
            $validatedData['image'] = $blog->image;
        }
        $blog->update($validatedData);
        return response(
            [
                'message' => 'Blog updated successfully',
                'blog' => $blog
            ],
            200
        );
    }

    public function show(Blog $blog)
    {
        $blog = Blog::find($blog->id);
        return response()->json($blog);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return response()->json(['message' => 'Blog deleted successfully'], 200);
    }
}
