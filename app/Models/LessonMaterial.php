<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonMaterial extends Model
{
    /** @use HasFactory<\Database\Factories\LessonMaterialFactory> */
    use HasFactory;
    protected $fillable = [
        'course_id',
        'title',
        'description',
        'file_path',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
