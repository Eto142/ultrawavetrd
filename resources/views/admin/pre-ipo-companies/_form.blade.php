@csrf
@if (isset($company))
    @method('PUT')
@endif

<div class="row">
    <div class="col-md-8 mb-3">
        <label class="form-label text-light">Company Name</label>
        <input type="text" name="name" value="{{ old('name', $company->name ?? '') }}" required class="form-control">
        @error('name') <div class="text-loss small mt-1">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label text-light">Symbol</label>
        <input type="text" name="symbol" value="{{ old('symbol', $company->symbol ?? '') }}" required class="form-control">
        @error('symbol') <div class="text-loss small mt-1">{{ $message }}</div> @enderror
    </div>
</div>
<div class="mb-3">
    <label class="form-label text-light">Sector</label>
    <input type="text" name="sector" value="{{ old('sector', $company->sector ?? '') }}" class="form-control">
</div>
<div class="mb-3">
    <label class="form-label text-light">Description</label>
    <textarea name="description" rows="3" class="form-control">{{ old('description', $company->description ?? '') }}</textarea>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label text-light">Share Price</label>
        <input type="number" step="0.01" min="0" name="share_price" value="{{ old('share_price', $company->share_price ?? '') }}" required class="form-control">
        @error('share_price') <div class="text-loss small mt-1">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label text-light">Initial Price</label>
        <input type="number" step="0.01" min="0" name="initial_price" value="{{ old('initial_price', $company->initial_price ?? '') }}" required class="form-control">
        @error('initial_price') <div class="text-loss small mt-1">{{ $message }}</div> @enderror
    </div>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label text-light">Total Shares</label>
        <input type="number" min="1" name="total_shares" value="{{ old('total_shares', $company->total_shares ?? '') }}" required class="form-control">
        @error('total_shares') <div class="text-loss small mt-1">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label text-light">Shares Sold</label>
        <input type="number" min="0" name="shares_sold" value="{{ old('shares_sold', $company->shares_sold ?? 0) }}" required class="form-control">
    </div>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label text-light">Min Purchase</label>
        <input type="number" min="1" name="min_purchase" value="{{ old('min_purchase', $company->min_purchase ?? 1) }}" required class="form-control">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label text-light">Max Purchase Per User</label>
        <input type="number" min="1" name="max_purchase_per_user" value="{{ old('max_purchase_per_user', $company->max_purchase_per_user ?? '') }}" class="form-control">
    </div>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label text-light">Expected IPO Date</label>
        <input type="date" name="expected_ipo_date" value="{{ old('expected_ipo_date', optional($company->expected_ipo_date ?? null)->format('Y-m-d')) }}" class="form-control">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label text-light">Status</label>
        <select name="status" required class="form-select">
            @foreach (['open' => 'Open', 'upcoming' => 'Upcoming', 'closed' => 'Closed', 'sold_out' => 'Sold Out'] as $value => $label)
                <option value="{{ $value }}" @selected(old('status', $company->status ?? 'open') === $value)>{{ $label }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-check mb-3">
    <input type="checkbox" name="is_featured" value="1" id="is_featured" @checked(old('is_featured', $company->is_featured ?? false)) class="form-check-input">
    <label for="is_featured" class="form-check-label text-light">Featured</label>
</div>
<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary">{{ isset($company) ? 'Save Changes' : 'Create Company' }}</button>
    <a href="{{ route('admin.pre-ipo-companies') }}" class="btn btn-outline-secondary">Cancel</a>
</div>
