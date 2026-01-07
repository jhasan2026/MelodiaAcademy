<?php

namespace App\Http\Controllers;

use App\Models\AssignedCourse;
use App\Models\Course;
use App\Models\CourseSchedule;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssignedCourseController extends Controller
{
    public function index()
    {
        $assignedCourses = AssignedCourse::with(['course', 'instructor.user'])->paginate(10);
        return view('assigned_courses.index', compact('assignedCourses'));
    }

    public function create()
    {
        $courses = Course::all();
        $instructors = Instructor::with('user')->get();

        return view('assigned_courses.create', compact('courses', 'instructors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id'     => 'required|exists:courses,id',
            'instructor_id' => 'required|exists:instructors,id',

            // timetable fields
            'day_of_week'   => 'required|integer|min:0|max:6',
            'start_time'    => 'required|date_format:H:i',
            'end_time'      => 'required|date_format:H:i|after:start_time',
            'note'          => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($request) {
            AssignedCourse::create([
                'course_id'     => $request->course_id,
                'instructor_id' => $request->instructor_id,
            ]);

            $this->upsertCourseSchedule(
                (int) $request->course_id,
                (int) $request->day_of_week,
                $request->start_time,
                $request->end_time,
                $request->note
            );
        });

        return redirect()
            ->route('assigned-courses.index')
            ->with('success', 'Course assigned successfully with timetable.');
    }

    public function edit(AssignedCourse $assignedCourse)
    {
        $courses = Course::all();
        $instructors = Instructor::with('user')->get();

        // Load existing schedule (first one) for this course
        $schedule = CourseSchedule::where('course_id', $assignedCourse->course_id)
            ->orderBy('id')
            ->first();

        return view('assigned_courses.edit', compact('assignedCourse', 'courses', 'instructors', 'schedule'));
    }

    public function update(Request $request, AssignedCourse $assignedCourse)
    {
        $request->validate([
            'course_id'     => 'required|exists:courses,id',
            'instructor_id' => 'required|exists:instructors,id',

            // timetable fields
            'day_of_week'   => 'required|integer|min:0|max:6',
            'start_time'    => 'required|date_format:H:i',
            'end_time'      => 'required|date_format:H:i|after:start_time',
            'note'          => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($request, $assignedCourse) {
            $assignedCourse->update([
                'course_id'     => $request->course_id,
                'instructor_id' => $request->instructor_id,
            ]);

            $this->upsertCourseSchedule(
                (int) $request->course_id,
                (int) $request->day_of_week,
                $request->start_time,
                $request->end_time,
                $request->note
            );
        });

        return redirect()
            ->route('assigned-courses.index')
            ->with('success', 'Assigned course updated with timetable.');
    }

    public function destroy(AssignedCourse $assignedCourse)
    {
        $assignedCourse->delete();

        return redirect()
            ->route('assigned-courses.index')
            ->with('success', 'Assigned course deleted successfully.');
    }

    /**
     * Simple rule:
     * - If schedule exists for (course_id + day_of_week), update it
     * - Else create it
     */
    private function upsertCourseSchedule(
        int $courseId,
        int $dayOfWeek,
        string $startTime,
        string $endTime,
        ?string $note
    ): void {
        CourseSchedule::updateOrCreate(
            [
                'course_id'   => $courseId,
                'day_of_week' => $dayOfWeek,
            ],
            [
                'start_time' => $startTime . ':00', // store as time
                'end_time'   => $endTime . ':00',
                'note'       => $note,
                'starts_on'  => null,
                'ends_on'    => null,
                'timezone'   => null,
            ]
        );
    }
}
