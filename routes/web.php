<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::view("/",'dashboard');


Route::controller(CourseController::class)->group(function () {
    // 🔒 Protected routes (auth required)
    Route::middleware('auth')->group(function () {
        Route::get('/courses/create', 'create');
        Route::post('/courses', 'store');
        Route::get('/courses/{course}/edit', 'edit');
        Route::patch('/courses/{course}', 'update');
        Route::delete('/courses/{course}', 'destroy');
    });

    // ✅ Public routes
    Route::get('/courses', 'index');
    Route::get('/courses/{course}', 'show');



});


Route::get('/register', [RegisterUserController::class, 'create']);
Route::post('/register', [RegisterUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);

Route::post('/logout', [SessionController::class, 'destroy']);



Route::middleware(['auth'])->group(function () {
    // View profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

    // Update profile form
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    // Update profile submit
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});


Route::view("/contact-us",'contact-us');


