<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\Transaction;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index(Request $request)
    {
        $loans = Loan::with(['user', 'loanPlan'])
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->integer('status')))
            ->when($request->filled('user'), fn ($q) => $q->where('user_id', $request->integer('user')))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.loans.index', compact('loans'));
    }

    public function approve(Loan $loan)
    {
        $loan->update(['status' => Loan::STATUS_APPROVED]);

        Transaction::record(
            user: $loan->user,
            type: Transaction::TYPE_CREDIT,
            category: 'loan',
            amount: (float) $loan->amount,
            reference: $loan,
            description: 'Loan disbursement',
        );

        return back()->with('success', 'Loan approved.');
    }
}
