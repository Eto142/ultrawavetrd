@include('admin.header', ['title' => 'Investments', 'heading' => 'Investments'])

<div class="card">
    <div class="card-header">
        <div class="btn-group">
            <a href="{{ route('admin.investments') }}" class="btn btn-sm {{ ! request()->filled('status') ? 'btn-primary' : 'btn-outline-secondary' }}">All</a>
            <a href="{{ route('admin.investments', ['status' => 0]) }}" class="btn btn-sm {{ request('status') === '0' ? 'btn-primary' : 'btn-outline-secondary' }}">Pending</a>
            <a href="{{ route('admin.investments', ['status' => 1]) }}" class="btn btn-sm {{ request('status') === '1' ? 'btn-primary' : 'btn-outline-secondary' }}">Approved</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Plan</th>
                    <th>Amount</th>
                    <th>Payment Method</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($investments as $investment)
                    <tr>
                        <td>
                            @if ($investment->user)
                                <a href="{{ route('admin.users.show', $investment->user) }}" class="text-light">{{ $investment->user->name }}</a>
                            @else
                                <span class="text-body-secondary">Unknown</span>
                            @endif
                        </td>
                        <td>{{ $investment->investmentPlan->name ?? '—' }}</td>
                        <td>${{ number_format($investment->amount, 2) }}</td>
                        <td>{{ $investment->payment_method }}</td>
                        <td>
                            <span class="badge {{ $investment->status === \App\Models\Investment::STATUS_APPROVED ? 'badge-approved' : 'badge-pending' }}">
                                {{ $investment->status === \App\Models\Investment::STATUS_APPROVED ? 'Approved' : 'Pending' }}
                            </span>
                        </td>
                        <td>{{ $investment->created_at->format('M d, Y') }}</td>
                        <td class="text-end">
                            @if ($investment->status === \App\Models\Investment::STATUS_PENDING)
                                <form method="POST" action="{{ route('admin.investments.approve', $investment) }}" onsubmit="return confirm('Approve this investment?')">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td class="text-center py-4" colspan="7">No investments found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $investments->links() }}
    </div>
</div>

@include('admin.footer')
