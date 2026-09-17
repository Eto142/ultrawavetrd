@include('admin.header', ['title' => 'Balances', 'heading' => 'User Balances'])

<div class="card">
    <div class="card-header">
        <form method="GET" class="d-flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or email" class="form-control">
            <button type="submit" class="btn btn-primary text-nowrap">Search</button>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Deposited</th>
                    <th>Withdrawn</th>
                    <th>Bonus</th>
                    <th>Profit</th>
                    <th>Total Balance</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    @php($balance = $balances[$user->id])
                    <tr>
                        <td>
                            <a href="{{ route('admin.users.show', $user) }}" class="text-light">{{ $user->name }}</a>
                            <p class="text-body-secondary small mb-0">{{ $user->email }}</p>
                        </td>
                        <td>${{ number_format($balance->deposited, 2) }}</td>
                        <td>${{ number_format($balance->withdrawn, 2) }}</td>
                        <td>${{ number_format($balance->bonus, 2) }}</td>
                        <td>${{ number_format($balance->profit, 2) }}</td>
                        <td class="text-light fw-semibold">${{ number_format($balance->total, 2) }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-outline-primary">View</a>
                        </td>
                    </tr>
                @empty
                    <tr><td class="text-center py-4" colspan="7">No users found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $users->links() }}
    </div>
</div>

@include('admin.footer')
