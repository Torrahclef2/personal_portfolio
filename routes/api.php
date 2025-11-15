<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;


Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{project}', [ProjectController::class, 'show']);
// Route::post('/projects', [ProjectController::class, 'store']);

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function(Request $request) {
        return $request->user();
    });
      
    // Project routes
    Route::post('/projects/create', [ProjectController::class, 'store']);
    Route::put('/projects/update/{project}', [ProjectController::class, 'update']);
    Route::delete('/projects/delete/{project}', [ProjectController::class, 'destroy']);

    // Social routes
    // Route::apiResource('socials', App\Http\Controllers\Api\SocialsController::class);
    Route::get('/socials', [App\Http\Controllers\Api\SocialsController::class, 'index']);
    Route::get('/socials/{socials}', [App\Http\Controllers\Api\SocialsController::class, 'show']);

    // Services routes
    // Route::apiResource('services', App\Http\Controllers\Api\ServicesController::class);
    Route::get('/services', [App\Http\Controllers\Api\ServicesController::class, 'index']);
    Route::get('/services/{services}', [App\Http\Controllers\Api\ServicesController::class, 'show']);

    //Home Details route
    Route::get('/home-details', [App\Http\Controllers\Api\HomeDetailController::class, 'index']);
    // Route::put('/home-details', [App\Http\Controllers\Api\HomeDetailController::class, 'update']);

    //Blog routes
    // Route::apiResource('blogs', App\Http\Controllers\Api\BlogController::class);
    Route::get('/blogs', [App\Http\Controllers\Api\BlogController::class, 'index']);
    Route::get('/blogs/{blog}', [App\Http\Controllers\Api\BlogController::class, 'show']);

    // Resume route
    Route::get('/resume', [App\Http\Controllers\Api\ResumeController::class, 'index']);
    // Route::put('/resume', [App\Http\Controllers\Api\ResumeController::class, 'update']);

    // Contact route
    Route::get('/contact', [App\Http\Controllers\Api\ContactController::class, 'index']);
    // Route::put('/contact', [App\Http\Controllers\Api\ContactController::class, 'update']);

});