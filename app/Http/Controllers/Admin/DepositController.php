<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function index(Request $request)
    {
        $deposits = Deposit::with('user')
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->integer('status')))
            ->when($request->filled('user'), fn ($q) => $q->where('user_id', $request->integer('user')))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.deposits.index', compact('deposits'));
    }

    public function approve(Deposit $deposit)
    {
        $deposit->update(['status' => Deposit::STATUS_APPROVED]);

        Transaction::record(
            user: $deposit->user,
            type: Transaction::TYPE_CREDIT,
            category: 'deposit',
            amount: (float) $deposit->amount,
            reference: $deposit,
            description: $deposit->method,
        );

        return back()->with('success', 'Deposit approved.');
    }
}
