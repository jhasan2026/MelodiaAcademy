<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseTopic extends Model
{
    /** @use HasFactory<\Database\Factories\CourseTopicFactory> */
    use HasFactory;

    protected $fillable = [
        'topic'
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
