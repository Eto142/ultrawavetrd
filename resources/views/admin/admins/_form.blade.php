@csrf
@if (isset($admin))
    @method('PUT')
@endif

<div class="mb-3">
    <label class="form-label text-light">Name</label>
    <input type="text" name="name" value="{{ old('name', $admin->name ?? '') }}" required class="form-control">
    @error('name') <div class="text-loss small mt-1">{{ $message }}</div> @enderror
</div>
<div class="mb-3">
    <label class="form-label text-light">Email</label>
    <input type="email" name="email" value="{{ old('email', $admin->email ?? '') }}" required class="form-control">
    @error('email') <div class="text-loss small mt-1">{{ $message }}</div> @enderror
</div>
<div class="mb-3">
    <label class="form-label text-light">
        Password @if(isset($admin))<span class="text-body-secondary">(leave blank to keep current)</span>@endif
    </label>
    <input type="password" name="password" {{ isset($admin) ? '' : 'required' }} class="form-control">
    @error('password') <div class="text-loss small mt-1">{{ $message }}</div> @enderror
</div>
<div class="mb-3">
    <label class="form-label text-light">Confirm Password</label>
    <input type="password" name="password_confirmation" {{ isset($admin) ? '' : 'required' }} class="form-control">
</div>
<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary">{{ isset($admin) ? 'Save Changes' : 'Create Admin' }}</button>
    <a href="{{ route('admin.admins') }}" class="btn btn-outline-secondary">Cancel</a>
</div>
