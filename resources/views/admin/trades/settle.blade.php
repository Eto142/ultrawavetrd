@include('admin.header', ['title' => 'Settle Trade', 'heading' => 'Settle Trade'])

<div class="mb-3"><a href="{{ route('admin.trades') }}"><i class="bi bi-arrow-left"></i> Back to trades</a></div>

<div class="card p-4" style="max-width: 480px;">
    <dl class="row small mb-4">
        <dt class="col-6 text-body-secondary">User</dt><dd class="col-6 text-end text-light">{{ $trade->user->name ?? '—' }}</dd>
        <dt class="col-6 text-body-secondary">Asset</dt><dd class="col-6 text-end text-light">{{ $trade->tradingAsset->symbol ?? '—' }}</dd>
        <dt class="col-6 text-body-secondary">Side</dt><dd class="col-6 text-end text-light text-capitalize">{{ $trade->trade_type }} / {{ $trade->side }}</dd>
        <dt class="col-6 text-body-secondary">Amount</dt><dd class="col-6 text-end text-light">${{ number_format($trade->amount, 2) }}</dd>
        <dt class="col-6 text-body-secondary">Leverage</dt><dd class="col-6 text-end text-light">{{ $trade->leverage }}x</dd>
        <dt class="col-6 text-body-secondary">Entry Price</dt><dd class="col-6 text-end text-light">{{ $trade->entry_price }}</dd>
    </dl>

    <form method="POST" action="{{ route('admin.trades.update', $trade) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label text-light">Outcome</label>
            <select name="status" required class="form-select">
                <option value="won">Won</option>
                <option value="lost">Lost</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label text-light">Exit Price</label>
            <input type="number" step="0.00000001" min="0" name="exit_price" value="{{ old('exit_price', $trade->entry_price) }}" required class="form-control">
            @error('exit_price') <div class="text-loss small mt-1">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label text-light">P&amp;L (use negative for a loss)</label>
            <input type="number" step="0.01" name="pnl" value="{{ old('pnl', 0) }}" required class="form-control">
            @error('pnl') <div class="text-loss small mt-1">{{ $message }}</div> @enderror
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary" onclick="return confirm('Settle this trade?')">Settle Trade</button>
            <a href="{{ route('admin.trades') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>

@include('admin.footer')
