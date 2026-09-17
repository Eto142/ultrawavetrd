@include('admin.header', ['title' => 'Add Lesson', 'heading' => 'Add Lesson — ' . $course->title])

<div class="mb-3"><a href="{{ route('admin.lessons', $course) }}"><i class="bi bi-arrow-left"></i> Back to lessons</a></div>

<div class="card p-4" style="max-width: 640px;">
    <form method="POST" action="{{ route('admin.lessons.store', $course) }}">
        @include('admin.lessons._form')
    </form>
</div>

@include('admin.footer')
