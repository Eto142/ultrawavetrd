@include('admin.header', ['title' => 'Admin Accounts', 'heading' => 'Admin Accounts'])

<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin.admins.create') }}" class="btn btn-primary">Add Admin</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($admins as $admin)
                    <tr>
                        <td class="text-light">{{ $admin->name }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>{{ $admin->created_at->format('M d, Y') }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.admins.edit', $admin) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            @if ($admin->id !== auth('admin')->id())
                                <form method="POST" action="{{ route('admin.admins.destroy', $admin) }}" class="d-inline" onsubmit="return confirm('Remove this admin account?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td class="text-center py-4" colspan="4">No admin accounts found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $admins->links() }}
    </div>
</div>

@include('admin.footer')
