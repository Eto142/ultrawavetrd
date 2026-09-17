@include('admin.header', ['title' => 'Transactions', 'heading' => 'Transaction Ledger'])

<div class="card">
    <div class="card-header">
        <form method="GET" class="row g-2 align-items-center">
            <div class="col-auto">
                <select name="type" class="form-select" onchange="this.form.submit()">
                    <option value="">All Types</option>
                    <option value="credit" @selected(request('type') === 'credit')>Credit</option>
                    <option value="debit" @selected(request('type') === 'debit')>Debit</option>
                </select>
            </div>
            <div class="col-auto">
                <select name="category" class="form-select" onchange="this.form.submit()">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category }}" @selected(request('category') === $category)>{{ ucfirst(str_replace('_', ' ', $category)) }}</option>
                    @endforeach
                </select>
            </div>
            @if (request()->filled('user'))
                <div class="col-auto">
                    <a href="{{ route('admin.transactions') }}" class="btn btn-outline-secondary btn-sm">Clear user filter</a>
                </div>
            @endif
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>User</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th class="text-end">Amount</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->created_at->format('M d, Y g:i A') }}</td>
                        <td>
                            @if ($transaction->user)
                                <a href="{{ route('admin.users.show', $transaction->user) }}" class="text-light">{{ $transaction->user->name }}</a>
                            @else
                                <span class="text-body-secondary">Unknown</span>
                            @endif
                        </td>
                        <td class="text-capitalize">{{ str_replace('_', ' ', $transaction->category) }}</td>
                        <td>{{ $transaction->description ?? '—' }}</td>
                        <td>
                            <span class="badge {{ $transaction->type === 'credit' ? 'badge-approved' : 'badge-rejected' }}">{{ ucfirst($transaction->type) }}</span>
                        </td>
                        <td class="text-end {{ $transaction->type === 'credit' ? 'text-gain' : 'text-loss' }}">
                            {{ $transaction->type === 'credit' ? '+' : '-' }}${{ number_format($transaction->amount, 2) }}
                        </td>
                    </tr>
                @empty
                    <tr><td class="text-center py-4" colspan="6">No transactions found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $transactions->links() }}
    </div>
</div>

@include('admin.footer')
