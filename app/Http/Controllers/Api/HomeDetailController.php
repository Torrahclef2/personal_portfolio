<?php

namespace App\Http\Controllers\Api;
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
       $home= HomeDetail::where('id',1)->first();
       return response()->json($home);
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
       return response()->json(['message'=>'Home Detail updated successfully','homedetail'=>$homedetail],200);
    }

}
