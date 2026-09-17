@include('admin.header', ['title' => 'Edit Company', 'heading' => 'Edit Pre-IPO Company'])

<div class="mb-3"><a href="{{ route('admin.pre-ipo-companies') }}"><i class="bi bi-arrow-left"></i> Back to companies</a></div>

<div class="card p-4" style="max-width: 720px;">
    <form method="POST" action="{{ route('admin.pre-ipo-companies.update', $company) }}">
        @include('admin.pre-ipo-companies._form')
    </form>
</div>

@include('admin.footer')
