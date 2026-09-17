@include('admin.header', ['title' => 'Withdrawals', 'heading' => 'Withdrawals'])

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div class="btn-group">
            <a href="{{ route('admin.withdrawals') }}" class="btn btn-sm {{ ! request()->filled('status') ? 'btn-primary' : 'btn-outline-secondary' }}">All</a>
            <a href="{{ route('admin.withdrawals', ['status' => 0]) }}" class="btn btn-sm {{ request('status') === '0' ? 'btn-primary' : 'btn-outline-secondary' }}">Pending</a>
            <a href="{{ route('admin.withdrawals', ['status' => 1]) }}" class="btn btn-sm {{ request('status') === '1' ? 'btn-primary' : 'btn-outline-secondary' }}">Approved</a>
        </div>
        @if (request()->filled('user'))
            <a href="{{ route('admin.withdrawals') }}" class="small">Clear user filter</a>
        @endif
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Method</th>
                    <th>Destination</th>
                    <th>Amount</th>
                    <th>Fee</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($withdrawals as $withdrawal)
                    <tr>
                        <td>
                            @if ($withdrawal->user)
                                <a href="{{ route('admin.users.show', $withdrawal->user) }}" class="text-light">{{ $withdrawal->user->name }}</a>
                            @else
                                <span class="text-body-secondary">Unknown</span>
                            @endif
                        </td>
                        <td>{{ $withdrawal->method }}</td>
                        <td class="small">
                            {{ $withdrawal->wallet_address ?? trim(($withdrawal->bank_name ?? '') . ' · ' . ($withdrawal->account_number ?? ''), ' ·') ?: '—' }}
                        </td>
                        <td>${{ number_format($withdrawal->amount, 2) }}</td>
                        <td>${{ number_format($withdrawal->fee, 2) }}</td>
                        <td>
                            <span class="badge {{ $withdrawal->status === \App\Models\Withdrawal::STATUS_APPROVED ? 'badge-approved' : 'badge-pending' }}">
                                {{ $withdrawal->status === \App\Models\Withdrawal::STATUS_APPROVED ? 'Approved' : 'Pending' }}
                            </span>
                        </td>
                        <td>{{ $withdrawal->created_at->format('M d, Y') }}</td>
                        <td class="text-end">
                            @if ($withdrawal->status === \App\Models\Withdrawal::STATUS_PENDING)
                                <form method="POST" action="{{ route('admin.withdrawals.approve', $withdrawal) }}" onsubmit="return confirm('Approve this withdrawal?')">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td class="text-center py-4" colspan="8">No withdrawals found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $withdrawals->links() }}
    </div>
</div>

@include('admin.footer')
