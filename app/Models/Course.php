<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Course extends Model
{
    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'duration_week',
        'instrument_name',
        'instrument_image',
        'payment',
        'course_level',
        'enroll_status',
        'student_id',
    ];

    public function course_topic(): HasMany
    {
        return $this->hasMany(CourseTopic::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function enrollment(): HasMany
    {
        return $this->hasMany(CourseEnroll::class, 'course_id');
    }


    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function assigned_courses(): HasMany
    {
        return $this->hasMany(AssignedCourse::class, 'course_id');
    }

    public function lessonMaterials()
    {
        return $this->hasMany(LessonMaterial::class);
    }

    public function courseEnrolls()
    {
        return $this->hasMany(\App\Models\CourseEnroll::class);
    }

    public function approvedStudents()
    {
        return $this->belongsToMany(Student::class, 'course_enrolls')
            ->withPivot('enroll_status')
            ->wherePivot('enroll_status', 'approved');
    }

    public function assignments()
    {
        return $this->hasManyThrough(
            \App\Models\Assignment::class,
            \App\Models\LessonMaterial::class,
            'course_id', // FK on lesson_materials table...
            'lesson_id', // FK on assignments table...
            'id',        // Local key on courses table...
            'id'         // Local key on lesson_materials table...
        );
    }

    public function schedules()
    {
        return $this->hasMany(CourseSchedule::class);
    }

    // assuming students enrolled via pivot (course_user)
    public function students()
    {
        return $this->belongsToMany(User::class, 'course_user')->withTimestamps();
    }

    public function attendanceSessions()
    {
        return $this->hasMany(AttendanceSession::class);
    }






}
