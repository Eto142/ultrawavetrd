<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function standaloneLessons()
    {
        return $this->hasMany(Lesson::class)->whereNull('course_id')->orderBy('sort_order');
    }
}
