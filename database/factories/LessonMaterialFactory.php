<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LessonMaterial>
 */
class LessonMaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'course_id' => Course::factory(), // auto-create course if not provided
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->optional()->paragraph(),
            'file_path' => 'lesson_materials/demo.pdf', // fake file
        ];
    }
}
