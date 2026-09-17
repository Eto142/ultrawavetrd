<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Investment;
use App\Models\InvestmentPlan;
use Illuminate\Http\Request;

class InvestmentController extends Controller
{
    public function index()
    {
        $plans = InvestmentPlan::where('is_active', true)->orderBy('min_amount')->get();

        return view('user.investment-plan', compact('plans'));
    }

    /**
     * Store an investment against a plan.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'investment_plan_id' => ['required', 'exists:investment_plans,id'],
            'amount' => ['required', 'numeric', 'min:0.01'],
        ]);

        $plan = InvestmentPlan::findOrFail($validated['investment_plan_id']);

        $request->validate([
            'amount' => ['numeric', 'between:' . $plan->min_amount . ',' . $plan->max_amount],
        ]);

        $request->user()->investments()->create([
            'investment_plan_id' => $plan->id,
            'amount' => $validated['amount'],
            'payment_method' => 'Account Balance',
            'status' => Investment::STATUS_PENDING,
        ]);

        return back()->with('success', 'Your investment has been submitted and is pending approval.');
    }

    /**
     * List the authenticated user's investments.
     */
    public function myPlans(Request $request)
    {
        $investments = $request->user()->investments()->with('investmentPlan')->latest()->get();

        return view('user.my-investments', compact('investments'));
    }
}
