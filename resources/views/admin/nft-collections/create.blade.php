@include('admin.header', ['title' => 'Add Collection', 'heading' => 'Add NFT Collection'])

<div class="mb-3"><a href="{{ route('admin.nft-collections') }}"><i class="bi bi-arrow-left"></i> Back to collections</a></div>

<div class="card p-4" style="max-width: 480px;">
    <form method="POST" action="{{ route('admin.nft-collections.store') }}">
        @include('admin.nft-collections._form')
    </form>
</div>

@include('admin.footer')
