@include('admin.header', ['title' => 'Add Admin', 'heading' => 'Add Admin'])

<div class="mb-3"><a href="{{ route('admin.admins') }}"><i class="bi bi-arrow-left"></i> Back to admin accounts</a></div>

<div class="card p-4" style="max-width: 480px;">
    <form method="POST" action="{{ route('admin.admins.store') }}">
        @include('admin.admins._form')
    </form>
</div>

@include('admin.footer')
