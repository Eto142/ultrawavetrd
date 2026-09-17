@include('admin.header', ['title' => 'Edit Lesson', 'heading' => 'Edit Lesson — ' . $course->title])

<div class="mb-3"><a href="{{ route('admin.lessons', $course) }}"><i class="bi bi-arrow-left"></i> Back to lessons</a></div>

<div class="card p-4" style="max-width: 640px;">
    <form method="POST" action="{{ route('admin.lessons.update', $lesson) }}">
        @include('admin.lessons._form')
    </form>
</div>

@include('admin.footer')
