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
