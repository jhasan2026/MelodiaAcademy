<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'gender',
        'date_of_birth',
        'profile_pic',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'gender' => 'string',
    ];

    public function courses()
    {
        return $this->belongsToMany(\App\Models\Course::class, 'course_enrolls')
            ->withPivot(['enroll_status']);
    }


}
