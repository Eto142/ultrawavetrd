<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    const STATUS_OPEN = 'open';

    const STATUS_WON = 'won';

    const STATUS_LOST = 'lost';

    protected $fillable = [
        'user_id',
        'trading_asset_id',
        'trade_type',
        'side',
        'amount',
        'leverage',
        'duration_minutes',
        'entry_price',
        'exit_price',
        'expires_at',
        'is_demo',
        'close_requested_at',
        'status',
        'pnl',
        'closed_at',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'leverage' => 'integer',
            'duration_minutes' => 'integer',
            'entry_price' => 'decimal:8',
            'exit_price' => 'decimal:8',
            'expires_at' => 'datetime',
            'is_demo' => 'boolean',
            'close_requested_at' => 'datetime',
            'pnl' => 'decimal:2',
            'closed_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tradingAsset()
    {
        return $this->belongsTo(TradingAsset::class);
    }

    public function isExpired(): bool
    {
        return $this->expires_at !== null && $this->expires_at->isPast();
    }

    public function isPendingClose(): bool
    {
        return $this->close_requested_at !== null;
    }
}
