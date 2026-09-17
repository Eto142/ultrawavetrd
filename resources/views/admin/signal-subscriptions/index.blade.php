@include('admin.header', ['title' => 'Signal Subscriptions', 'heading' => 'Signal Subscriptions'])

<div class="card">
    <div class="card-header">
        <div class="btn-group">
            <a href="{{ route('admin.signal-subscriptions') }}" class="btn btn-sm {{ ! request()->filled('status') ? 'btn-primary' : 'btn-outline-secondary' }}">All</a>
            <a href="{{ route('admin.signal-subscriptions', ['status' => 0]) }}" class="btn btn-sm {{ request('status') === '0' ? 'btn-primary' : 'btn-outline-secondary' }}">Pending</a>
            <a href="{{ route('admin.signal-subscriptions', ['status' => 1]) }}" class="btn btn-sm {{ request('status') === '1' ? 'btn-primary' : 'btn-outline-secondary' }}">Active</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Plan</th>
                    <th>Amount</th>
                    <th>Expires</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($subscriptions as $subscription)
                    <tr>
                        <td>
                            @if ($subscription->user)
                                <a href="{{ route('admin.users.show', $subscription->user) }}" class="text-light">{{ $subscription->user->name }}</a>
                            @else
                                <span class="text-body-secondary">Unknown</span>
                            @endif
                        </td>
                        <td>{{ $subscription->signalPlan->name ?? '—' }}</td>
                        <td>${{ number_format($subscription->amount, 2) }}</td>
                        <td>{{ $subscription->expires_at?->format('M d, Y') ?? '—' }}</td>
                        <td><span class="badge {{ $subscription->isActive() ? 'badge-approved' : 'badge-pending' }}">{{ $subscription->isActive() ? 'Active' : 'Pending' }}</span></td>
                        <td class="text-end">
                            @if ($subscription->status === \App\Models\SignalSubscription::STATUS_PENDING)
                                <form method="POST" action="{{ route('admin.signal-subscriptions.approve', $subscription) }}" onsubmit="return confirm('Approve this subscription?')">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td class="text-center py-4" colspan="6">No subscriptions found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $subscriptions->links() }}
    </div>
</div>

@include('admin.footer')
