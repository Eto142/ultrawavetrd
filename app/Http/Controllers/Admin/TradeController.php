<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trade;
use Illuminate\Http\Request;

class TradeController extends Controller
{
    public function index(Request $request)
    {
        $trades = Trade::with(['user', 'tradingAsset'])
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->string('status')))
            ->when($request->filled('pending_close'), fn ($q) => $q->whereNotNull('close_requested_at'))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.trades.index', compact('trades'));
    }

    public function settle(Trade $trade)
    {
        return view('admin.trades.settle', compact('trade'));
    }

    public function update(Request $request, Trade $trade)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:won,lost'],
            'exit_price' => ['required', 'numeric', 'min:0'],
            'pnl' => ['required', 'numeric'],
        ]);

        $trade->update([
            'status' => $validated['status'],
            'exit_price' => $validated['exit_price'],
            'pnl' => $validated['pnl'],
            'closed_at' => now(),
        ]);

        return redirect()->route('admin.trades')->with('success', 'Trade settled.');
    }
}
