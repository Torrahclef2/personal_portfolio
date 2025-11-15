<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeDetailController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\SocialsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/admin', [AuthController::class, 'loginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
// Route::post('/register', [AuthController::class, 'register']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');
// Route::get('/user', [AuthController::class, 'dashboard']);

// auth()
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard',[AuthController::class, 'dashboard'])->name('admin.dashboard');

    // Blog routes
    Route::get('/admin/blog',[BlogController::class, 'index'])->name('admin.blog');
    Route::get('/admin/blog/create',[BlogController::class, 'create'])->name('admin.blog.create');
    Route::post('/admin/blog/store',[BlogController::class, 'store'])->name('admin.blog.store');
    Route::get('/admin/blog/edit/{blog}',[BlogController::class, 'edit'])->name('admin.blog.edit');
    Route::put('/admin/blog/update/{blog}',[BlogController::class, 'update'])->name('admin.blog.update');
    Route::delete('/admin/blog/delete/{blog}',[BlogController::class, 'destroy'])->name('admin.blog.destroy');

    // Projects routes
    Route::get('/admin/projects',[ProjectController::class, 'index'])->name('admin.projects');
    Route::get('/admin/projects/create',[ProjectController::class, 'create'])->name('admin.projects.create');
    Route::post('/admin/projects/store',[ProjectController::class, 'store'])->name('admin.projects.store');
    Route::get('/admin/projects/edit/{project}',[ProjectController::class, 'edit'])->name('admin.projects.edit');
    Route::put('/admin/projects/update/{project}',[ProjectController::class, 'update'])->name('admin.projects.update');
    Route::delete('/admin/projects/delete/{project}',[ProjectController::class, 'destroy'])->name('admin.projects.destroy');

    Route::resource('services', ServicesController::class);
    Route::resource('socials', SocialsController::class);
    Route::resource('home-details', HomeDetailController::class)->only(['index', 'edit', 'update']);
    Route::resource('resume', ResumeController::class)->only(['index', 'edit', 'update']);
    Route::resource('contact', ContactController::class)->only(['index', 'edit', 'update']);
});
