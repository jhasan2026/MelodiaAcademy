<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::view("/",'dashboard');

Route::controller(CourseController::class)->group(function (){
   Route::get('/courses','index');
   Route::get('/courses/create','create');
   Route::get('/courses/{course}','show');
   Route::post('/courses/','store')
        ->middleware('auth');

   Route::get('/courses/{course}/edit','edit')
        ->middleware('auth');

   Route::patch('/courses/{course}','update')
        ->middleware('auth');

   Route::patch('/courses/{course}','destroy')
       ->middleware('auth');

});

Route::get('/register', [RegisterUserController::class, 'create']);
Route::post('/register', [RegisterUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);

Route::view("/contact-us",'contact-us');


