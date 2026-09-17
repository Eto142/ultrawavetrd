<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'symbol',
        'name',
        'logo_url',
        'price',
        'previous_close',
        'day_high',
        'day_low',
        'volume',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:4',
            'previous_close' => 'decimal:4',
            'day_high' => 'decimal:4',
            'day_low' => 'decimal:4',
            'volume' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function getChangeAmountAttribute(): float
    {
        return round((float) $this->price - (float) $this->previous_close, 4);
    }

    public function getChangePercentAttribute(): float
    {
        if ((float) $this->previous_close <= 0) {
            return 0;
        }

        return round((($this->price - $this->previous_close) / $this->previous_close) * 100, 2);
    }

    public function orders()
    {
        return $this->hasMany(StockOrder::class);
    }
}
