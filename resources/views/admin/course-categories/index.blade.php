@include('admin.header', ['title' => 'Course Categories', 'heading' => 'Course Categories'])

<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin.course-categories.create') }}" class="btn btn-primary">Add Category</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Courses</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td class="text-light">{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->courses_count }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.course-categories.edit', $category) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form method="POST" action="{{ route('admin.course-categories.destroy', $category) }}" class="d-inline" onsubmit="return confirm('Delete this category?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td class="text-center py-4" colspan="4">No categories found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $categories->links() }}
    </div>
</div>

@include('admin.footer')
