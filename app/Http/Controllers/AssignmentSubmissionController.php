<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AssignmentSubmissionController extends Controller
{
    public function submit(Request $request, Assignment $assignment)
    {
        abort_unless($assignment->is_published, 404);

        if ($assignment->due_at && now()->gt($assignment->due_at) && !$assignment->allow_late) {
            return back()->withErrors(['due' => 'Submission closed (deadline passed).']);
        }

        $submission = AssignmentSubmission::firstOrCreate(
            ['assignment_id' => $assignment->id, 'student_id' => Auth::id()],
            []
        );

        if ($submission->submitted_at && !$assignment->allow_resubmit) {
            return back()->withErrors(['resubmit' => 'Resubmission is not allowed.']);
        }

        if ($assignment->type === 'quiz') {
            $assignment->load('questions');

            $answers = $request->input('answers', []);
            $submission->answers = $answers;
            $submission->submitted_at = now();

            if ($assignment->auto_grade) {
                $score = 0;
                foreach ($assignment->questions as $q) {
                    $given = (string)($answers[$q->id] ?? '');
                    $correct = (string)($q->correct_answer ?? '');
                    $isCorrect = $correct !== '' && trim(mb_strtolower($given)) === trim(mb_strtolower($correct));
                    if ($isCorrect) $score += (int)$q->points;
                }
                $submission->score = $score;
                $submission->graded_at = now();
            }

            $submission->save();
            return back()->with('success', 'Quiz submitted.');
        }

        $allowedMimes = $assignment->allowed_mimes ?: ['audio/mpeg','audio/wav','audio/mp4','audio/x-m4a','audio/m4a'];
        $maxKb = $assignment->max_file_mb * 1024;

        $data = $request->validate([
            'audio' => ['required','file',"max:$maxKb", 'mimetypes:'.implode(',', $allowedMimes)],
        ]);

        $file = $data['audio'];
        $path = $file->store("assignments/{$assignment->id}/submissions/".Auth::id(), 'public');

        if ($submission->audio_path) {
            Storage::disk('public')->delete($submission->audio_path);
        }

        $submission->audio_path = $path;
        $submission->audio_original_name = $file->getClientOriginalName();
        $submission->audio_size_bytes = $file->getSize();
        $submission->audio_mime = $file->getMimeType();
        $submission->submitted_at = now();
        $submission->save();

        return back()->with('success', 'Recording submitted.');
    }

    public function grade(Request $request, Assignment $assignment, AssignmentSubmission $submission)
    {
        abort_unless($submission->assignment_id === $assignment->id, 404);

        $data = $request->validate([
            'score' => ['nullable','integer','min:0','max:'.$assignment->max_score],
            'feedback' => ['nullable','string'],
        ]);

        $submission->score = $data['score'] ?? $submission->score;
        $submission->feedback = $data['feedback'] ?? $submission->feedback;
        $submission->graded_at = now();
        $submission->save();

        return back()->with('success', 'Submission graded.');
    }
}
