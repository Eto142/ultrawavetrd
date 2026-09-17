@csrf
@if (isset($signal))
    @method('PUT')
@endif

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label text-light">Symbol</label>
        <input type="text" name="symbol" value="{{ old('symbol', $signal->symbol ?? '') }}" required class="form-control">
        @error('symbol') <div class="text-loss small mt-1">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label text-light">Direction</label>
        <select name="direction" required class="form-select">
            @foreach (['buy' => 'Buy', 'sell' => 'Sell'] as $value => $label)
                <option value="{{ $value }}" @selected(old('direction', $signal->direction ?? 'buy') === $value)>{{ $label }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label text-light">Entry Price</label>
        <input type="number" step="0.00001" name="entry_price" value="{{ old('entry_price', $signal->entry_price ?? '') }}" required class="form-control">
        @error('entry_price') <div class="text-loss small mt-1">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label text-light">Take Profit</label>
        <input type="number" step="0.00001" name="take_profit" value="{{ old('take_profit', $signal->take_profit ?? '') }}" class="form-control">
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label text-light">Stop Loss</label>
        <input type="number" step="0.00001" name="stop_loss" value="{{ old('stop_loss', $signal->stop_loss ?? '') }}" class="form-control">
    </div>
</div>
<div class="mb-3">
    <label class="form-label text-light">Status</label>
    <select name="status" required class="form-select">
        @foreach (['active' => 'Active', 'tp_hit' => 'Take Profit Hit', 'sl_hit' => 'Stop Loss Hit', 'closed' => 'Closed'] as $value => $label)
            <option value="{{ $value }}" @selected(old('status', $signal->status ?? 'active') === $value)>{{ $label }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label class="form-label text-light">Notes</label>
    <textarea name="notes" rows="3" class="form-control">{{ old('notes', $signal->notes ?? '') }}</textarea>
</div>
<div class="form-check mb-3">
    <input type="checkbox" name="is_active" value="1" id="is_active" @checked(old('is_active', $signal->is_active ?? true)) class="form-check-input">
    <label for="is_active" class="form-check-label text-light">Active (visible to subscribers)</label>
</div>
<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary">{{ isset($signal) ? 'Save Changes' : 'Create Signal' }}</button>
    <a href="{{ route('admin.signals') }}" class="btn btn-outline-secondary">Cancel</a>
</div>
