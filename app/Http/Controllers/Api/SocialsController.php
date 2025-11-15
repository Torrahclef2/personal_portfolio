<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Models\Socials;
use Illuminate\Http\Request;

class SocialsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $socials = Socials::all();
        return response()->json($socials);
    }

    public function store(Request $request)
    {
        $request->validate([
            'platform' => 'required|string|max:255',
            'url' => 'required|url',
            'icon' => 'required|string|max:255',
        ]);

        $social = Socials::create($request->all());
        return response()->json(['message' => 'Social created successfully', 'social' => $social], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Socials $socials)
    {
        $request->validate([
            'platform' => 'sometimes|required|string|max:255',
            'url' => 'sometimes|required|url',
            'icon' => 'sometimes|required|string|max:255',
        ]);

        $socials->update($request->all());
        return response()->json(['message' => 'Social updated successfully', 'social' => $socials], 200);   
    }

    public function show(Socials $socials)
    {
        $socials = Socials::find($socials->id);
        return response()->json($socials);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Socials $socials)
    {
        $socials->delete();
        return response()->json(['message' => 'Social deleted successfully']);
    }
}
