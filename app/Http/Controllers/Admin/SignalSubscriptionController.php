<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SignalSubscription;
use App\Models\Transaction;
use Illuminate\Http\Request;

class SignalSubscriptionController extends Controller
{
    public function index(Request $request)
    {
        $subscriptions = SignalSubscription::with(['user', 'signalPlan'])
            ->when($request->filled('plan'), fn ($q) => $q->where('signal_plan_id', $request->integer('plan')))
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->integer('status')))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.signal-subscriptions.index', compact('subscriptions'));
    }

    public function approve(SignalSubscription $subscription)
    {
        $subscription->update([
            'status' => SignalSubscription::STATUS_APPROVED,
            'expires_at' => now()->addDays($subscription->signalPlan->duration_days ?? 30),
        ]);

        Transaction::record(
            user: $subscription->user,
            type: Transaction::TYPE_DEBIT,
            category: 'signal_subscription',
            amount: (float) $subscription->amount,
            reference: $subscription,
            description: $subscription->signalPlan->name ?? 'Signal plan',
        );

        return back()->with('success', 'Subscription approved.');
    }
}
