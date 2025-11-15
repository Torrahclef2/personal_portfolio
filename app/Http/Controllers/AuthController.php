<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use App\Models\Blog;
use App\Models\Project;
use App\Models\Services;

class AuthController extends Controller
{
    public function loginForm()
    {
        $pagetitle = "Admin | Login";
        return view('admin.auth.login', compact('pagetitle'));
    }

    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return redirect()->back()->with('success', 'User registered successfully');
    }


     // Login user
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return back()->with('error', 'Invalid credentials');
        }
            Auth::login($user);
        return redirect()->intended('admin/dashboard')->with('success', 'Logged in successfully');
    }

    // Logout user
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out']);
    }


    public function dashboard()
    {
        $pagetitle = "Admin | Dashboard";
        $totalBlogs = Blog::count();
        $totalProjects = Project::count();
        $totalServices = Services::count();

        $blogs= Blog::latest()->take(3)->get();
        return view('admin.dashboard', compact('pagetitle','blogs', 'totalBlogs', 'totalProjects', 'totalServices'));
    }
}
