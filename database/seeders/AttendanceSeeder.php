<?php

namespace Database\Seeders;

use App\Models\AttendanceRecord;
use App\Models\AttendanceSession;
use App\Models\Course;
use App\Models\CourseEnroll;
use App\Models\AssignedCourse;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Instructor
        $instructor = User::factory()->create([
            'email' => 'instructor@test.com',
        ]);

        // Course
        $course = Course::factory()->create();

        // Assign course to instructor
        AssignedCourse::create([
            'course_id' => $course->id,
            'instructor_id' => $instructor->id,
        ]);

        // Students
        $students = Student::factory(20)->create();

        // Enroll students
        foreach ($students as $student) {
            CourseEnroll::create([
                'course_id' => $course->id,
                'student_id' => $student->id,
                'enroll_status' => 'approved',
            ]);
        }

        // Attendance sessions (last 5 days)
        for ($i = 0; $i < 5; $i++) {
            $session = AttendanceSession::create([
                'course_id' => $course->id,
                'attendance_date' => now()->subDays($i)->toDateString(),
                'marked_by' => $instructor->id,
            ]);

            foreach ($students as $student) {
                AttendanceRecord::create([
                    'attendance_session_id' => $session->id,
                    'student_id' => $student->id,
                    'status' => collect(['present','absent','late'])->random(),
                ]);
            }
        }
    }
}
