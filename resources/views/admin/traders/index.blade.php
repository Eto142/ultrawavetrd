@include('admin.header', ['title' => 'Traders', 'heading' => 'Copy Trading — Traders'])

<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin.traders.create') }}" class="btn btn-primary">Add Trader</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Style</th>
                    <th>Win Rate</th>
                    <th>Followers</th>
                    <th>Subscribers</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($traders as $trader)
                    <tr>
                        <td class="text-light">{{ $trader->name }} @if($trader->is_verified)<span class="badge badge-approved ms-1">Verified</span>@endif</td>
                        <td>{{ $trader->style_label ?? '—' }}</td>
                        <td>{{ number_format($trader->win_rate_pct, 1) }}%</td>
                        <td>{{ number_format($trader->followers_count) }}</td>
                        <td>
                            <a href="{{ route('admin.copy-trading-subscriptions', ['trader' => $trader->id]) }}">{{ $trader->subscriptions_count }}</a>
                        </td>
                        <td><span class="badge {{ $trader->is_active ? 'badge-approved' : 'badge-pending' }}">{{ $trader->is_active ? 'Active' : 'Inactive' }}</span></td>
                        <td class="text-end">
                            <a href="{{ route('admin.traders.edit', $trader) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form method="POST" action="{{ route('admin.traders.destroy', $trader) }}" class="d-inline" onsubmit="return confirm('Delete this trader?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td class="text-center py-4" colspan="7">No traders found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $traders->links() }}
    </div>
</div>

@include('admin.footer')
