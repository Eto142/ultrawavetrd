<?php

namespace App\Models;

class Balance
{
    public function __construct(
        public readonly float $deposited,
        public readonly float $withdrawn,
        public readonly float $bonus,
        public readonly float $profit,
        public readonly float $total,
    ) {
    }

    public static function for(User $user): self
    {
        $sums = $user->transactions()
            ->selectRaw("category, type, SUM(amount) as total")
            ->groupBy('category', 'type')
            ->get();

        $sumOf = fn (string $category, string $type) => (float) $sums
            ->where('category', $category)
            ->where('type', $type)
            ->sum('total');

        $deposited = $sumOf('deposit', Transaction::TYPE_CREDIT);
        $bonus = $sumOf('bonus', Transaction::TYPE_CREDIT);
        $profit = $sumOf('profit', Transaction::TYPE_CREDIT);
        $withdrawn = $sumOf('withdrawal', Transaction::TYPE_DEBIT);

        $totalCredits = (float) $sums->where('type', Transaction::TYPE_CREDIT)->sum('total');
        $totalDebits = (float) $sums->where('type', Transaction::TYPE_DEBIT)->sum('total');

        return new self(
            deposited: $deposited,
            withdrawn: $withdrawn,
            bonus: $bonus,
            profit: $profit,
            total: $totalCredits - $totalDebits,
        );
    }
}
