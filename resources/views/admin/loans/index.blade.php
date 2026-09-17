@include('admin.header', ['title' => 'Loans', 'heading' => 'Loans'])

<div class="card">
    <div class="card-header">
        <div class="btn-group">
            <a href="{{ route('admin.loans') }}" class="btn btn-sm {{ ! request()->filled('status') ? 'btn-primary' : 'btn-outline-secondary' }}">All</a>
            <a href="{{ route('admin.loans', ['status' => 0]) }}" class="btn btn-sm {{ request('status') === '0' ? 'btn-primary' : 'btn-outline-secondary' }}">Pending</a>
            <a href="{{ route('admin.loans', ['status' => 1]) }}" class="btn btn-sm {{ request('status') === '1' ? 'btn-primary' : 'btn-outline-secondary' }}">Approved</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Plan</th>
                    <th>Amount</th>
                    <th>Duration</th>
                    <th>Total Repayable</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($loans as $loan)
                    <tr>
                        <td>
                            @if ($loan->user)
                                <a href="{{ route('admin.users.show', $loan->user) }}" class="text-light">{{ $loan->user->name }}</a>
                            @else
                                <span class="text-body-secondary">Unknown</span>
                            @endif
                        </td>
                        <td>{{ $loan->loanPlan->name ?? '—' }}</td>
                        <td>${{ number_format($loan->amount, 2) }}</td>
                        <td>{{ $loan->duration }} mo</td>
                        <td>${{ number_format($loan->total_repayable, 2) }}</td>
                        <td>
                            <span class="badge {{ $loan->status === \App\Models\Loan::STATUS_APPROVED ? 'badge-approved' : 'badge-pending' }}">
                                {{ $loan->status === \App\Models\Loan::STATUS_APPROVED ? 'Approved' : 'Pending' }}
                            </span>
                        </td>
                        <td>{{ $loan->created_at->format('M d, Y') }}</td>
                        <td class="text-end">
                            @if ($loan->status === \App\Models\Loan::STATUS_PENDING)
                                <form method="POST" action="{{ route('admin.loans.approve', $loan) }}" onsubmit="return confirm('Approve this loan?')">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td class="text-center py-4" colspan="8">No loans found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $loans->links() }}
    </div>
</div>

@include('admin.footer')
