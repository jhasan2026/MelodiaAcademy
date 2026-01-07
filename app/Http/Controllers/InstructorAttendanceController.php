<?php

namespace App\Http\Controllers;

use App\Models\AttendanceRecord;
use App\Models\AttendanceSession;
use App\Models\AssignedCourse;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstructorAttendanceController extends Controller
{
    /**
     * Ensure the current user is an instructor and is assigned to this course.
     * (Authorization only — attendance_sessions will use course_id in DB.)
     */
    protected function ensureInstructorAssigned(Course $course): AssignedCourse
    {
        $user = auth()->user();

        abort_unless($user && $user->instructor, 403, 'Instructor profile not found.');

        return AssignedCourse::where('course_id', $course->id)
            ->where('instructor_id', $user->instructor->id)
            ->firstOrFail();
    }

    public function index(Request $request, Course $course)
    {
        // Auth check (instructor must be assigned to this course)
        $assignedCourse = $this->ensureInstructorAssigned($course);

        $date = $request->filled('date')
            ? date('Y-m-d', strtotime($request->date))
            : now()->toDateString();

        $students = $course->approvedStudents()
            ->with('user')
            ->orderBy('students.id')
            ->get();

        // ✅ Use course_id (NOT assigned_course_id)
        $session = AttendanceSession::where('course_id', $course->id)
            ->whereDate('attendance_date', $date)
            ->with('records')
            ->first();

        $existing = [];
        if ($session) {
            foreach ($session->records as $r) {
                $existing[$r->student_id] = [
                    'status' => $r->status,
                    'remark' => $r->remark,
                    'check_in_time' => $r->check_in_time,
                ];
            }
        }

        return view('instructor.attendance.index', compact(
            'course', 'assignedCourse', 'students', 'date', 'session', 'existing'
        ));
    }

    public function store(Request $request, Course $course)
    {
        // Auth check (instructor must be assigned to this course)
        $assignedCourse = $this->ensureInstructorAssigned($course);

        $validated = $request->validate([
            'attendance_date' => ['required', 'date'],
            'note' => ['nullable', 'string', 'max:2000'],
            'attendance' => ['required', 'array'],
            'attendance.*.status' => ['required', 'in:present,absent,late,excused'],
            'attendance.*.remark' => ['nullable', 'string', 'max:1000'],
            'attendance.*.check_in_time' => ['nullable', 'date_format:H:i'],
        ]);

        $date = date('Y-m-d', strtotime($validated['attendance_date']));

        $studentIds = array_map('intval', array_keys($validated['attendance']));

        $approvedIds = $course->approvedStudents()
            ->whereIn('students.id', $studentIds)
            ->pluck('students.id')
            ->all();

        $approvedSet = array_flip($approvedIds);

        DB::transaction(function () use ($course, $date, $validated, $approvedSet) {
            // ✅ Use course_id + attendance_date as the session identity
            $session = AttendanceSession::updateOrCreate(
                [
                    'course_id' => $course->id,
                    'attendance_date' => $date,
                ],
                [
                    'marked_by' => auth()->id(),
                    'note' => $validated['note'] ?? null,
                ]
            );

            foreach ($validated['attendance'] as $studentId => $row) {
                $studentId = (int) $studentId;

                // Only save for approved students
                if (!isset($approvedSet[$studentId])) {
                    continue;
                }

                AttendanceRecord::updateOrCreate(
                    [
                        'attendance_session_id' => $session->id,
                        'student_id' => $studentId,
                    ],
                    [
                        'status' => $row['status'],
                        'remark' => $row['remark'] ?? null,
                        'check_in_time' => $row['check_in_time'] ?? null,
                    ]
                );
            }
        });

        // Redirect wherever you prefer; this is safe and consistent
        return redirect()
            ->back()
            ->with('success', 'Attendance saved successfully.');
    }
}
