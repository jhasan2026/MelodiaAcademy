<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseEnroll;
use Illuminate\Database\Seeder;

class CourseEnrollSeeder extends Seeder
{
    public function run(): void
    {
        // Get all course ids once (safe even if < 10)
        $courseIds = Course::orderBy('id')->pluck('id')->values();

        // Helper to assign list of course ids to a student with status
        $assign = function (int $studentId, array $ids, string $status) {
            foreach ($ids as $courseId) {
                CourseEnroll::updateOrCreate(
                    [
                        'student_id' => $studentId,
                        'course_id'  => $courseId,
                    ],
                    [
                        'enroll_status' => $status,
                    ]
                );
            }
        };

        /**
         * STUDENT 1
         * first 5 courses:
         * - 2 pending
         * - 2 approved
         * - 1 rejected
         */
        $assign(1, $courseIds->slice(0, 2)->all(), 'pending');
        $assign(1, $courseIds->slice(2, 2)->all(), 'approved');
        $assign(1, $courseIds->slice(4, 1)->all(), 'rejected');

        /**
         * STUDENT 2
         * next 5 courses:
         * - 2 approved
         * - 3 rejected
         */
        $assign(2, $courseIds->slice(5, 2)->all(), 'approved');
        $assign(2, $courseIds->slice(7, 3)->all(), 'rejected');
    }
}
