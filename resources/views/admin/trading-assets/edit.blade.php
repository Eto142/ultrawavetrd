@include('admin.header', ['title' => 'Edit Trading Asset', 'heading' => 'Edit Trading Asset'])

<div class="mb-3"><a href="{{ route('admin.trading-assets') }}"><i class="bi bi-arrow-left"></i> Back to trading assets</a></div>

<div class="card p-4" style="max-width: 720px;">
    <form method="POST" action="{{ route('admin.trading-assets.update', $asset) }}">
        @include('admin.trading-assets._form')
    </form>
</div>

@include('admin.footer')
