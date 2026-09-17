@include('admin.header', ['title' => 'NFTs', 'heading' => 'NFT Moderation'])

<div class="card">
    <div class="card-header">
        <form method="GET" class="d-flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name" class="form-control">
            <button type="submit" class="btn btn-primary text-nowrap">Search</button>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Owner</th>
                    <th>Collection</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Featured</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($nfts as $nft)
                    <tr>
                        <td class="text-light">{{ $nft->name }}</td>
                        <td>
                            @if ($nft->owner)
                                <a href="{{ route('admin.users.show', $nft->owner) }}">{{ $nft->owner->name }}</a>
                            @else
                                —
                            @endif
                        </td>
                        <td>{{ $nft->collection->name ?? '—' }}</td>
                        <td>{{ \App\Models\Nft::CATEGORIES[$nft->category] ?? $nft->category }}</td>
                        <td>{{ $nft->price }} ETH</td>
                        <td>
                            <span class="badge {{ $nft->is_featured ? 'badge-approved' : 'badge-pending' }}">{{ $nft->is_featured ? 'Featured' : 'Standard' }}</span>
                        </td>
                        <td class="text-end">
                            <form method="POST" action="{{ route('admin.nfts.toggle-feature', $nft) }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-primary">{{ $nft->is_featured ? 'Unfeature' : 'Feature' }}</button>
                            </form>
                            <form method="POST" action="{{ route('admin.nfts.destroy', $nft) }}" class="d-inline" onsubmit="return confirm('Delete this NFT?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td class="text-center py-4" colspan="7">No NFTs found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $nfts->links() }}
    </div>
</div>

@include('admin.footer')
