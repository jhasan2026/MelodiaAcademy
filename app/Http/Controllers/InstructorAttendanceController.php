<?php

namespace App\Http\Controllers;
use App\Models\AttendanceRecord;
use App\Models\AttendanceSession;
use App\Models\AssignedCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstructorAttendanceController extends Controller
{
    public function index(Request $request, AssignedCourse $assignedCourse)
    {

        $date = $request->date ? date('Y-m-d', strtotime($request->date)) : now()->toDateString();

        $course = $assignedCourse->course;

        // ✅ students from your course_enrolls table, only approved
        $students = $course->approvedStudents()
            ->with('user') // 👈 eager load users
            ->orderBy('students.id')
            ->get();


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
            'assignedCourse', 'course', 'students', 'date', 'session', 'existing'
        ));
    }

    public function store(Request $request, AssignedCourse $assignedCourse)
    {

        $course = $assignedCourse->course;

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
            $session = AttendanceSession::updateOrCreate(
                ['course_id' => $course->id, 'attendance_date' => $date],
                ['marked_by' => auth()->id(), 'note' => $validated['note'] ?? null]
            );

            foreach ($validated['attendance'] as $studentId => $row) {
                $studentId = (int)$studentId;
                if (!isset($approvedSet[$studentId])) continue;

                AttendanceRecord::updateOrCreate(
                    ['attendance_session_id' => $session->id, 'student_id' => $studentId],
                    [
                        'status' => $row['status'],
                        'remark' => $row['remark'] ?? null,
                        'check_in_time' => $row['check_in_time'] ?? null,
                    ]
                );
            }
        });

        return redirect()
            ->route('instructor.attendance.index', ['assignedCourse' => $assignedCourse->id, 'date' => $date])
            ->with('success', 'Attendance saved successfully.');
    }
}
