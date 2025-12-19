<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseTopicController extends Controller
{
    public function create(Course $course)
    {
        return view('topic.create', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            'topic' => 'required|string|max:255',  // input must be named 'topic'
        ]);

        // Create a new topic related to this course
        $course->course_topic()->create($validated);

        return redirect()->route('topics.create', ['course' => $course->id])
            ->with('success', 'Topic created successfully!');
    }



}
