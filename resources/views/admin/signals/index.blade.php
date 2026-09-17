@include('admin.header', ['title' => 'Signals', 'heading' => 'Trading Signals'])

<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin.signals.create') }}" class="btn btn-primary">Add Signal</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Symbol</th>
                    <th>Direction</th>
                    <th>Entry</th>
                    <th>TP / SL</th>
                    <th>Status</th>
                    <th>Active</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($signals as $signal)
                    <tr>
                        <td class="text-light">{{ $signal->symbol }}</td>
                        <td><span class="badge {{ $signal->direction === 'buy' ? 'badge-approved' : 'badge-rejected' }}">{{ ucfirst($signal->direction) }}</span></td>
                        <td>{{ $signal->entry_price }}</td>
                        <td>{{ $signal->take_profit ?? '—' }} / {{ $signal->stop_loss ?? '—' }}</td>
                        <td class="text-capitalize">{{ str_replace('_', ' ', $signal->status) }}</td>
                        <td><span class="badge {{ $signal->is_active ? 'badge-approved' : 'badge-pending' }}">{{ $signal->is_active ? 'Yes' : 'No' }}</span></td>
                        <td class="text-end">
                            <a href="{{ route('admin.signals.edit', $signal) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form method="POST" action="{{ route('admin.signals.destroy', $signal) }}" class="d-inline" onsubmit="return confirm('Delete this signal?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td class="text-center py-4" colspan="7">No signals found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $signals->links() }}
    </div>
</div>

@include('admin.footer')
