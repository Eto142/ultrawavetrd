<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bonus;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BonusController extends Controller
{
    public function index(Request $request)
    {
        $bonuses = Bonus::with('user')
            ->when($request->filled('user'), fn ($q) => $q->where('user_id', $request->integer('user')))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.bonuses.index', compact('bonuses'));
    }

    public function store(Request $request, User $user)
    {
        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'min:0.01'],
            'description' => ['nullable', 'string', 'max:255'],
            'date' => ['required', 'date'],
        ]);

        $occurredAt = Carbon::parse($validated['date']);

        $bonus = $user->bonuses()->create([
            'amount' => $validated['amount'],
            'description' => $validated['description'] ?? null,
        ]);
        $bonus->forceFill(['created_at' => $occurredAt])->save();

        $transaction = Transaction::record(
            user: $user,
            type: Transaction::TYPE_CREDIT,
            category: 'bonus',
            amount: (float) $validated['amount'],
            reference: $bonus,
            description: $validated['description'] ?? 'Bonus credit',
        );
        $transaction->forceFill(['created_at' => $occurredAt])->save();

        return back()->with('success', 'Bonus of $' . number_format($validated['amount'], 2) . " added to {$user->name}'s account.");
    }
}
