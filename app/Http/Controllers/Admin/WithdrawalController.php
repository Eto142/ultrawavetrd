<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    public function index(Request $request)
    {
        $withdrawals = Withdrawal::with('user')
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->integer('status')))
            ->when($request->filled('user'), fn ($q) => $q->where('user_id', $request->integer('user')))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.withdrawals.index', compact('withdrawals'));
    }

    public function approve(Withdrawal $withdrawal)
    {
        $withdrawal->update(['status' => Withdrawal::STATUS_APPROVED]);

        Transaction::record(
            user: $withdrawal->user,
            type: Transaction::TYPE_DEBIT,
            category: 'withdrawal',
            amount: (float) $withdrawal->amount,
            reference: $withdrawal,
            description: $withdrawal->method,
        );

        return back()->with('success', 'Withdrawal approved.');
    }
}
