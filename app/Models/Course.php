<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        return $this->hasMany(CourseEnroll::class);
    }


}
