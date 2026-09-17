<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockOrder extends Model
{
    const STATUS_PENDING = 0;
    const STATUS_APPROVED = 1;

    const SIDE_BUY = 'buy';
    const SIDE_SELL = 'sell';

    protected $fillable = [
        'user_id',
        'stock_id',
        'side',
        'quantity',
        'price_per_share',
        'amount',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'decimal:8',
            'price_per_share' => 'decimal:4',
            'amount' => 'decimal:2',
            'status' => 'integer',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
}
