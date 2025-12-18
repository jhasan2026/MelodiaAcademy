<?php

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::view("/",'dashboard');

Route::controller(CourseController::class)->group(function (){
   Route::get('/courses','index');
   Route::get('/courses/create','create');
   Route::get('/courses/{course}','show');
   Route::post('/courses/','store');

});

Route::view("/contact-us",'contact-us');


