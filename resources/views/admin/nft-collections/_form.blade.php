@csrf
@if (isset($collection))
    @method('PUT')
@endif

<div class="mb-3">
    <label class="form-label text-light">Name</label>
    <input type="text" name="name" value="{{ old('name', $collection->name ?? '') }}" required class="form-control">
    @error('name') <div class="text-loss small mt-1">{{ $message }}</div> @enderror
</div>
<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary">{{ isset($collection) ? 'Save Changes' : 'Create Collection' }}</button>
    <a href="{{ route('admin.nft-collections') }}" class="btn btn-outline-secondary">Cancel</a>
</div>
