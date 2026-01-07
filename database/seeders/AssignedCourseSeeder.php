<?php

namespace Database\Seeders;

use App\Models\AssignedCourse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignedCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courseIds = [1, 2];
        $instructorId = 1;

        foreach ($courseIds as $courseId) {
            AssignedCourse::create([
                'course_id' => $courseId,
                'instructor_id' => $instructorId,
            ]);
        }
    }
}

