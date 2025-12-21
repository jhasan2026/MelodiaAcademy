<?php

namespace Database\Seeders;

use App\Models\Instructor;
use App\Models\Student;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::factory()->create([
            'role' => 'admin',
            'first_name' => 'Dummy',
            'last_name'  => 'Admin',
            'email'      => 'admin@gmail.com',
            'password'   => Hash::make('admin1234'),
            'email_verified_at' => now(),
        ]);

        // Instructor
        User::factory()->create([
            'role' => 'instructor',
            'first_name' => 'Dummy',
            'last_name'  => 'Instructor',
            'email'      => 'instructor@gmail.com',
            'password'   => Hash::make('instructor1234'),
            'email_verified_at' => now(),
        ]);

        // Student
        User::factory()->create([
            'role' => 'student',
            'first_name' => 'Dummy',
            'last_name'  => 'Student',
            'email'      => 'student@gmail.com',
            'password'   => Hash::make('student1234'),
            'email_verified_at' => now(),
        ]);

        // Optional: bulk test users with valid roles
        User::factory()
            ->count(5)
            ->create(['role' => 'student']);

        User::factory()
            ->count(5)
            ->create(['role' => 'instructor']);

        // Create student with profile via factory
        Student::factory()->create([
            'user_id' => 3,
        ]);

        Student::factory()->create([
            'user_id' => 4,
        ]);

        // Create instructor with profile via factory
        Instructor::factory()->create([
            'user_id' => 2,
        ]);

    }
}
