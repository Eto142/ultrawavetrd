@include('admin.header', ['title' => 'Lessons', 'heading' => 'Lessons — ' . $course->title])

<div class="d-flex justify-content-between mb-3">
    <a href="{{ route('admin.courses') }}" class="align-self-center"><i class="bi bi-arrow-left"></i> Back to courses</a>
    <a href="{{ route('admin.lessons.create', $course) }}" class="btn btn-primary">Add Lesson</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Duration</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($lessons as $lesson)
                    <tr>
                        <td>{{ $lesson->sort_order }}</td>
                        <td class="text-light">{{ $lesson->title }}</td>
                        <td>{{ $lesson->duration ?? '—' }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.lessons.edit', $lesson) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form method="POST" action="{{ route('admin.lessons.destroy', $lesson) }}" class="d-inline" onsubmit="return confirm('Delete this lesson?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td class="text-center py-4" colspan="4">No lessons yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $lessons->links() }}
    </div>
</div>

@include('admin.footer')
