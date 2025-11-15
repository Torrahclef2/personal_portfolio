<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Models\Resume;
use Illuminate\Http\Request;

class ResumeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pagetitle = "Admin | Edit Resume";
        $resume = Resume::where('id', 1)->first();
        return view('admin.resume.edit', compact('resume', 'pagetitle'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
        'full_name' => 'required|string|max:255',
        'job_title' => 'required|string|max:255',
        'summary' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'email' => 'required|email|max:255',
        'phone_number' => 'required|string|max:20',
        'address' => 'required|string|max:255',
        'cv_link' => 'nullable|url|max:255',
        'linkedin_link' => 'nullable|url|max:255',
        'github_link' => 'nullable|url|max:255',
        'age' => 'required|string|max:255',
        'total_experience' => 'required|string|max:255',
        'education' => 'required|string|max:255',
        'total_project' => 'required|integer',
        'total_clients' => 'required|integer',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/uploads/resume');
            $validatedData['image'] = basename($imagePath);
        }
        else {
            $validatedData['image'] = Resume::where('id', 1)->first()->image;
        }
        $resume = Resume::where('id', 1)->first();
        $resume->update($request->all());
        return back()->with('success', 'Resume updated successfully');
    }
}
