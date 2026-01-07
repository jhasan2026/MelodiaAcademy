<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssignedCourse;
use App\Models\Course;
use App\Models\Instructor;

class AssignedCourseController extends Controller
{
    public function index()
    {
        $assignedCourses = AssignedCourse::with(['course', 'instructor.user'])
            ->paginate(10);

        return view('assigned_courses.index', compact('assignedCourses'));
    }

    public function create()
    {
        $courses = Course::all();
        $instructors = Instructor::with('user')->get();

        return view('assigned_courses.create', compact('courses', 'instructors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id'     => 'required|exists:courses,id',
            'instructor_id' => 'required|exists:instructors,id',
        ]);

        AssignedCourse::create([
            'course_id'     => $request->course_id,
            'instructor_id' => $request->instructor_id,
        ]);

        return redirect()
            ->to(url()->current())
            ->with('success', 'Course assigned successfully.');
    }

    public function edit(AssignedCourse $assignedCourse)
    {
        $courses = Course::all();
        $instructors = Instructor::with('user')->get();

        return view(
            'assigned_courses.edit',
            compact('assignedCourse', 'courses', 'instructors')
        );
    }

    public function update(Request $request, AssignedCourse $assignedCourse)
    {
        $request->validate([
            'course_id'     => 'required|exists:courses,id',
            'instructor_id' => 'required|exists:instructors,id',
        ]);

        $assignedCourse->update([
            'course_id'     => $request->course_id,
            'instructor_id' => $request->instructor_id,
        ]);

        return redirect()
            ->route('assigned-courses.index')
            ->with('success', 'Assigned course updated successfully.');
    }

    public function destroy(AssignedCourse $assignedCourse)
    {
        $assignedCourse->delete();

        return redirect()
            ->route('assigned-courses.index')
            ->with('success', 'Assigned course deleted successfully.');
    }
}
