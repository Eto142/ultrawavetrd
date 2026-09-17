<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\LoanPlan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        $plans = LoanPlan::where('is_active', true)->get();

        return view('user.loans', compact('plans'));
    }

    /**
     * List the authenticated user's loan applications.
     */
    public function myLoans(Request $request)
    {
        $loans = $request->user()->loans()->with('loanPlan')->latest()->get();

        return view('user.my-loans', compact('loans'));
    }

    /**
     * Calculate a live repayment preview for the loan calculator.
     */
    public function calculatePreview(Request $request)
    {
        $validated = $this->validatePlanAmountDuration($request);
        $plan = LoanPlan::findOrFail($validated['loan_plan_id']);

        return response()->json($this->buildPreview($plan, $validated['amount'], $validated['duration']));
    }

    /**
     * Store a loan application.
     */
    public function store(Request $request)
    {
        $validated = $this->validatePlanAmountDuration($request);
        $validated['purpose'] = $request->validate([
            'purpose' => ['required', 'string', 'max:1000'],
        ])['purpose'];

        $plan = LoanPlan::findOrFail($validated['loan_plan_id']);
        $preview = $this->buildPreview($plan, $validated['amount'], $validated['duration']);

        $request->user()->loans()->create([
            'loan_plan_id' => $plan->id,
            'amount' => $validated['amount'],
            'duration' => $validated['duration'],
            'purpose' => $validated['purpose'],
            'interest_rate' => $plan->interest_rate,
            'interest_type' => $plan->interest_type,
            'total_interest' => $preview['total_interest'],
            'processing_fee' => $preview['processing_fee'],
            'total_repayable' => $preview['total_repayable'],
            'monthly_payment' => $preview['monthly_payment'],
            'status' => Loan::STATUS_PENDING,
        ]);

        return back()->with('success', 'Your loan application has been submitted and is pending approval.');
    }

    private function validatePlanAmountDuration(Request $request): array
    {
        $validated = $request->validate([
            'loan_plan_id' => ['required', 'exists:loan_plans,id'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'duration' => ['required', 'integer', 'min:1'],
        ]);

        $plan = LoanPlan::findOrFail($validated['loan_plan_id']);

        $request->validate([
            'amount' => ['numeric', 'between:' . $plan->min_amount . ',' . $plan->max_amount],
            'duration' => ['integer', 'between:' . $plan->min_duration . ',' . $plan->max_duration],
        ]);

        return $validated;
    }

    private function buildPreview(LoanPlan $plan, float $amount, int $duration): array
    {
        $rate = (float) $plan->interest_rate;

        if ($plan->interest_type === 'compound') {
            $monthlyRate = $rate / 100 / 12;
            $totalInterest = $amount * ((1 + $monthlyRate) ** $duration) - $amount;
        } else {
            $totalInterest = $amount * ($rate / 100) * ($duration / 12);
        }

        $processingFee = $amount * ((float) $plan->processing_fee / 100);
        $totalRepayable = $amount + $totalInterest + $processingFee;
        $monthlyPayment = $totalRepayable / $duration;

        return [
            'interest_rate' => $rate,
            'interest_type' => $plan->interest_type,
            'total_interest' => round($totalInterest, 2),
            'processing_fee' => round($processingFee, 2),
            'total_repayable' => round($totalRepayable, 2),
            'monthly_payment' => round($monthlyPayment, 2),
        ];
    }
}
