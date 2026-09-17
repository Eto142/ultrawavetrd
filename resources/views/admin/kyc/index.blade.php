@include('admin.header', ['title' => 'KYC Review', 'heading' => 'KYC Review'])

<div class="card">
    <div class="card-header">
        <div class="btn-group">
            <a href="{{ route('admin.kyc') }}" class="btn btn-sm {{ ! request()->filled('status') ? 'btn-primary' : 'btn-outline-secondary' }}">All</a>
            <a href="{{ route('admin.kyc', ['status' => 0]) }}" class="btn btn-sm {{ request('status') === '0' ? 'btn-primary' : 'btn-outline-secondary' }}">Pending</a>
            <a href="{{ route('admin.kyc', ['status' => 1]) }}" class="btn btn-sm {{ request('status') === '1' ? 'btn-primary' : 'btn-outline-secondary' }}">Approved</a>
            <a href="{{ route('admin.kyc', ['status' => 2]) }}" class="btn btn-sm {{ request('status') === '2' ? 'btn-primary' : 'btn-outline-secondary' }}">Rejected</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Document Type</th>
                    <th>Country</th>
                    <th>Status</th>
                    <th>Submitted</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($submissions as $submission)
                    <tr>
                        <td>
                            @if ($submission->user)
                                <a href="{{ route('admin.users.show', $submission->user) }}" class="text-light">{{ $submission->user->name }}</a>
                            @else
                                <span class="text-body-secondary">Unknown</span>
                            @endif
                        </td>
                        <td>{{ \App\Models\KycSubmission::DOCUMENT_TYPES[$submission->document_type] ?? $submission->document_type }}</td>
                        <td>{{ $submission->country }}</td>
                        <td>
                            <span class="badge {{ $submission->isApproved() ? 'badge-approved' : ($submission->isRejected() ? 'badge-rejected' : 'badge-pending') }}">
                                {{ $submission->statusLabel() }}
                            </span>
                        </td>
                        <td>{{ $submission->created_at->format('M d, Y') }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.kyc.show', $submission) }}" class="btn btn-sm btn-outline-primary">Review</a>
                        </td>
                    </tr>
                @empty
                    <tr><td class="text-center py-4" colspan="6">No KYC submissions found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $submissions->links() }}
    </div>
</div>

@include('admin.footer')
