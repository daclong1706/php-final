<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'course_id',
        'content',
        'description'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
