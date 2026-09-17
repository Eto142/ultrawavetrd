@include('admin.header', ['title' => 'Edit Trader', 'heading' => 'Edit Trader'])

<div class="mb-3"><a href="{{ route('admin.traders') }}"><i class="bi bi-arrow-left"></i> Back to traders</a></div>

<div class="card p-4" style="max-width: 720px;">
    <form method="POST" action="{{ route('admin.traders.update', $trader) }}">
        @include('admin.traders._form')
    </form>
</div>

@include('admin.footer')
