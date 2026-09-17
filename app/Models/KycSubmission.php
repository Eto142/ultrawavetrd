<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KycSubmission extends Model
{
    const STATUS_PENDING = 0;

    const STATUS_APPROVED = 1;

    const STATUS_REJECTED = 2;

    const DOCUMENT_TYPES = [
        'passport' => 'Passport',
        'national_id' => 'National ID Card',
        'drivers_license' => "Driver's License",
    ];

    protected $fillable = [
        'user_id',
        'document_type',
        'document_number',
        'date_of_birth',
        'country',
        'front_document_path',
        'back_document_path',
        'selfie_path',
        'status',
        'rejection_reason',
        'reviewed_at',
    ];

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
            'status' => 'integer',
            'reviewed_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isApproved(): bool
    {
        return $this->status === self::STATUS_APPROVED;
    }

    public function isRejected(): bool
    {
        return $this->status === self::STATUS_REJECTED;
    }

    public function statusLabel(): string
    {
        return match ($this->status) {
            self::STATUS_APPROVED => 'Verified',
            self::STATUS_REJECTED => 'Rejected',
            default => 'Pending Review',
        };
    }
}
