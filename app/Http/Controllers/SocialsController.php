<?php

namespace App\Http\Controllers;
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
        $pagetitle = "Admin | Socials";
        $socials = Socials::all();
        return view('admin.socials.index', compact('socials', 'pagetitle'));
    }

    public function create()
    {
        $pagetitle = "Admin | Create Social";
        return view('admin.socials.create', compact('pagetitle'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'platform' => 'required|string|max:255',
            'url' => 'required|url',
            'icon' => 'required|string|max:255',
        ]);

        $social = Socials::create($request->all());
        return back()->with('success', 'Social created successfully');
    }

    public function edit(Socials $socials)
    {
        $pagetitle = "Admin | Edit Social";
        return view('admin.socials.edit', compact('socials', 'pagetitle'));
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
        return back()->with('success', 'Social updated successfully');
    }

    public function destroy(Socials $socials)
    {
        $socials->delete();
        return back()->with('success', 'Social deleted successfully');
    }
}
