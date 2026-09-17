@include('admin.header', ['title' => 'Courses', 'heading' => 'Courses'])

<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">Add Course</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Level</th>
                    <th>Enrollments</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($courses as $course)
                    <tr>
                        <td class="text-light">{{ $course->title }}</td>
                        <td>{{ $course->category->name ?? '—' }}</td>
                        <td>{{ $course->isFree() ? 'Free' : '$' . number_format($course->price, 2) }}</td>
                        <td class="text-capitalize">{{ $course->level }}</td>
                        <td>
                            <a href="{{ route('admin.course-enrollments', ['course' => $course->id]) }}">{{ $course->enrollments_count }}</a>
                        </td>
                        <td><span class="badge {{ $course->is_active ? 'badge-approved' : 'badge-pending' }}">{{ $course->is_active ? 'Active' : 'Inactive' }}</span></td>
                        <td class="text-end">
                            <a href="{{ route('admin.lessons', ['course' => $course->id]) }}" class="btn btn-sm btn-outline-primary">Lessons</a>
                            <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form method="POST" action="{{ route('admin.courses.destroy', $course) }}" class="d-inline" onsubmit="return confirm('Delete this course?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td class="text-center py-4" colspan="7">No courses found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $courses->links() }}
    </div>
</div>

@include('admin.footer')
