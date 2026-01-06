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
        $coursesForStudent1 = Course::take(2)->pluck('id');

        foreach ($coursesForStudent1 as $courseId) {
            CourseEnroll::create([
                'course_id'     => $courseId,
                'student_id'    => 1,
                'enroll_status' => 'pending',
            ]);
        }

        $coursesForStudent1 = Course::skip(2)->take(2)->pluck('id');

        foreach ($coursesForStudent1 as $courseId) {
            CourseEnroll::create([
                'course_id'     => $courseId,
                'student_id'    => 1,
                'enroll_status' => 'approved',
            ]);
        }

        $coursesForStudent1 = Course::skip(4)->take(1)->pluck('id');

        foreach ($coursesForStudent1 as $courseId) {
            CourseEnroll::create([
                'course_id'     => $courseId,
                'student_id'    => 1,
                'enroll_status' => 'rejected',
            ]);
        }




        // student_id = 2 → next 5 courses
        $coursesForStudent2 = Course::skip(5)->take(2)->pluck('id');

        foreach ($coursesForStudent2 as $courseId) {
            CourseEnroll::create([
                'course_id'     => $courseId,
                'student_id'    => 2,
                'enroll_status' => 'approved',
            ]);
        }
        $coursesForStudent3 = Course::skip(7)->take(3)->pluck('id');

        foreach ($coursesForStudent2 as $courseId) {
            CourseEnroll::create([
                'course_id'     => $courseId,
                'student_id'    => 2,
                'enroll_status' => 'rejected',
            ]);
        }


    }
}
