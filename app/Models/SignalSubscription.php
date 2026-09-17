<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SignalSubscription extends Model
{
    const STATUS_PENDING = 0;

    const STATUS_APPROVED = 1;

    protected $fillable = [
        'user_id',
        'signal_plan_id',
        'amount',
        'payment_method',
        'status',
        'expires_at',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'status' => 'integer',
            'expires_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function signalPlan()
    {
        return $this->belongsTo(SignalPlan::class);
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_APPROVED
            && ($this->expires_at === null || $this->expires_at->isFuture());
    }
}
