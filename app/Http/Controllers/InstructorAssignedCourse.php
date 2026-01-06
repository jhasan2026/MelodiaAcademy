<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorAssignedCourse extends Controller
{
    public function  index()
    {
        $user = Auth::user();
        $courses = Course::whereHas('assigned_courses', function ($query) use ($user) {
            $query->where('instructor_id', $user->instructor->id);

        })->paginate(5);
        return view('instructor_assigned_course.index', compact('courses'));
    }

    public function show(Course $course)
    {
        return view('instructor_assigned_course.show', compact('course'));

    }

    public function students(Course $course)
    {
        $instructorId = auth()->user()->instructor->id;

        abort_if(
            !$course->assigned_courses()
                ->where('instructor_id', $instructorId)
                ->exists(),
            403
        );

        $enrollments = $course->enrollment()
            ->with('student')
            ->paginate(10);

        return view(
            'instructor_assigned_course.students',
            compact('course', 'enrollments')
        );
    }

}
