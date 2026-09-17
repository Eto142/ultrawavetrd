@include('admin.header', ['title' => 'Bonuses', 'heading' => 'Bonuses'])

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
        <p class="mb-0 text-light">Bonus credits added to user accounts</p>
        @if (request()->filled('user'))
            <a href="{{ route('admin.bonuses') }}" class="small">Clear user filter</a>
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
                @forelse ($bonuses as $bonus)
                    <tr>
                        <td>
                            @if ($bonus->user)
                                <a href="{{ route('admin.users.show', $bonus->user) }}" class="text-light">{{ $bonus->user->name }}</a>
                            @else
                                <span class="text-body-secondary">Unknown</span>
                            @endif
                        </td>
                        <td>${{ number_format($bonus->amount, 2) }}</td>
                        <td>{{ $bonus->description ?? '—' }}</td>
                        <td>{{ $bonus->created_at->format('M d, Y') }}</td>
                    </tr>
                @empty
                    <tr><td class="text-center py-4" colspan="4">No bonus credits found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $bonuses->links() }}
    </div>
</div>

@include('admin.footer')
