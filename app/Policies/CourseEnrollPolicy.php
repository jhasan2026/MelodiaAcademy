<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CourseEnrollPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Course $course): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Course $course): bool
    {
        // Only students can enroll
        if ($user->role !== 'student') {
            return false;
        }

        $student = $user->student;

        // Prevent duplicate enrollment
        return !$course->enrollment()
            ->where('student_id', $student->id)
            ->exists();
    }

    public function store(User $user, Course $course): bool
    {
        // Only students can enroll
        if ($user->role !== 'student') {
            return false;
        }

        $student = $user->student;

        // Prevent duplicate enrollment
        return !$course->enrollment()
            ->where('student_id', $student->id)
            ->exists();
    }


    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Course $course): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Course $course): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Course $course): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Course $course): bool
    {
        return false;
    }
}
