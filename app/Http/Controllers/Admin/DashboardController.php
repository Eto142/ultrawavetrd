<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Investment;
use App\Models\KycSubmission;
use App\Models\Loan;
use App\Models\User;
use App\Models\Withdrawal;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'new_users_today' => User::whereDate('created_at', today())->count(),
            'pending_deposits' => Deposit::where('status', Deposit::STATUS_PENDING)->count(),
            'pending_withdrawals' => Withdrawal::where('status', Withdrawal::STATUS_PENDING)->count(),
            'pending_kyc' => KycSubmission::where('status', KycSubmission::STATUS_PENDING)->count(),
            'pending_loans' => Loan::where('status', Loan::STATUS_PENDING)->count(),
            'pending_investments' => Investment::where('status', Investment::STATUS_PENDING)->count(),
            'total_deposited' => Deposit::where('status', Deposit::STATUS_APPROVED)->sum('amount'),
            'total_withdrawn' => Withdrawal::where('status', Withdrawal::STATUS_APPROVED)->sum('amount'),
            'total_invested' => Investment::where('status', Investment::STATUS_APPROVED)->sum('amount'),
            'total_loaned' => Loan::where('status', Loan::STATUS_APPROVED)->sum('amount'),
        ];

        $recentUsers = User::latest()->take(5)->get();
        $recentDeposits = Deposit::with('user')->latest()->take(5)->get();
        $recentWithdrawals = Withdrawal::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'recentDeposits', 'recentWithdrawals'));
    }
}
