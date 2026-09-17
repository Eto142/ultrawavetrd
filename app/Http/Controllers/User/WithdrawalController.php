<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Balance;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    /**
     * Display the user withdrawal page.
     */
    public function index()
    {
        return view('user.withdrawal');
    }

    /**
     * Store a withdrawal request.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'method' => ['required', 'string', 'max:50'],
            'method_type' => ['required', 'in:crypto,currency'],
            'wallet_address' => ['required_if:method_type,crypto', 'nullable', 'string', 'max:255'],
            'bankname' => ['required_if:method_type,currency', 'nullable', 'string', 'max:100'],
            'account_name' => ['required_if:method_type,currency', 'nullable', 'string', 'max:100'],
            'account_number' => ['required_if:method_type,currency', 'nullable', 'string', 'max:50'],
            'swift_code' => ['required_if:method_type,currency', 'nullable', 'string', 'max:50'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'fee' => ['nullable', 'numeric', 'min:0'],
            'total_deducted' => ['nullable', 'numeric', 'min:0'],
        ]);

        $fee = $validated['fee'] ?? 0;
        $totalDeducted = $validated['total_deducted'] ?? ($validated['amount'] + $fee);

        $balance = Balance::for($request->user());

        if ($totalDeducted > $balance->total) {
            return back()->with('error', 'Insufficient balance. Your available balance is $' . number_format($balance->total, 2) . '.');
        }

        $request->user()->withdrawals()->create([
            'transaction_id' => Withdrawal::generateTransactionId(),
            'method' => $validated['method'],
            'method_type' => $validated['method_type'],
            'wallet_address' => $validated['wallet_address'] ?? null,
            'bank_name' => $validated['bankname'] ?? null,
            'account_name' => $validated['account_name'] ?? null,
            'account_number' => $validated['account_number'] ?? null,
            'swift_code' => $validated['swift_code'] ?? null,
            'amount' => $validated['amount'],
            'fee' => $fee,
            'total_deducted' => $totalDeducted,
            'status' => Withdrawal::STATUS_PENDING,
        ]);

        return back()->with('success', 'Your withdrawal request has been submitted and is pending approval.');
    }
}
