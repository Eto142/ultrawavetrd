<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trader extends Model
{
    protected $fillable = [
        'name',
        'avatar_url',
        'style_label',
        'risk_level',
        'headline',
        'bio',
        'followers_count',
        'daily_roi_pct',
        'total_roi_pct',
        'win_rate_pct',
        'min_capital',
        'duration_days',
        'total_trades',
        'years_experience',
        'markets_traded',
        'is_verified',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'followers_count' => 'integer',
            'daily_roi_pct' => 'decimal:2',
            'total_roi_pct' => 'decimal:2',
            'win_rate_pct' => 'decimal:2',
            'min_capital' => 'decimal:2',
            'duration_days' => 'integer',
            'total_trades' => 'integer',
            'years_experience' => 'integer',
            'markets_traded' => 'array',
            'is_verified' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function subscriptions()
    {
        return $this->hasMany(CopyTradingSubscription::class);
    }
}
