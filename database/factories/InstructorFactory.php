<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Instructor;
use App\Models\User;

class InstructorFactory extends Factory
{
    protected $model = Instructor::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // creates a user if none provided
            'bio' => $this->faker->paragraph(),
            'specialization' => $this->faker->words(3, true),
            'experience_years' => $this->faker->numberBetween(1, 20),
            'profile_pic' => 'images/default.png', // default profile picture
        ];
    }
}
