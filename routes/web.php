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

// Route::get('/login', [AuthController::class, 'loginForm'])->name('admin.login');
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

    // Services routes
    Route::get('/admin/services',[ServicesController::class, 'index'])->name('admin.services');
    Route::get('/admin/services/create',[ServicesController::class, 'create'])->name('admin.services.create');
    Route::post('/admin/services/store',[ServicesController::class, 'store'])->name('admin.services.store');
    Route::get('/admin/services/edit/{service}',[ServicesController::class, 'edit'])->name('admin.services.edit');
    Route::put('/admin/services/update/{service}',[ServicesController::class, 'update'])->name('admin.services.update');
    Route::delete('/admin/services/delete/{service}',[ServicesController::class, 'destroy'])->name('admin.services.destroy');

    //Update Resume
    Route::get('/admin/resume',[ResumeController::class, 'index'])->name('admin.resumes');
    Route::put('/admin/resume/update',[ResumeController::class, 'update'])->name('admin.resumes.update');

    // Update Contact Info
    Route::get('/admin/contact',[ContactController::class, 'index'])->name('admin.contact');
    Route::put('/admin/contact/update',[ContactController::class, 'update'])->name('admin.contact.update');

    // Update Home Details
    Route::get('/admin/home-details',[HomeDetailController::class, 'index'])->name('admin.home-details');
    Route::put('/admin/home-details/update',[HomeDetailController::class, 'update'])->name('admin.home-details.update');

    // Update Socials
    Route::get('/admin/socials',[SocialsController::class, 'index'])->name('admin.socials');
    Route::post('/admin/socials/store',[SocialsController::class, 'store'])->name('admin.socials.store');
    Route::delete('/admin/socials/delete/{socials}',[SocialsController::class, 'destroy'])->name('admin.socials.destroy');
});
