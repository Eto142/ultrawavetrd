<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Investment;
use App\Models\Transaction;
use Illuminate\Http\Request;

class InvestmentController extends Controller
{
    public function index(Request $request)
    {
        $investments = Investment::with(['user', 'investmentPlan'])
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->integer('status')))
            ->when($request->filled('user'), fn ($q) => $q->where('user_id', $request->integer('user')))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.investments.index', compact('investments'));
    }

    public function approve(Investment $investment)
    {
        $investment->update(['status' => Investment::STATUS_APPROVED]);

        Transaction::record(
            user: $investment->user,
            type: Transaction::TYPE_DEBIT,
            category: 'investment',
            amount: (float) $investment->amount,
            reference: $investment,
            description: $investment->investmentPlan->name ?? 'Investment',
        );

        return back()->with('success', 'Investment approved.');
    }
}
