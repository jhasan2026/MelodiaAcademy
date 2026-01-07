<?php

namespace Database\Factories;

use App\Models\AssignmentQuestion;
use App\Models\Assignment;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssignmentQuestionFactory extends Factory
{
    protected $model = AssignmentQuestion::class;

    public function definition(): array
    {
        $qType = $this->faker->randomElement(['mcq', 'tf', 'short']);

        // Since your DB does NOT have options_text, we won't store options at all.
        $correct = match ($qType) {
            'tf' => $this->faker->randomElement(['true', 'false']),
            default => null, // keep null for mcq/short unless you add a column later
        };

        return [
            'assignment_id' => Assignment::factory(), // overridden in seeder
            'prompt' => $this->faker->sentence(10),
            'type' => $qType,
            'correct_answer' => $this->faker->boolean(70) ? $correct : null,
            'points' => $this->faker->numberBetween(1, 5),
        ];
    }
}
