@include('admin.header', ['title' => 'Add Signal', 'heading' => 'Add Signal'])

<div class="mb-3"><a href="{{ route('admin.signals') }}"><i class="bi bi-arrow-left"></i> Back to signals</a></div>

<div class="card p-4" style="max-width: 640px;">
    <form method="POST" action="{{ route('admin.signals.store') }}">
        @include('admin.signals._form')
    </form>
</div>

@include('admin.footer')
