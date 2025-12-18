<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->paginate(20);
        return view('courses.index', [
            'courses' => $courses
        ]);

    }
}
