<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    const STATUS_PENDING = 0;
    const STATUS_APPROVED = 1;

    protected $fillable = [
        'user_id',
        'transaction_id',
        'method',
        'method_type',
        'wallet_address',
        'bank_name',
        'account_name',
        'account_number',
        'swift_code',
        'amount',
        'fee',
        'total_deducted',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'fee' => 'decimal:2',
            'total_deducted' => 'decimal:2',
            'status' => 'integer',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Generate a unique, user-facing reference number for a new withdrawal.
     */
    public static function generateTransactionId(): string
    {
        do {
            $id = (string) random_int(1000000000, 9999999999);
        } while (static::where('transaction_id', $id)->exists());

        return $id;
    }
}
