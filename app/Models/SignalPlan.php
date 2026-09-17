<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SignalPlan extends Model
{
    protected $fillable = [
        'name',
        'badge_label',
        'price',
        'duration_days',
        'features',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'duration_days' => 'integer',
            'features' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function subscriptions()
    {
        return $this->hasMany(SignalSubscription::class);
    }
}
