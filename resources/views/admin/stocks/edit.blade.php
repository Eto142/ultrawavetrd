@include('admin.header', ['title' => 'Edit Stock', 'heading' => 'Edit Stock'])

<div class="mb-3"><a href="{{ route('admin.stocks') }}"><i class="bi bi-arrow-left"></i> Back to stocks</a></div>

<div class="card p-4" style="max-width: 640px;">
    <form method="POST" action="{{ route('admin.stocks.update', $stock) }}">
        @include('admin.stocks._form')
    </form>
</div>

@include('admin.footer')
