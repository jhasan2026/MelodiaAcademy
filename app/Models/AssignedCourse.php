<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignedCourse extends Model
{
    /** @use HasFactory<\Database\Factories\AssignedCourseFactory> */
    use HasFactory;
    protected $fillable = [
        'course_id',
        'instructor_id',
    ];

    // Relation to Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Relation to Instructor (User model)
    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }
}
