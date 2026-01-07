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
        $courses = Course::query()->count()
            ? Course::query()->inRandomOrder()->limit(5)->get()
            : Course::factory()->count(5)->create();

        foreach ($courses as $course) {
            LessonMaterial::factory()
                ->count(rand(3, 10))
                ->create([
                    'course_id' => $course->id,
                ]);
        }
    }
}
