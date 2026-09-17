<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Signal;
use App\Models\SignalPlan;
use App\Models\SignalSubscription;
use Illuminate\Http\Request;

class SignalController extends Controller
{
    /**
     * Show the live signal feed, gated behind an active subscription.
     */
    public function signals(Request $request)
    {
        $hasActiveSubscription = $request->user()
            ->signalSubscriptions()
            ->where('status', SignalSubscription::STATUS_APPROVED)
            ->where(function ($query) {
                $query->whereNull('expires_at')->orWhere('expires_at', '>', now());
            })
            ->exists();

        $signals = $hasActiveSubscription
            ? Signal::where('is_active', true)->latest()->get()
            : collect();

        return view('user.signals', compact('hasActiveSubscription', 'signals'));
    }

    /**
     * List available signal subscription plans.
     */
    public function signalplans()
    {
        $plans = SignalPlan::where('is_active', true)->orderBy('price')->get();

        return view('user.signal-plans', compact('plans'));
    }

    /**
     * Subscribe the authenticated user to a signal plan.
     */
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'signal_plan_id' => ['required', 'exists:signal_plans,id'],
        ]);

        $plan = SignalPlan::findOrFail($validated['signal_plan_id']);

        $request->user()->signalSubscriptions()->create([
            'signal_plan_id' => $plan->id,
            'amount' => $plan->price,
            'payment_method' => 'Account Balance',
            'status' => SignalSubscription::STATUS_PENDING,
            'expires_at' => now()->addDays($plan->duration_days),
        ]);

        return back()->with('success', 'Your subscription request has been submitted and is pending approval.');
    }

    /**
     * List the authenticated user's signal plan subscriptions.
     */
    public function mysubscriptions(Request $request)
    {
        $subscriptions = $request->user()
            ->signalSubscriptions()
            ->with('signalPlan')
            ->latest()
            ->get();

        return view('user.my-subscriptions', compact('subscriptions'));
    }
}
