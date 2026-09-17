@include('admin.header', ['title' => 'Add Category', 'heading' => 'Add Course Category'])

<div class="mb-3"><a href="{{ route('admin.course-categories') }}"><i class="bi bi-arrow-left"></i> Back to categories</a></div>

<div class="card p-4" style="max-width: 480px;">
    <form method="POST" action="{{ route('admin.course-categories.store') }}">
        @include('admin.course-categories._form')
    </form>
</div>

@include('admin.footer')
