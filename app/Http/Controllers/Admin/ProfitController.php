<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profit;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ProfitController extends Controller
{
    public function index(Request $request)
    {
        $profits = Profit::with('user')
            ->when($request->filled('user'), fn ($q) => $q->where('user_id', $request->integer('user')))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.profits.index', compact('profits'));
    }

    public function store(Request $request, User $user)
    {
        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'min:0.01'],
            'description' => ['nullable', 'string', 'max:255'],
            'date' => ['required', 'date'],
        ]);

        $occurredAt = Carbon::parse($validated['date']);

        $profit = $user->profits()->create([
            'amount' => $validated['amount'],
            'description' => $validated['description'] ?? null,
        ]);
        $profit->forceFill(['created_at' => $occurredAt])->save();

        $transaction = Transaction::record(
            user: $user,
            type: Transaction::TYPE_CREDIT,
            category: 'profit',
            amount: (float) $validated['amount'],
            reference: $profit,
            description: $validated['description'] ?? 'Profit credit',
        );
        $transaction->forceFill(['created_at' => $occurredAt])->save();

        return back()->with('success', 'Profit of $' . number_format($validated['amount'], 2) . " added to {$user->name}'s account.");
    }
}
