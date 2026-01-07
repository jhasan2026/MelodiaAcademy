<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\AssignmentQuestion;
use App\Models\LessonMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AssignmentController extends Controller
{
    public function create(LessonMaterial $lesson)
    {
        // If you have Course model relationship:
        $course = $lesson->course ?? null;

        return view('assignments.create', [
            'lesson' => $lesson,
            'course' => $course, // optional, but convenient
        ]);
    }

    public function store(Request $request, LessonMaterial $lesson)
    {
        $data = $request->validate([
            'title' => ['required','string','max:255'],
            'description' => ['nullable','string'],
            'type' => ['required','in:quiz,audio'],

            'due_at' => ['nullable','date'],
            'max_score' => ['required','integer','min:1','max:1000'],
            'allow_late' => ['nullable'],
            'allow_resubmit' => ['nullable'],

            // quiz
            'auto_grade' => ['nullable'],
            'time_limit_minutes' => ['nullable','integer','min:1','max:300'],
            'attempt_limit' => ['nullable','integer','min:1','max:20'],
            'questions' => ['nullable','array'],
            'questions.*.id' => ['nullable','integer'],
            'questions.*.prompt' => ['required_with:questions','string','max:2000'],
            'questions.*.type' => ['required_with:questions','in:mcq,tf,short'],
            'questions.*.points' => ['required_with:questions','integer','min:1','max:100'],
            'questions.*.options_text' => ['nullable','string'],
            'questions.*.correct_answer' => ['nullable','string','max:2000'],

            // audio
            'max_file_mb' => ['nullable','integer','min:1','max:500'],
            'allowed_mimes' => ['nullable','array'],
            'allowed_mimes.*' => ['string'],
        ]);

        return DB::transaction(function () use ($data, $lesson) {

            $assignment = Assignment::create([
                'lesson_id' => $lesson->id,
                'created_by' => Auth::id(),

                'title' => $data['title'],
                'description' => $data['description'] ?? null,
                'type' => $data['type'],

                'due_at' => $data['due_at'] ?? null,
                'max_score' => (int)($data['max_score'] ?? 100),

                'allow_late' => (bool)($data['allow_late'] ?? false),
                'allow_resubmit' => (bool)($data['allow_resubmit'] ?? false),

                'is_published' => false,

                // quiz
                'auto_grade' => (bool)($data['auto_grade'] ?? true),
                'time_limit_minutes' => $data['time_limit_minutes'] ?? null,
                'attempt_limit' => $data['attempt_limit'] ?? null,

                // audio
                'max_file_mb' => (int)($data['max_file_mb'] ?? 30),
                'allowed_mimes' => $data['allowed_mimes'] ?? null,
            ]);

            if ($assignment->type === 'quiz') {
                $questions = $data['questions'] ?? [];

                // If you want to require at least 1 question:
                // abort_if(count($questions) === 0, 422, 'Add at least one question');

                $rows = [];
                foreach ($questions as $q) {
                    $rows[] = [
                        'prompt' => $q['prompt'],
                        'type' => $q['type'],
                        'points' => (int)($q['points'] ?? 1),
                        'options_text' => $q['options_text'] ?? null,
                        'correct_answer' => $q['correct_answer'] ?? null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                if (count($rows)) {
                    $assignment->questions()->createMany($rows);
                }
            }

            return redirect()
                ->route('assignments.show', $assignment)
                ->with('success', 'Assignment created successfully!');
        });
    }

    public function edit(Assignment $assignment)
    {
        $assignment->load('questions');
        return view('assignments.edit', compact('assignment'));
    }

    public function update(Request $request, Assignment $assignment)
    {
        $data = $request->validate([
            'title' => ['required','string','max:255'],
            'description' => ['nullable','string'],
            'due_at' => ['nullable','date'],
            'allow_late' => ['sometimes','boolean'],
            'allow_resubmit' => ['sometimes','boolean'],
            'max_score' => ['required','integer','min:1'],

            'time_limit_minutes' => ['nullable','integer','min:1'],
            'attempt_limit' => ['nullable','integer','min:1'],
            'auto_grade' => ['sometimes','boolean'],

            'max_file_mb' => ['nullable','integer','min:1','max:500'],
            'allowed_mimes' => ['nullable','array'],
            'allowed_mimes.*' => ['string'],
        ]);

        $assignment->update([
            ...$data,
            'allow_late' => (bool)($data['allow_late'] ?? false),
            'allow_resubmit' => (bool)($data['allow_resubmit'] ?? false),
            'auto_grade' => (bool)($data['auto_grade'] ?? $assignment->auto_grade),
        ]);

        return back()->with('success', 'Assignment updated.');
    }

    public function publish(Assignment $assignment)
    {
        $assignment->update(['is_published' => true]);
        return back()->with('success', 'Assignment published.');
    }

    public function show(Assignment $assignment)
    {
//        abort_unless($assignment->is_published, 404);

        $assignment->load('questions');

        $submission = $assignment->submissions()
            ->where('student_id', Auth::id())
            ->first();

        return view('assignments.show', compact('assignment','submission'));
    }

    public function submissions(Assignment $assignment)
    {
        $assignment->load(['submissions.student', 'questions']);
        return view('assignments.submissions', compact('assignment'));
    }
}
