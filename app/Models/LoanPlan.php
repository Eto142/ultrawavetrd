<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanPlan extends Model
{
    protected $fillable = [
        'name',
        'description',
        'min_amount',
        'max_amount',
        'interest_rate',
        'interest_type',
        'min_duration',
        'max_duration',
        'max_active_loans',
        'min_account_balance',
        'requires_collateral',
        'collateral_percentage',
        'processing_fee',
        'grace_period_days',
        'late_fee_percentage',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'min_amount' => 'decimal:2',
            'max_amount' => 'decimal:2',
            'interest_rate' => 'decimal:2',
            'min_duration' => 'integer',
            'max_duration' => 'integer',
            'max_active_loans' => 'integer',
            'min_account_balance' => 'decimal:2',
            'requires_collateral' => 'boolean',
            'collateral_percentage' => 'decimal:2',
            'processing_fee' => 'decimal:2',
            'grace_period_days' => 'integer',
            'late_fee_percentage' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
