<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\LessonMaterial;
use Illuminate\Database\Seeder;

class LessonMaterialSeeder extends Seeder
{
    public function run(): void
    {
        // If you already seed courses elsewhere, you can remove this.
        $courseIds = [1, 2, 11];

        $courses = Course::whereIn('id', $courseIds)
            ->inRandomOrder()
            ->limit(5) // optional, max will be 3 anyway
            ->get();

        foreach ($courses as $course) {
            LessonMaterial::factory()
                ->count(rand(3, 10))
                ->create([
                    'course_id' => $course->id,
                ]);
        }

    }
}
