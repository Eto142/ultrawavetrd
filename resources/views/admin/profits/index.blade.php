@include('admin.header', ['title' => 'Profits', 'heading' => 'Profits'])

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
        <p class="mb-0 text-light">Profit credits added to user accounts</p>
        @if (request()->filled('user'))
            <a href="{{ route('admin.profits') }}" class="small">Clear user filter</a>
        @endif
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Amount</th>
                    <th>Description</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($profits as $profit)
                    <tr>
                        <td>
                            @if ($profit->user)
                                <a href="{{ route('admin.users.show', $profit->user) }}" class="text-light">{{ $profit->user->name }}</a>
                            @else
                                <span class="text-body-secondary">Unknown</span>
                            @endif
                        </td>
                        <td>${{ number_format($profit->amount, 2) }}</td>
                        <td>{{ $profit->description ?? '—' }}</td>
                        <td>{{ $profit->created_at->format('M d, Y') }}</td>
                    </tr>
                @empty
                    <tr><td class="text-center py-4" colspan="4">No profit credits found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $profits->links() }}
    </div>
</div>

@include('admin.footer')
