<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseEnroll;
use Illuminate\Database\Seeder;

class CourseEnrollSeeder extends Seeder
{
    public function run(): void
    {
        // student_id = 1 → first 5 courses
        $coursesForStudent1 = Course::take(5)->pluck('id');

        foreach ($coursesForStudent1 as $courseId) {
            CourseEnroll::create([
                'course_id'     => $courseId,
                'student_id'    => 1,
                'enroll_status' => 'pending',
            ]);
        }

        // student_id = 2 → next 5 courses
        $coursesForStudent2 = Course::skip(5)->take(5)->pluck('id');

        foreach ($coursesForStudent2 as $courseId) {
            CourseEnroll::create([
                'course_id'     => $courseId,
                'student_id'    => 2,
                'enroll_status' => 'pending',
            ]);
        }
    }
}
