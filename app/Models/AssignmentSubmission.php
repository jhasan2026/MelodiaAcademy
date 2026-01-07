<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssignmentSubmission extends Model
{
    protected $fillable = [
        'assignment_id','student_id','answers',
        'audio_path','audio_original_name','audio_size_bytes','audio_mime',
        'score','feedback','submitted_at','graded_at',
    ];

    protected $casts = [
        'answers' => 'array',
        'submitted_at' => 'datetime',
        'graded_at' => 'datetime',
    ];

    public function assignment(): BelongsTo { return $this->belongsTo(Assignment::class); }
    public function student(): BelongsTo { return $this->belongsTo(User::class, 'student_id'); }
}
