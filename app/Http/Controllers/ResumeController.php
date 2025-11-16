<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResumeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pagetitle = "Admin | Edit Resume";
        $resume = Resume::where('id', 1)->first();
        return view('admin.resume', compact('resume', 'pagetitle'));
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

        $resume = Resume::where('id', 1)->first();
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($resume->image) {
                $oldImagePath = public_path('uploads/resume/' . $resume->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $image      = $request->file('image');
            $imageName  = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('uploads/resume'), $imageName);
            $validatedData['image'] = $imageName;
        }
        else {
            $validatedData['image'] = Resume::where('id', 1)->first()->image;
        }
        // $resume = Resume::where('id', 1)->first();
        $resume->update($validatedData);
        return back()->with('success', 'Resume updated successfully');
    }
}
