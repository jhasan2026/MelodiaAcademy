<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseTopic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::factory(10)->create()->each(function ($course) {
            // For each course, create 4 topics
            CourseTopic::factory(4)->create([
                'course_id' => $course->id,
            ]);
        });
    }
}
