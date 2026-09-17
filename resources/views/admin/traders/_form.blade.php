@csrf
@if (isset($trader))
    @method('PUT')
@endif

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label text-light">Name</label>
        <input type="text" name="name" value="{{ old('name', $trader->name ?? '') }}" required class="form-control">
        @error('name') <div class="text-loss small mt-1">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label text-light">Avatar URL</label>
        <input type="text" name="avatar_url" value="{{ old('avatar_url', $trader->avatar_url ?? '') }}" class="form-control">
    </div>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label text-light">Style Label</label>
        <input type="text" name="style_label" placeholder="e.g. Scalper" value="{{ old('style_label', $trader->style_label ?? '') }}" class="form-control">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label text-light">Risk Level</label>
        <input type="text" name="risk_level" placeholder="e.g. Medium" value="{{ old('risk_level', $trader->risk_level ?? '') }}" class="form-control">
    </div>
</div>
<div class="mb-3">
    <label class="form-label text-light">Headline</label>
    <input type="text" name="headline" value="{{ old('headline', $trader->headline ?? '') }}" class="form-control">
</div>
<div class="mb-3">
    <label class="form-label text-light">Bio</label>
    <textarea name="bio" rows="3" class="form-control">{{ old('bio', $trader->bio ?? '') }}</textarea>
</div>
<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label text-light">Followers</label>
        <input type="number" min="0" name="followers_count" value="{{ old('followers_count', $trader->followers_count ?? 0) }}" required class="form-control">
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label text-light">Daily ROI %</label>
        <input type="number" step="0.01" name="daily_roi_pct" value="{{ old('daily_roi_pct', $trader->daily_roi_pct ?? 0) }}" required class="form-control">
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label text-light">Total ROI %</label>
        <input type="number" step="0.01" name="total_roi_pct" value="{{ old('total_roi_pct', $trader->total_roi_pct ?? 0) }}" required class="form-control">
    </div>
</div>
<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label text-light">Win Rate %</label>
        <input type="number" step="0.01" min="0" max="100" name="win_rate_pct" value="{{ old('win_rate_pct', $trader->win_rate_pct ?? 0) }}" required class="form-control">
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label text-light">Min Capital</label>
        <input type="number" step="0.01" min="0" name="min_capital" value="{{ old('min_capital', $trader->min_capital ?? 0) }}" required class="form-control">
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label text-light">Duration (days)</label>
        <input type="number" min="1" name="duration_days" value="{{ old('duration_days', $trader->duration_days ?? 30) }}" required class="form-control">
    </div>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label text-light">Total Trades</label>
        <input type="number" min="0" name="total_trades" value="{{ old('total_trades', $trader->total_trades ?? 0) }}" required class="form-control">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label text-light">Years Experience</label>
        <input type="number" min="0" name="years_experience" value="{{ old('years_experience', $trader->years_experience ?? 0) }}" required class="form-control">
    </div>
</div>
<div class="mb-3">
    <label class="form-label text-light">Markets Traded (comma separated)</label>
    <input type="text" name="markets_traded" placeholder="Crypto, Forex, Stocks" value="{{ old('markets_traded', isset($trader) ? implode(', ', $trader->markets_traded ?? []) : '') }}" class="form-control">
</div>
<div class="d-flex gap-4 mb-3">
    <div class="form-check">
        <input type="checkbox" name="is_verified" value="1" id="is_verified" @checked(old('is_verified', $trader->is_verified ?? false)) class="form-check-input">
        <label for="is_verified" class="form-check-label text-light">Verified</label>
    </div>
    <div class="form-check">
        <input type="checkbox" name="is_active" value="1" id="is_active" @checked(old('is_active', $trader->is_active ?? true)) class="form-check-input">
        <label for="is_active" class="form-check-label text-light">Active (visible for copy trading)</label>
    </div>
</div>
<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary">{{ isset($trader) ? 'Save Changes' : 'Create Trader' }}</button>
    <a href="{{ route('admin.traders') }}" class="btn btn-outline-secondary">Cancel</a>
</div>
