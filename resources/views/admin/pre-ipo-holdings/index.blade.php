@include('admin.header', ['title' => 'Pre-IPO Holdings', 'heading' => 'Pre-IPO Holdings'])

<div class="card">
    <div class="card-header">
        <div class="btn-group">
            <a href="{{ route('admin.pre-ipo-holdings') }}" class="btn btn-sm {{ ! request()->filled('status') ? 'btn-primary' : 'btn-outline-secondary' }}">All</a>
            <a href="{{ route('admin.pre-ipo-holdings', ['status' => 0]) }}" class="btn btn-sm {{ request('status') === '0' ? 'btn-primary' : 'btn-outline-secondary' }}">Pending</a>
            <a href="{{ route('admin.pre-ipo-holdings', ['status' => 1]) }}" class="btn btn-sm {{ request('status') === '1' ? 'btn-primary' : 'btn-outline-secondary' }}">Approved</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Company</th>
                    <th>Quantity</th>
                    <th>Total Cost</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($holdings as $holding)
                    <tr>
                        <td>
                            @if ($holding->user)
                                <a href="{{ route('admin.users.show', $holding->user) }}" class="text-light">{{ $holding->user->name }}</a>
                            @else
                                <span class="text-body-secondary">Unknown</span>
                            @endif
                        </td>
                        <td>{{ $holding->preIpoCompany->name ?? '—' }}</td>
                        <td>{{ number_format($holding->quantity) }}</td>
                        <td>${{ number_format($holding->total_cost, 2) }}</td>
                        <td><span class="badge {{ $holding->status === \App\Models\PreIpoHolding::STATUS_APPROVED ? 'badge-approved' : 'badge-pending' }}">{{ $holding->status === \App\Models\PreIpoHolding::STATUS_APPROVED ? 'Approved' : 'Pending' }}</span></td>
                        <td class="text-end">
                            @if ($holding->status === \App\Models\PreIpoHolding::STATUS_PENDING)
                                <form method="POST" action="{{ route('admin.pre-ipo-holdings.approve', $holding) }}" onsubmit="return confirm('Approve this holding?')">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td class="text-center py-4" colspan="6">No holdings found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $holdings->links() }}
    </div>
</div>

@include('admin.footer')
