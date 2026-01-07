<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssignmentQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignment_id',
        'prompt',
        'type',
        'correct_answer',
        'points',
    ];

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }
}
