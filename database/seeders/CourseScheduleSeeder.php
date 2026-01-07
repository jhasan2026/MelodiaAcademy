<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseSchedule;
use Illuminate\Database\Seeder;

class CourseScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $courses = Course::orderBy('id')->get();

        if ($courses->isEmpty()) {
            return;
        }

        /**
         * Simple weekly patterns (0=Sun..6=Sat)
         * We rotate these patterns across courses so they don't all overlap.
         */
        $patterns = [
            // Mon/Wed 10:00-11:00
            [
                ['day' => 1, 'start' => '10:00:00', 'end' => '11:00:00'],
                ['day' => 3, 'start' => '10:00:00', 'end' => '11:00:00'],
            ],
            // Tue/Thu 15:00-16:30
            [
                ['day' => 2, 'start' => '15:00:00', 'end' => '16:30:00'],
                ['day' => 4, 'start' => '15:00:00', 'end' => '16:30:00'],
            ],
            // Sat 09:00-10:30
            [
                ['day' => 6, 'start' => '09:00:00', 'end' => '10:30:00'],
            ],
            // Sun 18:00-19:00
            [
                ['day' => 0, 'start' => '18:00:00', 'end' => '19:00:00'],
            ],
        ];

        foreach ($courses as $i => $course) {
            $pattern = $patterns[$i % count($patterns)];

            foreach ($pattern as $slot) {
                CourseSchedule::updateOrCreate(
                    [
                        'course_id' => $course->id,
                        'day_of_week' => $slot['day'],
                        'start_time' => $slot['start'],
                        'end_time' => $slot['end'],
                    ],
                    [
                        'starts_on' => null,
                        'ends_on' => null,
                        'timezone' => null,
                        'note' => 'Weekly class',
                    ]
                );
            }
        }
    }
}
