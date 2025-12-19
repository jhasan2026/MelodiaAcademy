<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->paginate(5);
        return view('courses.index', [
            'courses' => $courses
        ]);

    }

    public function create(Course $course)
    {
        return view('courses.create');
    }

    public function show(Course $course)
    {
        return view('courses.show', [
            'course' => $course
        ]);

    }

    public function store(Course $course)
    {
        // Validate input
        request()->validate([
            'name' => ['required'],
            'duration_week' => ['required', 'integer'],
            'description' => ['required'],
            'instrument_name' => ['required'],
            'course_level' => ['required'],
            'payment' => ['required', 'integer'],
            'instrument_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Fill model data
        $course->name = request('name');
        $course->duration_week = request('duration_week');
        $course->description = request('description');
        $course->instrument_name = request('instrument_name');
        $course->course_level = request('course_level');
        $course->payment = request('payment');

        // Handle image upload
        if (request()->hasFile('instrument_image')) {
            $course->instrument_image = request()
                ->file('instrument_image')
                ->store('courses', 'public');
        }

        // Save to database
        $course->save();

        return redirect('/courses')->with('success', 'Course created successfully!');
    }

    public function edit(Course $course)
    {
        return view("courses.edit", [
            "course" => $course
        ]);
    }


    public function update(Course $course)
    {
        request()->validate([
            'name' => ['required'],
            'duration_week' => ['required', 'integer'],
            'description' => ['required'],
            'instrument_name' => ['required'],
            'course_level' => ['required'],
            'payment' => ['required', 'integer'],
            'instrument_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Fill model data
        $course->name = request('name');
        $course->duration_week = request('duration_week');
        $course->description = request('description');
        $course->instrument_name = request('instrument_name');
        $course->course_level = request('course_level');
        $course->payment = request('payment');

        // Handle image upload
        if (request()->hasFile('instrument_image')) {
            $course->instrument_image = request()
                ->file('instrument_image')
                ->store('courses', 'public');
        }

        // Save to database
        $course->save();
        $course->update([
            'name' => request('name'),
            'duration_week' => request('duration_week'),
            'description' => request('description'),
            'instrument_name' => request('instrument_name'),
            'course_level' => request('course_level'),
            'payment' => request('payment'),
        ]);

        return redirect("/courses/". $course->id);

    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect("/courses/");
    }




}
