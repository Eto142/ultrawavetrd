@include('admin.header', ['title' => 'Trades', 'heading' => 'Trades'])

<div class="card">
    <div class="card-header">
        <div class="btn-group flex-wrap">
            <a href="{{ route('admin.trades') }}" class="btn btn-sm {{ ! request()->filled('status') && ! request()->filled('pending_close') ? 'btn-primary' : 'btn-outline-secondary' }}">All</a>
            <a href="{{ route('admin.trades', ['status' => 'open']) }}" class="btn btn-sm {{ request('status') === 'open' ? 'btn-primary' : 'btn-outline-secondary' }}">Open</a>
            <a href="{{ route('admin.trades', ['pending_close' => 1]) }}" class="btn btn-sm {{ request()->filled('pending_close') ? 'btn-primary' : 'btn-outline-secondary' }}">Pending Close</a>
            <a href="{{ route('admin.trades', ['status' => 'won']) }}" class="btn btn-sm {{ request('status') === 'won' ? 'btn-primary' : 'btn-outline-secondary' }}">Won</a>
            <a href="{{ route('admin.trades', ['status' => 'lost']) }}" class="btn btn-sm {{ request('status') === 'lost' ? 'btn-primary' : 'btn-outline-secondary' }}">Lost</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Asset</th>
                    <th>Type / Side</th>
                    <th>Amount</th>
                    <th>Entry</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($trades as $trade)
                    <tr>
                        <td>
                            @if ($trade->user)
                                <a href="{{ route('admin.users.show', $trade->user) }}" class="text-light">{{ $trade->user->name }}</a>
                            @else
                                <span class="text-body-secondary">Unknown</span>
                            @endif
                        </td>
                        <td>{{ $trade->tradingAsset->symbol ?? '—' }}</td>
                        <td class="text-capitalize">{{ $trade->trade_type }} / {{ $trade->side }}</td>
                        <td>${{ number_format($trade->amount, 2) }}</td>
                        <td>{{ $trade->entry_price }}</td>
                        <td>
                            <span class="badge {{ $trade->status === 'won' ? 'badge-approved' : ($trade->status === 'lost' ? 'badge-rejected' : 'badge-pending') }}">{{ ucfirst($trade->status) }}</span>
                            @if ($trade->isPendingClose())
                                <span class="badge badge-pending ms-1">Close Requested</span>
                            @endif
                        </td>
                        <td class="text-end">
                            @if ($trade->status === \App\Models\Trade::STATUS_OPEN)
                                <a href="{{ route('admin.trades.settle', $trade) }}" class="btn btn-sm btn-outline-primary">Settle</a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td class="text-center py-4" colspan="7">No trades found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $trades->links() }}
    </div>
</div>

@include('admin.footer')
