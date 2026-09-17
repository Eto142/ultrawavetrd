@csrf
@if (isset($stock))
    @method('PUT')
@endif

<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label text-light">Symbol</label>
        <input type="text" name="symbol" value="{{ old('symbol', $stock->symbol ?? '') }}" required class="form-control">
        @error('symbol') <div class="text-loss small mt-1">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-8 mb-3">
        <label class="form-label text-light">Name</label>
        <input type="text" name="name" value="{{ old('name', $stock->name ?? '') }}" required class="form-control">
        @error('name') <div class="text-loss small mt-1">{{ $message }}</div> @enderror
    </div>
</div>
<div class="mb-3">
    <label class="form-label text-light">Logo URL</label>
    <input type="text" name="logo_url" value="{{ old('logo_url', $stock->logo_url ?? '') }}" class="form-control">
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label text-light">Price</label>
        <input type="number" step="0.0001" min="0" name="price" value="{{ old('price', $stock->price ?? '') }}" required class="form-control">
        @error('price') <div class="text-loss small mt-1">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label text-light">Previous Close</label>
        <input type="number" step="0.0001" min="0" name="previous_close" value="{{ old('previous_close', $stock->previous_close ?? '') }}" required class="form-control">
    </div>
</div>
<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label text-light">Day High</label>
        <input type="number" step="0.0001" min="0" name="day_high" value="{{ old('day_high', $stock->day_high ?? '') }}" required class="form-control">
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label text-light">Day Low</label>
        <input type="number" step="0.0001" min="0" name="day_low" value="{{ old('day_low', $stock->day_low ?? '') }}" required class="form-control">
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label text-light">Volume</label>
        <input type="number" min="0" name="volume" value="{{ old('volume', $stock->volume ?? '') }}" required class="form-control">
    </div>
</div>
<div class="form-check mb-3">
    <input type="checkbox" name="is_active" value="1" id="is_active" @checked(old('is_active', $stock->is_active ?? true)) class="form-check-input">
    <label for="is_active" class="form-check-label text-light">Active (visible to traders)</label>
</div>
<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary">{{ isset($stock) ? 'Save Changes' : 'Create Stock' }}</button>
    <a href="{{ route('admin.stocks') }}" class="btn btn-outline-secondary">Cancel</a>
</div>
