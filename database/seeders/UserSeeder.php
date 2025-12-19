<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'role' => 'admin',
            'first_name'  => 'dummy',
            'last_name' => 'dummy',
            'email' => 'admin@gmail.com',
            'password' => 'admin1234',
        ]);
        User::factory()->create([
            'role' => 'instructor',
            'first_name'  => 'dummy',
            'last_name' => 'dummy',
            'email' => 'instructor@gmail.com',
            'password' => 'instructor1234',
        ]);
        User::factory()->create([
            'role' => 'student',
            'first_name'  => 'dummy',
            'last_name' => 'dummy',
            'email' => 'student@gmail.com',
            'password' => 'student1234',
        ]);
        User::factory(10)->create();

    }
}
