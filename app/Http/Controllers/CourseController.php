<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->paginate(5);
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'duration_week' => 'required|integer',
            'description' => 'required|string',
            'instrument_name' => 'required|string',
            'course_level' => 'required|string',
            'payment' => 'required|integer',
            'instrument_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validated['user_id'] = Auth::id();

        if ($request->hasFile('instrument_image')) {
            $validated['instrument_image'] = $request->file('instrument_image')
                ->store('courses', 'public');
        }

        $course = Course::create($validated);

        return redirect("/courses/" . $course->id . "/topics/create")->with('success', 'Course created successfully!');
    }

    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'duration_week' => 'required|integer',
            'description' => 'required|string',
            'instrument_name' => 'required|string',
            'course_level' => 'required|string',
            'payment' => 'required|integer',
            'instrument_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('instrument_image')) {
            $validated['instrument_image'] = $request->file('instrument_image')
                ->store('courses', 'public');
        }

        $course->update($validated);

        return redirect('/courses')
            ->with('success', 'Course updated successfully!');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect("/courses/" . $course->id)
            ->with('success', 'Course deleted successfully!');
    }
}
