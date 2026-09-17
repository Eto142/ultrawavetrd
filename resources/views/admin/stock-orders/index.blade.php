@include('admin.header', ['title' => 'Stock Orders', 'heading' => 'Stock Orders'])

<div class="card">
    <div class="card-header">
        <div class="btn-group">
            <a href="{{ route('admin.stock-orders') }}" class="btn btn-sm {{ ! request()->filled('status') ? 'btn-primary' : 'btn-outline-secondary' }}">All</a>
            <a href="{{ route('admin.stock-orders', ['status' => 0]) }}" class="btn btn-sm {{ request('status') === '0' ? 'btn-primary' : 'btn-outline-secondary' }}">Pending</a>
            <a href="{{ route('admin.stock-orders', ['status' => 1]) }}" class="btn btn-sm {{ request('status') === '1' ? 'btn-primary' : 'btn-outline-secondary' }}">Approved</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Stock</th>
                    <th>Side</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td>
                            @if ($order->user)
                                <a href="{{ route('admin.users.show', $order->user) }}" class="text-light">{{ $order->user->name }}</a>
                            @else
                                <span class="text-body-secondary">Unknown</span>
                            @endif
                        </td>
                        <td>{{ $order->stock->symbol ?? '—' }}</td>
                        <td><span class="badge {{ $order->side === 'buy' ? 'badge-approved' : 'badge-rejected' }}">{{ ucfirst($order->side) }}</span></td>
                        <td>{{ rtrim(rtrim(number_format($order->quantity, 8), '0'), '.') }}</td>
                        <td>${{ number_format($order->amount, 2) }}</td>
                        <td><span class="badge {{ $order->status === \App\Models\StockOrder::STATUS_APPROVED ? 'badge-approved' : 'badge-pending' }}">{{ $order->status === \App\Models\StockOrder::STATUS_APPROVED ? 'Approved' : 'Pending' }}</span></td>
                        <td class="text-end">
                            @if ($order->status === \App\Models\StockOrder::STATUS_PENDING)
                                <form method="POST" action="{{ route('admin.stock-orders.approve', $order) }}" onsubmit="return confirm('Approve this order?')">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td class="text-center py-4" colspan="7">No orders found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $orders->links() }}
    </div>
</div>

@include('admin.footer')
