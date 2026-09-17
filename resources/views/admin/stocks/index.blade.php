@include('admin.header', ['title' => 'Stocks', 'heading' => 'Stock Shares'])

<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin.stocks.create') }}" class="btn btn-primary">Add Stock</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Symbol</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Change</th>
                    <th>Orders</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($stocks as $stock)
                    <tr>
                        <td class="text-light">{{ $stock->symbol }}</td>
                        <td>{{ $stock->name }}</td>
                        <td>${{ number_format($stock->price, 2) }}</td>
                        <td>
                            <span class="{{ $stock->change_amount >= 0 ? 'text-gain' : 'text-loss' }}">
                                {{ $stock->change_amount >= 0 ? '+' : '' }}{{ number_format($stock->change_percent, 2) }}%
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.stock-orders', ['stock' => $stock->id]) }}">{{ $stock->orders_count }}</a>
                        </td>
                        <td><span class="badge {{ $stock->is_active ? 'badge-approved' : 'badge-pending' }}">{{ $stock->is_active ? 'Active' : 'Inactive' }}</span></td>
                        <td class="text-end">
                            <a href="{{ route('admin.stocks.edit', $stock) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form method="POST" action="{{ route('admin.stocks.destroy', $stock) }}" class="d-inline" onsubmit="return confirm('Delete this stock?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td class="text-center py-4" colspan="7">No stocks found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $stocks->links() }}
    </div>
</div>

@include('admin.footer')
