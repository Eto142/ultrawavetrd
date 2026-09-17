<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    const STATUS_PENDING = 0;
    const STATUS_APPROVED = 1;

    protected $fillable = [
        'user_id',
        'loan_plan_id',
        'amount',
        'duration',
        'purpose',
        'interest_rate',
        'interest_type',
        'total_interest',
        'processing_fee',
        'total_repayable',
        'monthly_payment',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'duration' => 'integer',
            'interest_rate' => 'decimal:2',
            'total_interest' => 'decimal:2',
            'processing_fee' => 'decimal:2',
            'total_repayable' => 'decimal:2',
            'monthly_payment' => 'decimal:2',
            'status' => 'integer',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function loanPlan()
    {
        return $this->belongsTo(LoanPlan::class);
    }
}
