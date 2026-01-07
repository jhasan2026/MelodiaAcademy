<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StudentScheduleController extends Controller
{
    public function page()
    {
        return view('student.schedule');
    }

    public function events(Request $request)
    {
        $authUser = $request->user();

        /**
         * IMPORTANT:
         * Your pivot table references App\Models\Student (course_enrolls.student_id),
         * so we must resolve the Student model first.
         */
        if ($authUser instanceof Student) {
            $student = $authUser;
        } else {
            // Most common mapping: students.user_id -> users.id
            $student = Student::where('user_id', $authUser->id)->first();

            // Fallback: if you don't have user_id in students table and ids match
            if (!$student) {
                $student = Student::findOrFail($authUser->id);
            }
        }

        // Calendar sends start/end (ISO). If not provided, use current week.
        $start = $request->query('start')
            ? Carbon::parse($request->query('start'))
            : now()->startOfWeek();

        $end = $request->query('end')
            ? Carbon::parse($request->query('end'))
            : now()->endOfWeek();

        // Pull only approved enrollments (recommended)
        $courses = $student->enrolledCourses()
            ->wherePivot('enroll_status', 'approved') // remove if you want pending too
            ->with('schedules')
            ->get();

        $events = [];

        foreach ($courses as $course) {
            foreach ($course->schedules as $slot) {

                // Build date in the requested week.
                // day_of_week expected 0=Sun..6=Sat
                $slotDate = $start->copy()
                    ->startOfWeek(Carbon::SUNDAY)
                    ->addDays((int) $slot->day_of_week);

                // Optional schedule range filters
                if ($slot->starts_on && $slotDate->lt($slot->starts_on)) continue;
                if ($slot->ends_on && $slotDate->gt($slot->ends_on)) continue;

                // Ensure within requested range
                if ($slotDate->lt($start) || $slotDate->gt($end)) continue;

                $startDateTime = Carbon::parse($slotDate->toDateString() . ' ' . $slot->start_time);
                $endDateTime   = Carbon::parse($slotDate->toDateString() . ' ' . $slot->end_time);

                $events[] = [
                    'id'    => $course->id . '-' . $slot->id . '-' . $slotDate->toDateString(),
                    'title' => $course->name,
                    'start' => $startDateTime->toIso8601String(),
                    'end'   => $endDateTime->toIso8601String(),

                    // optional fields for UI
                    'backgroundColor' => $course->calendar_color ?? null,
                    'borderColor'     => $course->calendar_color ?? null,
                    'extendedProps'   => [
                        'instrument'   => $course->instrument_name,
                        'room_number'  => $course->room_number,
                        'meeting_link' => $course->meeting_link,
                        'note'         => $slot->note ?? null,
                    ],
                ];
            }
        }

        return response()->json($events);
    }
}
