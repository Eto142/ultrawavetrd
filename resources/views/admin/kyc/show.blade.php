@include('admin.header', ['title' => 'KYC Review', 'heading' => 'KYC Submission Review'])

<div class="mb-3">
    <a href="{{ route('admin.kyc') }}"><i class="bi bi-arrow-left"></i> Back to KYC review</a>
</div>

<div class="row g-3">
    <div class="col-lg-4">
        <div class="card p-3">
            <h2 class="h6 text-light mb-3">Applicant</h2>
            <dl class="row small mb-4">
                <dt class="col-6 text-body-secondary">Name</dt><dd class="col-6 text-end text-light">{{ $submission->user->name ?? '—' }}</dd>
                <dt class="col-6 text-body-secondary">Email</dt><dd class="col-6 text-end text-light">{{ $submission->user->email ?? '—' }}</dd>
                <dt class="col-6 text-body-secondary">Document Type</dt><dd class="col-6 text-end text-light">{{ \App\Models\KycSubmission::DOCUMENT_TYPES[$submission->document_type] ?? $submission->document_type }}</dd>
                <dt class="col-6 text-body-secondary">Document No.</dt><dd class="col-6 text-end text-light">{{ $submission->document_number }}</dd>
                <dt class="col-6 text-body-secondary">Date of Birth</dt><dd class="col-6 text-end text-light">{{ $submission->date_of_birth?->format('M d, Y') }}</dd>
                <dt class="col-6 text-body-secondary">Country</dt><dd class="col-6 text-end text-light">{{ $submission->country }}</dd>
                <dt class="col-6 text-body-secondary">Status</dt>
                <dd class="col-6 text-end">
                    <span class="badge {{ $submission->isApproved() ? 'badge-approved' : ($submission->isRejected() ? 'badge-rejected' : 'badge-pending') }}">{{ $submission->statusLabel() }}</span>
                </dd>
                @if ($submission->isRejected() && $submission->rejection_reason)
                    <dt class="col-12 text-body-secondary mt-2">Rejection Reason</dt>
                    <dd class="col-12 text-loss">{{ $submission->rejection_reason }}</dd>
                @endif
            </dl>

            @if ($submission->isPending())
                <form method="POST" action="{{ route('admin.kyc.approve', $submission) }}" class="mb-2" onsubmit="return confirm('Approve this KYC submission?')">
                    @csrf
                    <button type="submit" class="btn btn-success w-100">Approve</button>
                </form>
                <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#rejectKycModal">Reject</button>
            @endif
        </div>
    </div>

    <div class="col-lg-8">
        <div class="row g-3">
            @if ($submission->front_document_path)
                <div class="col-md-6">
                    <div class="card p-2">
                        <p class="text-body-secondary text-uppercase small mb-2 px-1">Document Front</p>
                        <a href="{{ asset('storage/' . $submission->front_document_path) }}" target="_blank">
                            <img src="{{ asset('storage/' . $submission->front_document_path) }}" class="img-fluid rounded">
                        </a>
                    </div>
                </div>
            @endif
            @if ($submission->back_document_path)
                <div class="col-md-6">
                    <div class="card p-2">
                        <p class="text-body-secondary text-uppercase small mb-2 px-1">Document Back</p>
                        <a href="{{ asset('storage/' . $submission->back_document_path) }}" target="_blank">
                            <img src="{{ asset('storage/' . $submission->back_document_path) }}" class="img-fluid rounded">
                        </a>
                    </div>
                </div>
            @endif
            @if ($submission->selfie_path)
                <div class="col-md-6">
                    <div class="card p-2">
                        <p class="text-body-secondary text-uppercase small mb-2 px-1">Selfie</p>
                        <a href="{{ asset('storage/' . $submission->selfie_path) }}" target="_blank">
                            <img src="{{ asset('storage/' . $submission->selfie_path) }}" class="img-fluid rounded">
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="rejectKycModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.kyc.reject', $submission) }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title text-light">Reject KYC Submission</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label text-light">Reason for rejection</label>
                    <textarea name="rejection_reason" rows="3" class="form-control" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Confirm Rejection</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('admin.footer')
