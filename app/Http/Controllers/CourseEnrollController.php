<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseEnroll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseEnrollController extends Controller
{
    public function create(Course $course)
    {
//        $this->authorize('create', [Course::class, $course]);
        return view("course_enroll.create", compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        $course->enrollment()->create([
            'student_id'   => Auth::user()->student->id,
            'enroll_status'=> 'pending',
        ]);

        return redirect()
            ->route('courses.index')
            ->with('success', 'Enrollment request sent successfully.');
    }

    public function index()
    {
        $user = Auth::user();

        abort_if(!$user || !$user->student, 403);

        $courses = Course::whereHas('enrollment', function ($query) use ($user) {
            $query->where('student_id', $user->student->id)
                ->where('enroll_status', 'approved'); // only approved enrollments
        })
            ->latest()
            ->paginate(5);

        return view('course_enroll.index', compact('courses'));

    }

    public function enroll()
    {
        $course_enrolments =  CourseEnroll::with(['course','student.user'])
            ->orderByRaw("
                CASE enroll_status
                    WHEN 'pending' THEN 1
                    WHEN 'approved' THEN 2
                    WHEN 'rejected' THEN 3
                    ELSE 4
                END
            ")
            ->get();

        return view("course_enroll.enroll", compact('course_enrolments'));
    }

    public function approve(CourseEnroll $courseEnroll)
    {
        if ($courseEnroll->enroll_status !== 'pending') {
            return back()->with('error', 'Enrollment already processed.');
        }

        $courseEnroll->update([
            'enroll_status' => 'approved'
        ]);

        return back()->with('success', 'Enrollment approved successfully.');
    }

    public function reject(CourseEnroll $courseEnroll)
    {
        if ($courseEnroll->enroll_status !== 'pending') {
            return back()->with('error', 'Enrollment already processed.');
        }

        $courseEnroll->update([
            'enroll_status' => 'rejected'
        ]);

        return back()->with('success', 'Enrollment rejected.');
    }



}

