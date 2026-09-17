@include('admin.header', ['title' => 'NFT Collections', 'heading' => 'NFT Collections'])

<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin.nft-collections.create') }}" class="btn btn-primary">Add Collection</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>NFTs</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($collections as $collection)
                    <tr>
                        <td class="text-light">{{ $collection->name }}</td>
                        <td>{{ $collection->slug }}</td>
                        <td>{{ $collection->nfts_count }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.nft-collections.edit', $collection) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form method="POST" action="{{ route('admin.nft-collections.destroy', $collection) }}" class="d-inline" onsubmit="return confirm('Delete this collection?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td class="text-center py-4" colspan="4">No collections found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $collections->links() }}
    </div>
</div>

@include('admin.footer')
