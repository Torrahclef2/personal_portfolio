<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Services::all();
        return response()->json($services);
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
            'slug' => 'required|string|max:255|unique:services,slug',
        ]);
        if($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/uploads/services');
            $request->merge(['image' => basename($imagePath)]);
        }

        $service = Services::create($request->all());
        return response()->json(['message' => 'Service created successfully', 'service' => $service], 201);
    }

    public function update(Request $request, Services $services)
    {
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'slug' => 'sometimes|required|string|max:255|unique:services,slug,' . $services->id,
        ]);
        if($request->hasFile('image')) {
            if($services->image){
                Storage::delete('public/uploads/services/' . $services->image);
            }
            $imagePath = $request->file('image')->store('public/uploads/services');
            $request->merge(['image' => basename($imagePath)]);
        }
        else{
            $request->merge(['image' => $services->image]);
        }
        $services->update($request->all());
        return response()->json(['message' => 'Service updated successfully', 'service' => $services], 200);
    }

    public function show(Services $services)
    {
        $services = Services::find($services->id);
        return response()->json($services);
    }
    
    public function destroy(Services $services)
    {
        if($services->image){
            Storage::delete('public/uploads/services/' . $services->image);
        }
        $services->delete();
       
        return response()->json(['message' => 'Service deleted successfully'], 200);
    }
}
