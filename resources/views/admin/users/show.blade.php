@include('admin.header', ['title' => $user->name, 'heading' => 'User Detail'])

<div class="card p-3 p-md-4 mb-4">
    <div class="d-flex flex-column-reverse flex-md-row justify-content-md-between align-items-md-start gap-3">
        <div class="d-flex gap-3 min-w-0 flex-grow-1">
            <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-25 text-primary fw-semibold flex-shrink-0" style="width:56px;height:56px;font-size:1.25rem;">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </span>
            <div class="min-w-0 flex-grow-1">
                <p class="stat-label mb-2">User Information</p>
                <h2 class="h4 text-primary mb-1 text-truncate">{{ ucwords($user->name) }}</h2>
                <p class="text-body-secondary mb-3 text-truncate">
                    <i class="bi bi-envelope me-1"></i>{{ $user->email }}
                </p>
                <div class="row g-3">
                    <div class="col-6 col-md-4">
                        <p class="stat-label mb-1">Phone</p>
                        <p class="text-light mb-0 text-truncate"><i class="bi bi-telephone text-body-secondary me-1"></i>{{ $user->phone ?? '—' }}</p>
                    </div>
                    <div class="col-6 col-md-4">
                        <p class="stat-label mb-1">Country</p>
                        <p class="text-light mb-0 text-truncate"><i class="bi bi-geo-alt text-body-secondary me-1"></i>{{ $user->country ?? '—' }}</p>
                    </div>
                    <div class="col-6 col-md-4">
                        <p class="stat-label mb-1">Registered</p>
                        <p class="text-light mb-0 text-truncate"><i class="bi bi-calendar3 text-body-secondary me-1"></i>{{ $user->created_at->format('M j, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-end flex-shrink-0">
            <div class="btn-group">
                <a class="btn btn-outline-secondary" href="{{ route('admin.users') }}">
                    <i class="bi bi-arrow-left"></i> <span class="d-none d-sm-inline">Back</span>
                </a>
                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-three-dots"></i> <span class="d-none d-sm-inline">Actions</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#addDepositModal">Add Deposit</a></li>
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#addProfitModal">Add Profit</a></li>
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#addBonusModal">Add Bonus</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{ route('admin.deposits', ['user' => $user->id]) }}">View Deposit History</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.withdrawals', ['user' => $user->id]) }}">View Withdrawal History</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.profits', ['user' => $user->id]) }}">View Profit History</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.bonuses', ['user' => $user->id]) }}">View Bonus History</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.loans', ['user' => $user->id]) }}">View Loan History</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.investments', ['user' => $user->id]) }}">View Investment History</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.transactions', ['user' => $user->id]) }}">View Transaction History</a></li>
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editUserModal">Edit Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#deleteUserModal">Delete {{ $user->name }}</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row g-3 mt-2 pt-4 border-top border-secondary-subtle">
        <div class="col-6 col-md-4 col-lg-2">
            <p class="stat-label mb-1">Total Balance</p>
            <p class="h5 text-primary fw-bold mb-0">${{ number_format($balance->total, 2) }}</p>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <p class="stat-label mb-1">Total Deposit</p>
            <p class="h5 text-gain mb-0">${{ number_format($balance->deposited, 2) }}</p>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <p class="stat-label mb-1">Total Withdrawal</p>
            <p class="h5 text-loss mb-0">${{ number_format($balance->withdrawn, 2) }}</p>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <p class="stat-label mb-1">Bonus / Profit</p>
            <p class="h5 text-light mb-0">${{ number_format($balance->bonus, 2) }} / ${{ number_format($balance->profit, 2) }}</p>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <p class="stat-label mb-1">KYC Status</p>
            <span class="badge {{ $user->isKycApproved() ? 'badge-approved' : 'badge-pending' }}">{{ $user->kycStatusLabel() }}</span>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <p class="stat-label mb-1">Referral Code</p>
            <p class="text-light mb-0 text-truncate">{{ $user->referral_code ?? '—' }}</p>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-6 col-md-4 col-lg-2">
        <a href="{{ route('admin.deposits', ['user' => $user->id]) }}" class="stat-card d-flex align-items-center gap-2 gap-md-3 p-3 p-md-4 text-decoration-none">
            <span class="stat-icon stat-icon-success"><i class="bi bi-box-arrow-in-down"></i></span>
            <div class="min-w-0">
                <p class="stat-label mb-1 text-truncate">Deposits</p>
                <p class="stat-value mb-0">{{ $user->deposits->count() }}</p>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-4 col-lg-2">
        <a href="{{ route('admin.withdrawals', ['user' => $user->id]) }}" class="stat-card d-flex align-items-center gap-2 gap-md-3 p-3 p-md-4 text-decoration-none">
            <span class="stat-icon stat-icon-danger"><i class="bi bi-box-arrow-up"></i></span>
            <div class="min-w-0">
                <p class="stat-label mb-1 text-truncate">Withdrawals</p>
                <p class="stat-value mb-0">{{ $user->withdrawals->count() }}</p>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-4 col-lg-2">
        <a href="{{ route('admin.loans', ['user' => $user->id]) }}" class="stat-card d-flex align-items-center gap-2 gap-md-3 p-3 p-md-4 text-decoration-none">
            <span class="stat-icon stat-icon-info"><i class="bi bi-cash-coin"></i></span>
            <div class="min-w-0">
                <p class="stat-label mb-1 text-truncate">Loans</p>
                <p class="stat-value mb-0">{{ $user->loans->count() }}</p>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-4 col-lg-2">
        <a href="{{ route('admin.investments', ['user' => $user->id]) }}" class="stat-card d-flex align-items-center gap-2 gap-md-3 p-3 p-md-4 text-decoration-none">
            <span class="stat-icon stat-icon-primary"><i class="bi bi-graph-up-arrow"></i></span>
            <div class="min-w-0">
                <p class="stat-label mb-1 text-truncate">Investments</p>
                <p class="stat-value mb-0">{{ $user->investments->count() }}</p>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-4 col-lg-2">
        <a href="{{ route('admin.profits', ['user' => $user->id]) }}" class="stat-card d-flex align-items-center gap-2 gap-md-3 p-3 p-md-4 text-decoration-none">
            <span class="stat-icon stat-icon-success"><i class="bi bi-graph-up"></i></span>
            <div class="min-w-0">
                <p class="stat-label mb-1 text-truncate">Profits</p>
                <p class="stat-value mb-0">{{ $user->profits->count() }}</p>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-4 col-lg-2">
        <a href="{{ route('admin.bonuses', ['user' => $user->id]) }}" class="stat-card d-flex align-items-center gap-2 gap-md-3 p-3 p-md-4 text-decoration-none">
            <span class="stat-icon stat-icon-info"><i class="bi bi-gift"></i></span>
            <div class="min-w-0">
                <p class="stat-label mb-1 text-truncate">Bonuses</p>
                <p class="stat-value mb-0">{{ $user->bonuses->count() }}</p>
            </div>
        </a>
    </div>
</div>

<!-- Add Deposit Modal -->
<div class="modal fade" id="addDepositModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.users.credit', $user) }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title text-light">Add Deposit for {{ $user->name }}</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label text-light">Method</label>
                        <input type="text" name="method" class="form-control" placeholder="e.g. Bank Transfer, Bitcoin" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-light">Amount</label>
                        <input type="number" step="0.01" min="0.01" name="amount" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-light">Date</label>
                        <input type="date" name="date" value="{{ now()->format('Y-m-d') }}" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add Deposit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Profit Modal -->
<div class="modal fade" id="addProfitModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.profits.store', $user) }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title text-light">Add Profit for {{ $user->name }}</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label text-light">Amount</label>
                        <input type="number" step="0.01" min="0.01" name="amount" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-light">Description</label>
                        <input type="text" name="description" class="form-control" placeholder="e.g. Weekly trading profit">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-light">Date</label>
                        <input type="date" name="date" value="{{ now()->format('Y-m-d') }}" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add Profit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Bonus Modal -->
<div class="modal fade" id="addBonusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.bonuses.store', $user) }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title text-light">Add Bonus for {{ $user->name }}</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label text-light">Amount</label>
                        <input type="number" step="0.01" min="0.01" name="amount" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-light">Description</label>
                        <input type="text" name="description" class="form-control" placeholder="e.g. Referral bonus">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-light">Date</label>
                        <input type="date" name="date" value="{{ now()->format('Y-m-d') }}" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add Bonus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.users.update', $user) }}">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title text-light">Edit {{ $user->name }}'s details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label text-light">Full Name</label>
                        <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-light">Email</label>
                        <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-light">Phone Number</label>
                        <input type="text" name="phone" value="{{ $user->phone }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-light">Country</label>
                        <input type="text" name="country" value="{{ $user->country }}" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
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
                <p class="text-light">Are you sure you want to delete {{ $user->name }}'s account? Everything associated with this account will be lost.</p>
            </div>
            <div class="modal-footer">
                <form method="POST" action="{{ route('admin.users.destroy', $user) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Yes, I'm sure</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')
