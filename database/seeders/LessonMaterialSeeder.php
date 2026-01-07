<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\LessonMaterial;
use Illuminate\Database\Seeder;

class LessonMaterialSeeder extends Seeder
{
    public function run(): void
    {

        Course::all()->each(function ($course) {
            if ($course->lessonMaterials()->count() === 0) {
                LessonMaterial::factory()
                    ->count(rand(3, 6))
                    ->create(['course_id' => $course->id]);
            }
        });

    }
}
