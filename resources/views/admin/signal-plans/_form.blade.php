@csrf
@if (isset($plan))
    @method('PUT')
@endif

<div class="mb-3">
    <label class="form-label text-light">Name</label>
    <input type="text" name="name" value="{{ old('name', $plan->name ?? '') }}" required class="form-control">
    @error('name') <div class="text-loss small mt-1">{{ $message }}</div> @enderror
</div>
<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label text-light">Badge Label</label>
        <input type="text" name="badge_label" placeholder="e.g. Popular" value="{{ old('badge_label', $plan->badge_label ?? '') }}" class="form-control">
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label text-light">Price</label>
        <input type="number" step="0.01" min="0" name="price" value="{{ old('price', $plan->price ?? '0.00') }}" required class="form-control">
        @error('price') <div class="text-loss small mt-1">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label text-light">Duration (days)</label>
        <input type="number" min="1" name="duration_days" value="{{ old('duration_days', $plan->duration_days ?? '') }}" required class="form-control">
        @error('duration_days') <div class="text-loss small mt-1">{{ $message }}</div> @enderror
    </div>
</div>
<div class="mb-3">
    <label class="form-label text-light">Features (one per line)</label>
    <textarea name="features" rows="4" class="form-control">{{ old('features', isset($plan) ? implode("\n", $plan->features ?? []) : '') }}</textarea>
</div>
<div class="form-check mb-3">
    <input type="checkbox" name="is_active" value="1" id="is_active" @checked(old('is_active', $plan->is_active ?? true)) class="form-check-input">
    <label for="is_active" class="form-check-label text-light">Active (visible to subscribers)</label>
</div>
<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary">{{ isset($plan) ? 'Save Changes' : 'Create Plan' }}</button>
    <a href="{{ route('admin.signal-plans') }}" class="btn btn-outline-secondary">Cancel</a>
</div>
