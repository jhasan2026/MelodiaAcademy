<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Seeder;

class InstructorCourseSeeder extends Seeder
{
    public function run(): void
    {
        $instructors = User::orderBy('id')->take(2)->get();
        if ($instructors->isEmpty()) return;

        // Assign only first 6 courses (change number)
        $courses = Course::orderBy('id')->take(6)->get();
        if ($courses->isEmpty()) return;

        foreach ($courses as $i => $course) {
            $instructor = $instructors[$i % $instructors->count()];

            $course->update([
                'user_id' => $instructor->id,
            ]);
        }
    }
}
