@include('admin.header', ['title' => 'Users', 'heading' => 'Users'])

<div class="card">
    <div class="card-header">
        <form method="GET" class="d-flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, email or username" class="form-control">
            <button type="submit" class="btn btn-primary text-nowrap">Search</button>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Country</th>
                    <th>KYC</th>
                    <th>Joined</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td class="text-light">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->country ?? '—' }}</td>
                        <td>
                            <span class="badge {{ $user->isKycApproved() ? 'badge-approved' : 'badge-pending' }}">
                                {{ $user->kycStatusLabel() }}
                            </span>
                        </td>
                        <td>{{ $user->created_at->format('M d, Y') }}</td>
                        <td class="text-end">
                            <div class="btn-group">
                                <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-outline-primary" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#sendMailModal" data-user-name="{{ $user->name }}" data-mail-action="{{ route('admin.users.mail', $user) }}" title="Send Mail">
                                    <i class="bi bi-envelope"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteUserModal" data-user-name="{{ $user->name }}" data-delete-action="{{ route('admin.users.destroy', $user) }}" title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td class="text-center py-4" colspan="6">No users found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $users->links() }}
    </div>
</div>

<!-- Send Mail Modal -->
<div class="modal fade" id="sendMailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title text-light">Send Mail to <span class="mail-user-name"></span></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label text-light">Subject</label>
                        <input type="text" name="subject" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-light">Message</label>
                        <textarea name="message" rows="5" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete User Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-light">Delete User</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="text-light">Are you sure you want to delete <span class="delete-user-name"></span>'s account? Everything associated with this account will be lost.</p>
            </div>
            <div class="modal-footer">
                <form method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Yes, I'm sure</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('sendMailModal').addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        this.querySelector('form').action = button.getAttribute('data-mail-action');
        this.querySelectorAll('.mail-user-name').forEach(function (el) {
            el.textContent = button.getAttribute('data-user-name');
        });
    });

    document.getElementById('deleteUserModal').addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        this.querySelector('form').action = button.getAttribute('data-delete-action');
        this.querySelectorAll('.delete-user-name').forEach(function (el) {
            el.textContent = button.getAttribute('data-user-name');
        });
    });
</script>
@endpush

@include('admin.footer')
