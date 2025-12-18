<?php

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::view("/",'dashboard');

Route::controller(CourseController::class)->group(function (){
   Route::get('/courses','index');
});

Route::view("/contact-us",'contact-us');


