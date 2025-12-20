<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;

class CoursePolicy
{
    /**
     * Create a new policy instance.
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function edit(User $user): bool
    {
        return $user->role === 'admin';
    }
}
