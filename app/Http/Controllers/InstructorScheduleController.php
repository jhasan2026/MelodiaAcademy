<?php

namespace App\Http\Controllers;

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
        $instructor = $request->user(); // instructor user

        $start = $request->query('start')
            ? Carbon::parse($request->query('start'))
            : now()->startOfWeek();

        $end = $request->query('end')
            ? Carbon::parse($request->query('end'))
            : now()->endOfWeek();

        // Courses assigned to this instructor (courses.user_id)
        $courses = \App\Models\Course::query()
            ->where('user_id', $instructor->id)
            ->with('schedules')
            ->get();

        $events = [];

        foreach ($courses as $course) {
            foreach ($course->schedules as $slot) {
                $slotDate = $start->copy()
                    ->startOfWeek(Carbon::SUNDAY)
                    ->addDays((int) $slot->day_of_week);

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
