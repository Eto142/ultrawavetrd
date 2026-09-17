<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PreIpoHolding;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PreIpoHoldingController extends Controller
{
    public function index(Request $request)
    {
        $holdings = PreIpoHolding::with(['user', 'preIpoCompany'])
            ->when($request->filled('company'), fn ($q) => $q->where('pre_ipo_company_id', $request->integer('company')))
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->integer('status')))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.pre-ipo-holdings.index', compact('holdings'));
    }

    public function approve(PreIpoHolding $holding)
    {
        $holding->update(['status' => PreIpoHolding::STATUS_APPROVED]);

        Transaction::record(
            user: $holding->user,
            type: Transaction::TYPE_DEBIT,
            category: 'pre_ipo',
            amount: (float) $holding->total_cost,
            reference: $holding,
            description: $holding->preIpoCompany->name ?? 'Pre-IPO shares',
        );

        return back()->with('success', 'Holding approved.');
    }
}
