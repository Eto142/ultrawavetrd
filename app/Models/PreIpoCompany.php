<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreIpoCompany extends Model
{
    protected $fillable = [
        'name',
        'symbol',
        'sector',
        'description',
        'share_price',
        'initial_price',
        'total_shares',
        'shares_sold',
        'min_purchase',
        'max_purchase_per_user',
        'expected_ipo_date',
        'is_featured',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'share_price' => 'decimal:2',
            'initial_price' => 'decimal:2',
            'total_shares' => 'integer',
            'shares_sold' => 'integer',
            'min_purchase' => 'integer',
            'max_purchase_per_user' => 'integer',
            'expected_ipo_date' => 'date',
            'is_featured' => 'boolean',
        ];
    }

    public function getSharesAvailableAttribute(): int
    {
        return max(0, $this->total_shares - $this->shares_sold);
    }

    public function getPriceChangePercentAttribute(): float
    {
        if ((float) $this->initial_price <= 0) {
            return 0;
        }

        return round((((float) $this->share_price - (float) $this->initial_price) / (float) $this->initial_price) * 100, 2);
    }

    public function holdings()
    {
        return $this->hasMany(PreIpoHolding::class);
    }
}
