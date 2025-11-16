<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Models\HomeDetail;
use Illuminate\Http\Request;

class HomeDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pagetitle = "Admin | Home Detail";
       $homeDetail= HomeDetail::where('id',1)->first();
       return view('admin.home-details', compact('homeDetail', 'pagetitle'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'title' => 'required',
            'subtitle' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'description' => 'required',
            'button_text' => 'required',
            'button_link' => 'required|url',
        ]);
        $home = HomeDetail::where('id', 1)->first();

        if ($request->hasFile('image')) {
            if ($home->image) {
                $oldImagePath = public_path('uploads/home/' . $home->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $image      = $request->file('image');
            $imageName  = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('uploads/home'), $imageName);
            $validatedData['image'] = $imageName;
        }else {
            $validatedData['image'] = HomeDetail::where('id', 1)->first()->image;
        }
        $home->update($validatedData);  
       return back()->with('success', 'Home Detail updated successfully');
    }

}
