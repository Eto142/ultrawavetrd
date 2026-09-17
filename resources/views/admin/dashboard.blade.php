@include('admin.header', ['title' => 'Dashboard', 'heading' => 'Dashboard'])

<div class="row g-3 mb-3">
    <div class="col-sm-6 col-lg-3">
        <div class="stat-card d-flex align-items-start gap-3">
            <span class="stat-icon stat-icon-primary"><i class="bi bi-people-fill"></i></span>
            <div class="min-w-0">
                <p class="stat-label mb-1">Total Users</p>
                <p class="stat-value mb-1">{{ number_format($stats['total_users']) }}</p>
                <p class="text-gain small mb-0">+{{ $stats['new_users_today'] }} today</p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="stat-card d-flex align-items-start gap-3">
            <span class="stat-icon stat-icon-success"><i class="bi bi-box-arrow-in-down"></i></span>
            <div class="min-w-0">
                <p class="stat-label mb-1">Total Deposited</p>
                <p class="stat-value mb-1">${{ number_format($stats['total_deposited'], 2) }}</p>
                <p class="text-warning small mb-0">{{ $stats['pending_deposits'] }} pending</p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="stat-card d-flex align-items-start gap-3">
            <span class="stat-icon stat-icon-danger"><i class="bi bi-box-arrow-up"></i></span>
            <div class="min-w-0">
                <p class="stat-label mb-1">Total Withdrawn</p>
                <p class="stat-value mb-1">${{ number_format($stats['total_withdrawn'], 2) }}</p>
                <p class="text-warning small mb-0">{{ $stats['pending_withdrawals'] }} pending</p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="stat-card d-flex align-items-start gap-3">
            <span class="stat-icon stat-icon-warning"><i class="bi bi-patch-check-fill"></i></span>
            <div class="min-w-0">
                <p class="stat-label mb-1">KYC Review</p>
                <p class="stat-value mb-1">{{ $stats['pending_kyc'] }}</p>
                <p class="text-body-secondary small mb-0">awaiting review</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-3">
    <div class="col-sm-6">
        <div class="stat-card d-flex align-items-start gap-3">
            <span class="stat-icon stat-icon-info"><i class="bi bi-cash-coin"></i></span>
            <div class="min-w-0">
                <p class="stat-label mb-1">Total Loaned</p>
                <p class="stat-value mb-1">${{ number_format($stats['total_loaned'], 2) }}</p>
                <p class="text-warning small mb-0">{{ $stats['pending_loans'] }} pending</p>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="stat-card d-flex align-items-start gap-3">
            <span class="stat-icon stat-icon-primary"><i class="bi bi-graph-up-arrow"></i></span>
            <div class="min-w-0">
                <p class="stat-label mb-1">Total Invested</p>
                <p class="stat-value mb-1">${{ number_format($stats['total_invested'], 2) }}</p>
                <p class="text-warning small mb-0">{{ $stats['pending_investments'] }} pending</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="h6 text-light mb-0">Recent Users</h2>
                <a href="{{ route('admin.users') }}" class="small">View all</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <tbody>
                        @forelse ($recentUsers as $user)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.users.show', $user) }}" class="text-light">{{ $user->name }}</a>
                                    <p class="text-body-secondary small mb-0">{{ $user->email }}</p>
                                </td>
                                <td class="text-end text-body-secondary small">{{ $user->created_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr><td class="text-center py-4" colspan="2">No users yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="h6 text-light mb-0">Recent Deposits</h2>
                <a href="{{ route('admin.deposits') }}" class="small">View all</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <tbody>
                        @forelse ($recentDeposits as $deposit)
                            <tr>
                                <td>
                                    <p class="text-light mb-0">{{ $deposit->user->name ?? 'Unknown' }}</p>
                                    <p class="text-body-secondary small mb-0">{{ $deposit->method }}</p>
                                </td>
                                <td class="text-end">${{ number_format($deposit->amount, 2) }}</td>
                                <td class="text-end">
                                    <span class="badge {{ $deposit->status === \App\Models\Deposit::STATUS_APPROVED ? 'badge-approved' : 'badge-pending' }}">
                                        {{ $deposit->status === \App\Models\Deposit::STATUS_APPROVED ? 'Approved' : 'Pending' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr><td class="text-center py-4" colspan="3">No deposits yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')
