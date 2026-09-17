@include('admin.header', ['title' => 'Pre-IPO Companies', 'heading' => 'Pre-IPO Companies'])

<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin.pre-ipo-companies.create') }}" class="btn btn-primary">Add Company</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Company</th>
                    <th>Share Price</th>
                    <th>Shares Sold</th>
                    <th>Holdings</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($companies as $company)
                    <tr>
                        <td class="text-light">{{ $company->name }} <span class="text-body-secondary">({{ $company->symbol }})</span></td>
                        <td>${{ number_format($company->share_price, 2) }}</td>
                        <td>{{ number_format($company->shares_sold) }} / {{ number_format($company->total_shares) }}</td>
                        <td>
                            <a href="{{ route('admin.pre-ipo-holdings', ['company' => $company->id]) }}">{{ $company->holdings_count }}</a>
                        </td>
                        <td><span class="badge {{ $company->status === 'open' ? 'badge-approved' : 'badge-pending' }}">{{ ucfirst($company->status) }}</span></td>
                        <td class="text-end">
                            <a href="{{ route('admin.pre-ipo-companies.edit', $company) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form method="POST" action="{{ route('admin.pre-ipo-companies.destroy', $company) }}" class="d-inline" onsubmit="return confirm('Delete this company?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td class="text-center py-4" colspan="6">No companies found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $companies->links() }}
    </div>
</div>

@include('admin.footer')
