<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assignment extends Model
{
    use HasFactory;
    protected $fillable = [
        'lesson_id','created_by','title','description','type',
        'is_published','due_at','allow_late','allow_resubmit','max_score',
        'time_limit_minutes','attempt_limit','auto_grade',
        'max_file_mb','max_duration_seconds','allowed_mimes',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'allow_late' => 'boolean',
        'allow_resubmit' => 'boolean',
        'auto_grade' => 'boolean',
        'due_at' => 'datetime',
        'allowed_mimes' => 'array',
    ];

    public function lesson(): BelongsTo { return $this->belongsTo(LessonMaterial::class); }
    public function creator(): BelongsTo { return $this->belongsTo(User::class, 'created_by'); }
    public function questions(): HasMany { return $this->hasMany(AssignmentQuestion::class); }
    public function submissions(): HasMany { return $this->hasMany(AssignmentSubmission::class); }
}
