<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseEnrollment extends Model
{
    const STATUS_PENDING = 0;

    const STATUS_APPROVED = 1;

    protected $fillable = [
        'user_id',
        'course_id',
        'status',
        'progress_percent',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'integer',
            'progress_percent' => 'integer',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_APPROVED;
    }
}
