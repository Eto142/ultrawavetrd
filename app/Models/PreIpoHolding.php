<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreIpoHolding extends Model
{
    const STATUS_PENDING = 0;
    const STATUS_APPROVED = 1;

    protected $fillable = [
        'user_id',
        'pre_ipo_company_id',
        'quantity',
        'price_per_share',
        'total_cost',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'price_per_share' => 'decimal:2',
            'total_cost' => 'decimal:2',
            'status' => 'integer',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function preIpoCompany()
    {
        return $this->belongsTo(PreIpoCompany::class);
    }
}
