@include('admin.header', ['title' => 'Signal Plans', 'heading' => 'Signal Plans'])

<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin.signal-plans.create') }}" class="btn btn-primary">Add Plan</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Duration</th>
                    <th>Subscribers</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($plans as $plan)
                    <tr>
                        <td class="text-light">{{ $plan->name }} @if($plan->badge_label)<span class="badge badge-approved ms-1">{{ $plan->badge_label }}</span>@endif</td>
                        <td>${{ number_format($plan->price, 2) }}</td>
                        <td>{{ $plan->duration_days }} days</td>
                        <td>
                            <a href="{{ route('admin.signal-subscriptions', ['plan' => $plan->id]) }}">{{ $plan->subscriptions_count }}</a>
                        </td>
                        <td><span class="badge {{ $plan->is_active ? 'badge-approved' : 'badge-pending' }}">{{ $plan->is_active ? 'Active' : 'Inactive' }}</span></td>
                        <td class="text-end">
                            <a href="{{ route('admin.signal-plans.edit', $plan) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form method="POST" action="{{ route('admin.signal-plans.destroy', $plan) }}" class="d-inline" onsubmit="return confirm('Delete this plan?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td class="text-center py-4" colspan="6">No signal plans found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $plans->links() }}
    </div>
</div>

@include('admin.footer')
