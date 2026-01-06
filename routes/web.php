<?php

use App\Http\Controllers\AssignedCourseController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseEnrollController;
use App\Http\Controllers\CourseTopicController;
use App\Http\Controllers\InstructorAssignedCourse;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionController;
use App\Models\Course;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseCommentController;

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

//---------------------------------------comments---------------------------------------------
Route::middleware('auth')->group(function () {
    Route::post('/courses/{course}/comments', [CourseCommentController::class, 'store'])
        ->name('courses.comments.store');

    Route::put('/comments/{comment}', [CourseCommentController::class, 'update'])
        ->name('comments.update');

    Route::delete('/comments/{comment}', [CourseCommentController::class, 'destroy'])
        ->name('comments.destroy');
});


Route::controller(CourseEnrollController::class)->group(function () {

    // 🔒 Auth required routes
    Route::middleware('auth')->group(function () {

        //-------------------------------------------------------------
        // Course Enroll
        //-------------------------------------------------------------
        Route::get('/courses/{course}/enroll', 'create')
            ->name('course-enroll.create');

        Route::post('/courses/{course}/enroll', 'store')
            ->name('course-enroll.store');

        //-------------------------------------------------------------
        // My Courses
        //-------------------------------------------------------------
        Route::get('/my_course', 'index')
            ->name('course-enroll.index');

        Route::get('my_course/{course}', 'show')
            ->name('course-enroll.show');

        //-------------------------------------------------------------
        // Student Enrolment (Admin/Teacher)
        //-------------------------------------------------------------
        Route::get('/student_enrolment', 'enroll')
            ->name('course-enroll.enrolment');

        Route::patch('/course-enroll/{courseEnroll}/approve', 'approve')
            ->name('course-enroll.approve');

        Route::patch('/course-enroll/{courseEnroll}/reject', 'reject')
            ->name('course-enroll.reject');
    });

});


Route::middleware(['auth'])->group(function () {
    Route::get('/assigned-courses', [AssignedCourseController::class, 'index'])->name('assigned-courses.index');
    Route::get('/assigned-courses/create', [AssignedCourseController::class, 'create'])->name('assigned-courses.create');
    Route::post('/assigned-courses', [AssignedCourseController::class, 'store'])->name('assigned-courses.store');
    Route::get('/assigned-courses/{assignedCourse}/edit', [AssignedCourseController::class, 'edit'])->name('assigned-courses.edit');
    Route::put('/assigned-courses/{assignedCourse}', [AssignedCourseController::class, 'update'])->name('assigned-courses.update');
    Route::delete('/assigned-courses/{assignedCourse}', [AssignedCourseController::class, 'destroy'])->name('assigned-courses.destroy');
});

Route::get("/instructor_assigned_courses", [InstructorAssignedCourse::class,'index'])
    ->name("instructor_assigned_courses.index");

Route::get("/instructor_assigned_courses/{course}", [InstructorAssignedCourse::class,'show'])
    ->name("instructor_assigned_courses.show");

// routes/web.php

Route::middleware('auth')->group(function () {
    Route::get(
        '/instructor_assigned_courses/{course}/students',
        [InstructorAssignedCourse::class, 'students']
    )->name('instructor.courses.students');
});





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


