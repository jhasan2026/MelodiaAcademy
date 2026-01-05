<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CourseCommentController extends Controller
{

    public function store(Request $request, Course $course)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        Comment::create([
            'course_id' => $course->id,
            'user_id'   => Auth::id(),
            'comment'   => $request->comment,
        ]);

        return redirect()
            ->route('courses.show', $course->id)
            ->with('success', 'Comment added successfully.');
    }

    public function edit(Comment $comment)
    {
        // Authorization
        if (auth()->id() !== $comment->user_id) {
            abort(403);
        }

        return view('courses.show', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        if (auth()->id() !== $comment->user_id) {
            abort(403);
        }

        $validated = $request->validate([
            'comment' => 'required|string|max:2000',
        ]);

        $comment->update([
            'comment' => $validated['comment'],
        ]);

        return redirect()
            ->back()
            ->with('success', 'Comment updated successfully.');
    }


    public function destroy(Comment $comment)
    {
        // Authorize BEFORE delete
        if ($comment->user_id !== Auth::id()) {
            abort(403);
        }

        // Store parent id
        $courseId = $comment->course_id;

        // Delete
        $comment->delete();

        // Redirect safely
        return redirect()
            ->route('courses.show', $courseId)
            ->with('success', 'Comment removed successfully.');
    }

}
