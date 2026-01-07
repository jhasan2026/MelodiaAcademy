<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseEnroll;
use Illuminate\Database\Seeder;

class CourseEnrollSeeder extends Seeder
{
    public function run(): void{
        // Pending
        $pendingCourses = Course::orderBy('id')->take(2)->pluck('id');

        foreach ($pendingCourses as $courseId) {
            CourseEnroll::create([
                'course_id'     => $courseId,
                'student_id'    => 1,
                'enroll_status' => 'pending',
            ]);
        }

        // Approved
        $approvedCourses = Course::orderBy('id')->skip(2)->take(2)->pluck('id');

        foreach ($approvedCourses as $courseId) {
            CourseEnroll::create([
                'course_id'     => $courseId,
                'student_id'    => 1,
                'enroll_status' => 'approved',
            ]);
        }

        // Rejected
        $rejectedCourse = Course::orderBy('id')->skip(4)->take(1)->pluck('id');

        foreach ($rejectedCourse as $courseId) {
            CourseEnroll::create([
                'course_id'     => $courseId,
                'student_id'    => 1,
                'enroll_status' => 'rejected',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | STUDENT 2
        |--------------------------------------------------------------------------
        | Next 5 courses:
        |  - 2 approved
        |  - 3 rejected
        */

        // Approved
        $approvedCoursesStudent2 = Course::orderBy('id')->skip(5)->take(2)->pluck('id');

        foreach ($approvedCoursesStudent2 as $courseId) {
            CourseEnroll::create([
                'course_id'     => $courseId,
                'student_id'    => 2,
                'enroll_status' => 'approved',
            ]);
        }

        // Rejected
        $rejectedCoursesStudent2 = Course::orderBy('id')->skip(7)->take(3)->pluck('id');

        foreach ($rejectedCoursesStudent2 as $courseId) {
            CourseEnroll::create([
                'course_id'     => $courseId,
                'student_id'    => 2,
                'enroll_status' => 'rejected',
            ]);
        }

    }
}
