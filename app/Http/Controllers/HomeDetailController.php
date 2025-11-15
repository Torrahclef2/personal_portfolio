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
       $home= HomeDetail::where('id',1)->first();
       return view('admin.homedetail.edit', compact('home', 'pagetitle'));
    }

    public function update(Request $request)
    {
        $homedetail= HomeDetail::where('id',1)->first();
        if($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/uploads/homedetail');
            $request->merge(['image' => basename($imagePath)]);
        }else{
            $request->merge(['image' => $homedetail->image]);
        }

       
       $homedetail->update($request->all());
       return back()->with('success', 'Home Detail updated successfully');
    }

}
