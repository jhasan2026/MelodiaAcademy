<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseSchedule extends Model
{
    protected $fillable = [
        'course_id','day_of_week','start_time','end_time','starts_on','ends_on','timezone','note'
    ];

    protected $casts = [
        'starts_on' => 'date',
        'ends_on' => 'date',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
