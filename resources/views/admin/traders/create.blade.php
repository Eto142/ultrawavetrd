@include('admin.header', ['title' => 'Add Trader', 'heading' => 'Add Trader'])

<div class="mb-3"><a href="{{ route('admin.traders') }}"><i class="bi bi-arrow-left"></i> Back to traders</a></div>

<div class="card p-4" style="max-width: 720px;">
    <form method="POST" action="{{ route('admin.traders.store') }}">
        @include('admin.traders._form')
    </form>
</div>

@include('admin.footer')
