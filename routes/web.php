<?php

use App\Http\Controllers\AssignedCourseController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AssignmentSubmissionController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseEnrollController;
use App\Http\Controllers\CourseTopicController;
use App\Http\Controllers\InstructorAssignedCourse;
use App\Http\Controllers\InstructorScheduleController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\LessonMaterialController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StudentScheduleController;
use App\Models\Course;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseCommentController;
use App\Http\Controllers\InstructorAttendanceController;

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
        Route::get('my_course/{course}/materials', 'course_materials')
            ->name('course-enroll.course_materials');

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
    Route::get('/instructor_assigned_courses/{course}/students', [InstructorAssignedCourse::class, 'students']
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


Route::middleware(['auth'])->group(function () {

    Route::get(
        '/instructor_assigned_courses/{course}/attendents', [InstructorAttendanceController::class, 'index']
    )->name('instructor.attendance.index');

    Route::post(
        '/instructor_assigned_courses/{course}/attendents', [InstructorAttendanceController::class, 'store']
    )->name('instructor.attendance.store');

});




Route::prefix('instructor_assigned_courses/{course}')->group(function () {
    Route::get('lesson_materials', [LessonMaterialController::class, 'index'])->name('lesson_materials.index');
    Route::get('lesson_materials/create', [LessonMaterialController::class, 'create'])->name('lesson_materials.create');
    Route::post('lesson_materials', [LessonMaterialController::class, 'store'])->name('lesson_materials.store');

    Route::get('lesson_materials/{lessonMaterial}/edit', [LessonMaterialController::class, 'edit'])->name('lesson_materials.edit');
    Route::put('lesson_materials/{lessonMaterial}', [LessonMaterialController::class, 'update'])->name('lesson_materials.update');
    Route::delete('lesson_materials/{lessonMaterial}', [LessonMaterialController::class, 'destroy'])->name('lesson_materials.destroy');
});




Route::middleware(['auth'])->group(function () {
    Route::get('/lessons/{lesson}/assignments/create', [AssignmentController::class, 'create'])->name('assignments.create');
    Route::post('/lessons/{lesson}/assignments', [AssignmentController::class, 'store'])->name('assignments.store');

    Route::get('/assignments/{assignment}/edit', [AssignmentController::class, 'edit'])->name('assignments.edit');
    Route::put('/assignments/{assignment}', [AssignmentController::class, 'update'])->name('assignments.update');
    Route::post('/assignments/{assignment}/publish', [AssignmentController::class, 'publish'])->name('assignments.publish');

    Route::get('/assignments/{assignment}', [AssignmentController::class, 'show'])->name('assignments.show');
    Route::post('/assignments/{assignment}/submit', [AssignmentSubmissionController::class, 'submit'])->name('assignments.submit');

    // Teacher grading dashboard
    Route::get('/assignments/{assignment}/submissions', [AssignmentController::class, 'submissions'])->name('assignments.submissions');
    Route::post('/assignments/{assignment}/submissions/{submission}/grade', [AssignmentSubmissionController::class, 'grade'])->name('assignments.grade');
});




Route::middleware(['auth'])->group(function () {
    // Student
    Route::get('/student/weekly-routine', [StudentScheduleController::class, 'page'])
        ->name('student.schedule.page');
    Route::get('/api/student/schedule', [StudentScheduleController::class, 'events'])
        ->name('student.schedule.events');

    // Instructor
    Route::get('/instructor/weekly-routine', [InstructorScheduleController::class, 'page'])
        ->name('instructor.schedule.page');
    Route::get('/api/instructor/schedule', [InstructorScheduleController::class, 'events'])
        ->name('instructor.schedule.events');
});


Route::view("/contact-us",'contact-us');


