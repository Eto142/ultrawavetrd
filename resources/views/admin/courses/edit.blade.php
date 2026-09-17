@include('admin.header', ['title' => 'Edit Course', 'heading' => 'Edit Course'])

<div class="mb-3"><a href="{{ route('admin.courses') }}"><i class="bi bi-arrow-left"></i> Back to courses</a></div>

<div class="card p-4" style="max-width: 640px;">
    <form method="POST" action="{{ route('admin.courses.update', $course) }}">
        @include('admin.courses._form')
    </form>
</div>

@include('admin.footer')
