@include('admin.header', ['title' => 'Edit Admin', 'heading' => 'Edit Admin'])

<div class="mb-3"><a href="{{ route('admin.admins') }}"><i class="bi bi-arrow-left"></i> Back to admin accounts</a></div>

<div class="card p-4" style="max-width: 480px;">
    <form method="POST" action="{{ route('admin.admins.update', $admin) }}">
        @include('admin.admins._form')
    </form>
</div>

@include('admin.footer')
