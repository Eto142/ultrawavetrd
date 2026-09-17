@csrf
@if (isset($asset))
    @method('PUT')
@endif

<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label text-light">Symbol</label>
        <input type="text" name="symbol" value="{{ old('symbol', $asset->symbol ?? '') }}" required class="form-control">
        @error('symbol') <div class="text-loss small mt-1">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-8 mb-3">
        <label class="form-label text-light">Name</label>
        <input type="text" name="name" value="{{ old('name', $asset->name ?? '') }}" required class="form-control">
        @error('name') <div class="text-loss small mt-1">{{ $message }}</div> @enderror
    </div>
</div>
<div class="mb-3">
    <label class="form-label text-light">Asset Class</label>
    <select name="asset_class" required class="form-select">
        @foreach (\App\Models\TradingAsset::ASSET_CLASSES as $value => $label)
            <option value="{{ $value }}" @selected(old('asset_class', $asset->asset_class ?? 'crypto') === $value)>{{ $label }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label class="form-label text-light">Logo URL</label>
    <input type="text" name="logo_url" value="{{ old('logo_url', $asset->logo_url ?? '') }}" class="form-control">
</div>
<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label text-light">Price</label>
        <input type="number" step="0.00000001" min="0" name="price" value="{{ old('price', $asset->price ?? '') }}" required class="form-control">
        @error('price') <div class="text-loss small mt-1">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label text-light">24h Change ($)</label>
        <input type="number" step="0.00000001" name="price_change_24h" value="{{ old('price_change_24h', $asset->price_change_24h ?? 0) }}" required class="form-control">
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label text-light">24h Change (%)</label>
        <input type="number" step="0.0001" name="price_change_pct_24h" value="{{ old('price_change_pct_24h', $asset->price_change_pct_24h ?? 0) }}" required class="form-control">
    </div>
</div>
<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label text-light">24h High</label>
        <input type="number" step="0.00000001" min="0" name="high_24h" value="{{ old('high_24h', $asset->high_24h ?? '') }}" required class="form-control">
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label text-light">24h Low</label>
        <input type="number" step="0.00000001" min="0" name="low_24h" value="{{ old('low_24h', $asset->low_24h ?? '') }}" required class="form-control">
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label text-light">24h Volume</label>
        <input type="number" min="0" name="volume_24h" value="{{ old('volume_24h', $asset->volume_24h ?? '') }}" required class="form-control">
    </div>
</div>
<div class="mb-3">
    <label class="form-label text-light">Market Cap</label>
    <input type="number" min="0" name="market_cap" value="{{ old('market_cap', $asset->market_cap ?? '') }}" class="form-control">
</div>
<div class="form-check mb-3">
    <input type="checkbox" name="is_active" value="1" id="is_active" @checked(old('is_active', $asset->is_active ?? true)) class="form-check-input">
    <label for="is_active" class="form-check-label text-light">Active (tradable)</label>
</div>
<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary">{{ isset($asset) ? 'Save Changes' : 'Create Asset' }}</button>
    <a href="{{ route('admin.trading-assets') }}" class="btn btn-outline-secondary">Cancel</a>
</div>
