@include('admin.header', ['title' => 'Trading Assets', 'heading' => 'Trading Assets'])

<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin.trading-assets.create') }}" class="btn btn-primary">Add Asset</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Symbol</th>
                    <th>Name</th>
                    <th>Class</th>
                    <th>Price</th>
                    <th>24h %</th>
                    <th>Trades</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($assets as $asset)
                    <tr>
                        <td class="text-light">{{ $asset->symbol }}</td>
                        <td>{{ $asset->name }}</td>
                        <td>{{ \App\Models\TradingAsset::ASSET_CLASSES[$asset->asset_class] ?? $asset->asset_class }}</td>
                        <td>{{ $asset->formattedPrice() }}</td>
                        <td>
                            <span class="{{ $asset->price_change_pct_24h >= 0 ? 'text-gain' : 'text-loss' }}">
                                {{ $asset->price_change_pct_24h >= 0 ? '+' : '' }}{{ number_format($asset->price_change_pct_24h, 2) }}%
                            </span>
                        </td>
                        <td>{{ $asset->trades_count }}</td>
                        <td><span class="badge {{ $asset->is_active ? 'badge-approved' : 'badge-pending' }}">{{ $asset->is_active ? 'Active' : 'Inactive' }}</span></td>
                        <td class="text-end">
                            <a href="{{ route('admin.trading-assets.edit', $asset) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form method="POST" action="{{ route('admin.trading-assets.destroy', $asset) }}" class="d-inline" onsubmit="return confirm('Delete this asset?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td class="text-center py-4" colspan="8">No trading assets found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $assets->links() }}
    </div>
</div>

@include('admin.footer')
