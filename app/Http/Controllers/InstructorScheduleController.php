<?php

namespace App\Http\Controllers;

use App\Models\AssignedCourse;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InstructorScheduleController extends Controller
{
    public function page()
    {
        return view('instructor.schedule');
    }

    public function events(Request $request)
    {
        $user = $request->user();

        // Find instructor id for this user
        // Assumes instructors table has user_id
        $instructor = \App\Models\Instructor::where('user_id', $user->id)->firstOrFail();

        $start = $request->query('start') ? Carbon::parse($request->query('start')) : now()->startOfWeek();
        $end   = $request->query('end')   ? Carbon::parse($request->query('end'))   : now()->endOfWeek();

        // Get assigned courses for this instructor
        $assignedCourses = AssignedCourse::where('instructor_id', $instructor->id)
            ->with(['course.schedules'])
            ->get();

        $events = [];

        foreach ($assignedCourses as $assigned) {
            $course = $assigned->course;

            foreach ($course->schedules as $slot) {
                $slotDate = $start->copy()->startOfWeek(Carbon::SUNDAY)->addDays((int) $slot->day_of_week);

                if ($slot->starts_on && $slotDate->lt($slot->starts_on)) continue;
                if ($slot->ends_on && $slotDate->gt($slot->ends_on)) continue;
                if ($slotDate->lt($start) || $slotDate->gt($end)) continue;

                $startDateTime = Carbon::parse($slotDate->toDateString().' '.$slot->start_time);
                $endDateTime   = Carbon::parse($slotDate->toDateString().' '.$slot->end_time);

                $events[] = [
                    'id'    => $course->id.'-'.$slot->id.'-'.$slotDate->toDateString(),
                    'title' => $course->name,
                    'start' => $startDateTime->toIso8601String(),
                    'end'   => $endDateTime->toIso8601String(),
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
