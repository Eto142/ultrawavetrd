<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Signal extends Model
{
    protected $fillable = [
        'symbol',
        'direction',
        'entry_price',
        'take_profit',
        'stop_loss',
        'status',
        'notes',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'entry_price' => 'decimal:5',
            'take_profit' => 'decimal:5',
            'stop_loss' => 'decimal:5',
            'is_active' => 'boolean',
        ];
    }
}
