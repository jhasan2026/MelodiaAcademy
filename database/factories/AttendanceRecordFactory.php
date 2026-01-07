<?php

namespace Database\Factories;

use App\Models\AttendanceSession;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AttendanceRecord>
 */
class AttendanceRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'attendance_session_id' => AttendanceSession::factory(),
            'student_id' => Student::factory(),
            'status' => $this->faker->randomElement(['present','absent','late','excused']),
            'check_in_time' => $this->faker->optional()->time('H:i'),
            'remark' => $this->faker->optional()->sentence(),
        ];
    }
}
