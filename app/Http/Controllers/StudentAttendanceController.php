<?php

// app/Http/Controllers/StudentAttendanceController.php
namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\AttendanceRecord;
use Illuminate\Http\Request;

class StudentAttendanceController extends Controller
{
    private function currentStudent()
    {
        abort_unless(auth()->check(), 403);
        $student = auth()->user()->student;
        abort_unless($student, 403); // user must be linked to student
        return $student;
    }

    // Dashboard: courses + progress
    public function index()
    {
        $student = $this->currentStudent();

        $courses = $student->courses()->get();

        // Build progress per course
        $progress = [];
        foreach ($courses as $course) {
            $records = AttendanceRecord::query()
                ->where('student_id', $student->id)
                ->whereHas('session', fn($q) => $q->where('course_id', $course->id))
                ->select('status')
                ->get();

            $total = $records->count();
            $present = $records->where('status', 'present')->count();
            $late = $records->where('status', 'late')->count();
            $excused = $records->where('status', 'excused')->count();
            $absent = $records->where('status', 'absent')->count();

            // progress formula (you can change):
            // present=1, late=0.75, excused=1, absent=0
            $score = $present + (0.75 * $late) + $excused;
            $percent = $total > 0 ? round(($score / $total) * 100, 1) : 0;

            $progress[$course->id] = compact('total','present','late','excused','absent','percent');
        }

        return view('student.attendance.index', compact('student','courses','progress'));
    }

    // Course attendance detail
    public function show(Request $request, Course $course)
    {
        $student = $this->currentStudent();

        // Ensure student is enrolled (approved)
        $isEnrolled = $student->courses()->where('courses.id', $course->id)->exists();
        abort_unless($isEnrolled, 403);

        $from = $request->from ? date('Y-m-d', strtotime($request->from)) : null;
        $to   = $request->to ? date('Y-m-d', strtotime($request->to)) : null;

        $query = AttendanceRecord::query()
            ->where('student_id', $student->id)
            ->whereHas('session', function ($q) use ($course, $from, $to) {
                $q->where('course_id', $course->id);
                if ($from) $q->whereDate('attendance_date', '>=', $from);
                if ($to) $q->whereDate('attendance_date', '<=', $to);
            })
            ->with(['session' => fn($q) => $q->orderBy('attendance_date', 'desc')])
            ->orderByDesc(
                \App\Models\AttendanceSession::select('attendance_date')
                    ->whereColumn('attendance_sessions.id', 'attendance_records.attendance_session_id')
                    ->limit(1)
            );

        $records = $query->paginate(20);

        // Summary
        $all = AttendanceRecord::query()
            ->where('student_id', $student->id)
            ->whereHas('session', fn($q) => $q->where('course_id', $course->id))
            ->pluck('status');

        $summary = [
            'total' => $all->count(),
            'present' => $all->filter(fn($s) => $s === 'present')->count(),
            'late' => $all->filter(fn($s) => $s === 'late')->count(),
            'excused' => $all->filter(fn($s) => $s === 'excused')->count(),
            'absent' => $all->filter(fn($s) => $s === 'absent')->count(),
        ];

        $score = $summary['present'] + (0.75 * $summary['late']) + $summary['excused'];
        $summary['percent'] = $summary['total'] > 0 ? round(($score / $summary['total']) * 100, 1) : 0;

        return view('student.attendance.show', compact('student','course','records','summary','from','to'));
    }
}
