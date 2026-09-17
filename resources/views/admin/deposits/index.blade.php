@include('admin.header', ['title' => 'Deposits', 'heading' => 'Deposits'])

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div class="btn-group">
            <a href="{{ route('admin.deposits') }}" class="btn btn-sm {{ ! request()->filled('status') ? 'btn-primary' : 'btn-outline-secondary' }}">All</a>
            <a href="{{ route('admin.deposits', ['status' => 0]) }}" class="btn btn-sm {{ request('status') === '0' ? 'btn-primary' : 'btn-outline-secondary' }}">Pending</a>
            <a href="{{ route('admin.deposits', ['status' => 1]) }}" class="btn btn-sm {{ request('status') === '1' ? 'btn-primary' : 'btn-outline-secondary' }}">Approved</a>
        </div>
        @if (request()->filled('user'))
            <a href="{{ route('admin.deposits') }}" class="small">Clear user filter</a>
        @endif
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Method</th>
                    <th>Amount</th>
                    <th>Proof</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($deposits as $deposit)
                    <tr>
                        <td>
                            @if ($deposit->user)
                                <a href="{{ route('admin.users.show', $deposit->user) }}" class="text-light">{{ $deposit->user->name }}</a>
                            @else
                                <span class="text-body-secondary">Unknown</span>
                            @endif
                        </td>
                        <td>{{ $deposit->method }}</td>
                        <td>${{ number_format($deposit->amount, 2) }}</td>
                        <td>
                            @if ($deposit->proof)
                                <a href="{{ asset('storage/' . $deposit->proof) }}" target="_blank">View</a>
                            @else
                                —
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $deposit->status === \App\Models\Deposit::STATUS_APPROVED ? 'badge-approved' : 'badge-pending' }}">
                                {{ $deposit->status === \App\Models\Deposit::STATUS_APPROVED ? 'Approved' : 'Pending' }}
                            </span>
                        </td>
                        <td>{{ $deposit->created_at->format('M d, Y') }}</td>
                        <td class="text-end">
                            @if ($deposit->status === \App\Models\Deposit::STATUS_PENDING)
                                <form method="POST" action="{{ route('admin.deposits.approve', $deposit) }}" onsubmit="return confirm('Approve this deposit?')">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td class="text-center py-4" colspan="7">No deposits found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $deposits->links() }}
    </div>
</div>

@include('admin.footer')
