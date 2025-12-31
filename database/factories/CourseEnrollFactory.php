<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CourseEnroll>
 */
class CourseEnrollFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'course_id'     => Course::inRandomOrder()->first()->id,
            'student_id'    => 1, // default, overridden in seeder
            'enroll_status' => $this->faker->randomElement(['pending', 'accepted', 'rejected']),
        ];
    }
}
