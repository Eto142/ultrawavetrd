@include('admin.header', ['title' => 'Add Signal Plan', 'heading' => 'Add Signal Plan'])

<div class="mb-3"><a href="{{ route('admin.signal-plans') }}"><i class="bi bi-arrow-left"></i> Back to signal plans</a></div>

<div class="card p-4" style="max-width: 640px;">
    <form method="POST" action="{{ route('admin.signal-plans.store') }}">
        @include('admin.signal-plans._form')
    </form>
</div>

@include('admin.footer')
