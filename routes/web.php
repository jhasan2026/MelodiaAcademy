<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseEnrollController;
use App\Http\Controllers\CourseTopicController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionController;
use App\Models\Course;
use Illuminate\Support\Facades\Route;

//-------------------------------------------------------------Dashboard---------------------------------------------------------------------------
Route::view("/",'dashboard');


//-------------------------------------------------------------Courses---------------------------------------------------------------------------

Route::controller(CourseController::class)->group(function () {
    // 🔒 Protected routes (auth required)
    Route::middleware('auth')->group(function () {
        Route::get('/courses/create', 'create')
            ->can('create', Course::class);

        Route::post('/courses', 'store');

        Route::get('/courses/{course}/edit', 'edit')
            ->name('courses.edit')
            ->can('edit', Course::class);


        Route::patch('/courses/{course}', 'update');

        Route::delete('/courses/{course}', 'destroy')->name('courses.destroy');
    });

    // ✅ Public routes
    Route::get('/courses', 'index')
        ->name('courses.index');
    Route::get('/courses/{course}', 'show')
        ->name("courses.show");

});


//-------------------------------------------------------------Course Enroll---------------------------------------------------------------------------

Route::get('/courses/{course}/enroll', [CourseEnrollController::class, 'create'])
    ->name('course-enroll.create')
    ->middleware('auth');


Route::post('/courses/{course}/enroll', [CourseEnrollController::class, 'store'])
    ->name('course-enroll.store')
    ->middleware('auth');


//-------------------------------------------------------------My Courses---------------------------------------------------------------------------

Route::get('/my_course',[CourseEnrollController::class,'index'])
    ->name("course-enroll.index");


//---------------------------------------------------------------Student Enrolment-------------------------------------------------

Route::get('/student_enrolment',[CourseEnrollController::class,'enroll'])
    ->name("course-enroll.enrolment");

Route::patch('/course-enroll/{courseEnroll}/approve', [CourseEnrollController::class, 'approve'])
    ->name('course-enroll.approve');

Route::patch('/course-enroll/{courseEnroll}/reject', [CourseEnrollController::class, 'reject'])
    ->name('course-enroll.reject');

//-------------------------------------------------------------Course Topic---------------------------------------------------------------------------
Route::get('/courses/{course}/topics/create', [CourseTopicController::class, 'create'])
    ->name('topics.create');
Route::post('/courses/{course}/topics', [CourseTopicController::class, 'store'])
    ->name('topics.store');


//-------------------------------------------------------------Register---------------------------------------------------------------------------
Route::get('/register', [RegisterUserController::class, 'create']);
Route::post('/register', [RegisterUserController::class, 'store']);


//-------------------------------------------------------------Login---------------------------------------------------------------------------
Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);

Route::post('/logout', [SessionController::class, 'destroy']);




//-----------------------------------------------------------Profile--------------------------------------------------------------

Route::middleware(['auth'])->group(function () {
    // View profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

    // Update profile form
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    // Update profile submit
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});


Route::view("/contact-us",'contact-us');


