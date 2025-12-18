<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph(),
            'duration_week' => $this->faker->numberBetween(4, 24),
            'instrument_name' => $this->faker->randomElement([
                'Guitar', 'Piano', 'Violin', 'Drums', 'Flute'
            ]),
            'instrument_image' => 'courses/sample' . $this->faker->numberBetween(1, 2) . '.jpg', // fixed
            'rating' => $this->faker->randomFloat(1, 3.5, 5.0),
            'payment' => $this->faker->numberBetween(3000, 15000),
            'room_number' => $this->faker->numberBetween(101, 120),
            'course_level' => $this->faker->randomElement([
                'beginner', 'intermediate', 'advanced'
            ]),
        ];
    }

}
