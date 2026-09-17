@include('admin.header', ['title' => 'Course Enrollments', 'heading' => 'Course Enrollments'])

<div class="card">
    <div class="card-header">
        <div class="btn-group">
            <a href="{{ route('admin.course-enrollments') }}" class="btn btn-sm {{ ! request()->filled('status') ? 'btn-primary' : 'btn-outline-secondary' }}">All</a>
            <a href="{{ route('admin.course-enrollments', ['status' => 0]) }}" class="btn btn-sm {{ request('status') === '0' ? 'btn-primary' : 'btn-outline-secondary' }}">Pending</a>
            <a href="{{ route('admin.course-enrollments', ['status' => 1]) }}" class="btn btn-sm {{ request('status') === '1' ? 'btn-primary' : 'btn-outline-secondary' }}">Active</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Course</th>
                    <th>Progress</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($enrollments as $enrollment)
                    <tr>
                        <td>
                            @if ($enrollment->user)
                                <a href="{{ route('admin.users.show', $enrollment->user) }}" class="text-light">{{ $enrollment->user->name }}</a>
                            @else
                                <span class="text-body-secondary">Unknown</span>
                            @endif
                        </td>
                        <td>{{ $enrollment->course->title ?? '—' }}</td>
                        <td>{{ $enrollment->progress_percent }}%</td>
                        <td>
                            <span class="badge {{ $enrollment->isActive() ? 'badge-approved' : 'badge-pending' }}">{{ $enrollment->isActive() ? 'Active' : 'Pending' }}</span>
                        </td>
                        <td>{{ $enrollment->created_at->format('M d, Y') }}</td>
                        <td class="text-end">
                            @if (! $enrollment->isActive())
                                <form method="POST" action="{{ route('admin.course-enrollments.approve', $enrollment) }}" onsubmit="return confirm('Approve this enrollment?')">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td class="text-center py-4" colspan="6">No enrollments found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $enrollments->links() }}
    </div>
</div>

@include('admin.footer')
