<?php

namespace App\Http\Controllers\Api;
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
        $resume = Resume::where('id', 1)->first();
        return response()->json($resume);
    }

    public function update(Request $request)
    {
        $resume = Resume::where('id', 1)->first();
        $resume->update($request->all());
        return response()->json(['message' => 'Resume updated successfully', 'resume' => $resume], 200);
    }
}
