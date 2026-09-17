<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TradingAsset extends Model
{
    public const ASSET_CLASSES = [
        'crypto' => 'Crypto',
        'forex' => 'Forex',
        'stock' => 'Stocks',
        'etf' => 'ETFs',
        'index' => 'Indices',
    ];

    protected $fillable = [
        'name',
        'symbol',
        'asset_class',
        'price',
        'price_change_24h',
        'price_change_pct_24h',
        'high_24h',
        'low_24h',
        'volume_24h',
        'market_cap',
        'logo_url',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:8',
            'price_change_24h' => 'decimal:8',
            'price_change_pct_24h' => 'decimal:4',
            'high_24h' => 'decimal:8',
            'low_24h' => 'decimal:8',
            'volume_24h' => 'integer',
            'market_cap' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function trades()
    {
        return $this->hasMany(Trade::class);
    }

    public function formattedPrice(): string
    {
        return self::formatPrice($this->price);
    }

    public static function formatPrice($price): string
    {
        $price = (float) $price;

        if ($price >= 1) {
            return number_format($price, 2);
        }

        if ($price >= 0.01) {
            return number_format($price, 4);
        }

        return number_format($price, 6);
    }
}
