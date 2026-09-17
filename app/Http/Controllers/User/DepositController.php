<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Deposit;
class DepositController extends Controller
{
    /**
     * Display the user deposit page.
     */
    public function index()
    {
        return view('user.deposit');
    }

    /**
     * Store a crypto/gift-card deposit with proof of payment.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'method' => ['required', 'string', 'max:50'],
            'amount' => ['required', 'numeric', 'min:1'],
            'proof' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
        ]);

        $proofPath = $request->file('proof')->store('deposit-proofs', 'public');

        $request->user()->deposits()->create([
            'transaction_id' => Deposit::generateTransactionId(),
            'method' => $validated['method'],
            'amount' => $validated['amount'],
            'proof' => $proofPath,
            'status' => Deposit::STATUS_PENDING,
        ]);

        return back()->with('success', 'Your deposit has been submitted and is pending verification.');
    }

    /**
     * Store a request for a deposit method without an upfront proof (e.g. bank transfer, PayPal).
     */
    public function storeOther(Request $request)
    {
        $validated = $request->validate([
            'method' => ['required', 'string', 'max:50'],
            'amount' => ['required', 'numeric', 'min:1'],
        ]);

        $request->user()->deposits()->create([
            'transaction_id' => Deposit::generateTransactionId(),
            'method' => $validated['method'],
            'amount' => $validated['amount'],
            'status' => Deposit::STATUS_PENDING,
        ]);

        return back()->with('success', 'Your deposit request has been received. Payment details will be sent to your email.');
    }
}
