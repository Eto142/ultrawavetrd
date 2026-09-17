<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Transaction extends Model
{
    const TYPE_CREDIT = 'credit';

    const TYPE_DEBIT = 'debit';

    protected $fillable = [
        'user_id',
        'type',
        'category',
        'amount',
        'description',
        'reference_type',
        'reference_id',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reference(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Record a completed money movement on the general ledger.
     * Only call this once the underlying request has actually been approved —
     * this table is a log of real balance-affecting events, not pending requests.
     */
    public static function record(User $user, string $type, string $category, float $amount, ?Model $reference = null, ?string $description = null): self
    {
        return static::create([
            'user_id' => $user->id,
            'type' => $type,
            'category' => $category,
            'amount' => $amount,
            'reference_type' => $reference ? $reference->getMorphClass() : null,
            'reference_id' => $reference?->getKey(),
            'description' => $description,
        ]);
    }
}
