<?php

namespace Database\Factories;

use App\Models\Assignment;
use App\Models\LessonMaterial;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssignmentFactory extends Factory
{
    protected $model = Assignment::class;

    public function definition(): array
    {
        $type = $this->faker->randomElement(['quiz', 'audio']);

        return [
            'lesson_id' => LessonMaterial::factory(), // will be overridden in seeder
            'created_by' => 1,                        // will be overridden in seeder
            'title' => $type === 'quiz'
                ? $this->faker->randomElement(['Quiz', 'Theory Quiz', 'Practice Quiz']) . ' - ' . $this->faker->word()
                : $this->faker->randomElement(['Recording', 'Audio Task', 'Music Recording']) . ' - ' . $this->faker->word(),
            'description' => $this->faker->optional()->paragraph(),
            'type' => $type,

            'is_published' => $this->faker->boolean(70),
            'due_at' => $this->faker->optional(0.8)->dateTimeBetween('+1 day', '+14 days'),

            'allow_late' => $this->faker->boolean(30),
            'allow_resubmit' => $this->faker->boolean(40),

            'max_score' => $this->faker->numberBetween(10, 100),

            // quiz settings
            'time_limit_minutes' => $type === 'quiz' ? $this->faker->optional(0.7)->numberBetween(5, 45) : null,
            'attempt_limit' => $type === 'quiz' ? $this->faker->optional(0.7)->numberBetween(1, 3) : null,
            'auto_grade' => $type === 'quiz' ? $this->faker->boolean(80) : false,

            // audio settings
            'max_file_mb' => $type === 'audio' ? $this->faker->numberBetween(10, 80) : 0,
            'max_duration_seconds' => $type === 'audio' ? $this->faker->optional(0.7)->numberBetween(30, 300) : null,

            'allowed_mimes' => $type === 'audio' ? ['audio/mpeg', 'audio/wav'] : null,
        ];
    }

    public function quiz(): static
    {
        return $this->state(fn () => [
            'type' => 'quiz',
            'auto_grade' => true,
            'max_file_mb' => 0,
            'max_duration_seconds' => null,
            'allowed_mimes' => null,
        ]);
    }

    public function audio(): static
    {
        return $this->state(fn () => [
            'type' => 'audio',
            'auto_grade' => false,
            'time_limit_minutes' => null,
            'attempt_limit' => null,
        ]);
    }
}
