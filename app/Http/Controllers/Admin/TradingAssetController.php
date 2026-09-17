<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TradingAsset;
use Illuminate\Http\Request;

class TradingAssetController extends Controller
{
    public function index()
    {
        $assets = TradingAsset::withCount('trades')->orderBy('asset_class')->orderBy('name')->paginate(20);

        return view('admin.trading-assets.index', compact('assets'));
    }

    public function create()
    {
        return view('admin.trading-assets.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);
        $validated['is_active'] = $request->boolean('is_active');

        TradingAsset::create($validated);

        return redirect()->route('admin.trading-assets')->with('success', 'Trading asset created.');
    }

    public function edit(TradingAsset $tradingAsset)
    {
        return view('admin.trading-assets.edit', ['asset' => $tradingAsset]);
    }

    public function update(Request $request, TradingAsset $tradingAsset)
    {
        $validated = $this->validated($request);
        $validated['is_active'] = $request->boolean('is_active');

        $tradingAsset->update($validated);

        return redirect()->route('admin.trading-assets')->with('success', 'Trading asset updated.');
    }

    public function destroy(TradingAsset $tradingAsset)
    {
        $tradingAsset->delete();

        return back()->with('success', 'Trading asset removed.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'symbol' => ['required', 'string', 'max:20'],
            'asset_class' => ['required', 'in:crypto,forex,stock,etf,index'],
            'price' => ['required', 'numeric', 'min:0'],
            'price_change_24h' => ['required', 'numeric'],
            'price_change_pct_24h' => ['required', 'numeric'],
            'high_24h' => ['required', 'numeric', 'min:0'],
            'low_24h' => ['required', 'numeric', 'min:0'],
            'volume_24h' => ['required', 'integer', 'min:0'],
            'market_cap' => ['nullable', 'integer', 'min:0'],
            'logo_url' => ['nullable', 'string', 'max:2048'],
        ]);
    }
}
