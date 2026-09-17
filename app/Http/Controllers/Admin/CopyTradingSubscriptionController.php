<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CopyTradingSubscription;
use App\Models\Transaction;
use Illuminate\Http\Request;

class CopyTradingSubscriptionController extends Controller
{
    public function index(Request $request)
    {
        $subscriptions = CopyTradingSubscription::with(['user', 'trader'])
            ->when($request->filled('trader'), fn ($q) => $q->where('trader_id', $request->integer('trader')))
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->integer('status')))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.copy-trading-subscriptions.index', compact('subscriptions'));
    }

    public function approve(CopyTradingSubscription $subscription)
    {
        $subscription->update(['status' => CopyTradingSubscription::STATUS_APPROVED]);

        Transaction::record(
            user: $subscription->user,
            type: Transaction::TYPE_DEBIT,
            category: 'copy_trading',
            amount: (float) $subscription->amount,
            reference: $subscription,
            description: $subscription->trader->name ?? 'Copy trading',
        );

        return back()->with('success', 'Subscription approved.');
    }
}
