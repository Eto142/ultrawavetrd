<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CopyTradingSubscription;
use App\Models\Trade;
use App\Models\Trader;
use App\Models\TradingAsset;
use Illuminate\Http\Request;

class TradeController extends Controller
{
    public function index(Request $request)
    {
        $assets = TradingAsset::where('is_active', true)->orderBy('name')->get();
        $preselectedAssetId = (int) $request->query('asset');

        $openTrades = $request->user()->trades()
            ->with('tradingAsset')
            ->where('status', Trade::STATUS_OPEN)
            ->latest()
            ->get();

        $closedTrades = $request->user()->trades()
            ->with('tradingAsset')
            ->whereIn('status', [Trade::STATUS_WON, Trade::STATUS_LOST])
            ->latest()
            ->get();

        return view('user.trade', compact('assets', 'preselectedAssetId', 'openTrades', 'closedTrades'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'trading_asset_id' => ['required', 'exists:trading_assets,id'],
            'trade_type' => ['required', 'in:binary,spot'],
            'action' => ['required', 'in:buy,sell'],
            'amount' => ['required', 'numeric', 'min:1'],
            'leverage' => ['required', 'integer', 'in:2,5,10,25,50,100'],
            'duration' => ['required_if:trade_type,binary', 'nullable', 'integer', 'min:1'],
            'is_demo' => ['nullable', 'boolean'],
        ]);

        $asset = TradingAsset::findOrFail($validated['trading_asset_id']);
        $isBinary = $validated['trade_type'] === 'binary';

        $trade = $request->user()->trades()->create([
            'trading_asset_id' => $asset->id,
            'trade_type' => $validated['trade_type'],
            'side' => $validated['action'],
            'amount' => $validated['amount'],
            'leverage' => $validated['leverage'],
            'duration_minutes' => $isBinary ? $validated['duration'] : null,
            'entry_price' => $asset->price,
            'expires_at' => $isBinary ? now()->addMinutes((int) $validated['duration']) : null,
            'is_demo' => $request->boolean('is_demo'),
            'status' => Trade::STATUS_OPEN,
        ]);

        return redirect()->route('user.trade')->with('success', "Your {$validated['action']} {$validated['trade_type']} trade on {$asset->symbol} has been opened.");
    }

    public function closeRequest(Request $request, Trade $trade)
    {
        abort_unless($trade->user_id === $request->user()->id, 403);

        if ($trade->trade_type !== 'spot' || $trade->status !== Trade::STATUS_OPEN) {
            return back()->with('error', 'This trade cannot be closed.');
        }

        if ($trade->isPendingClose()) {
            return back()->with('error', 'A close request has already been submitted for this trade.');
        }

        $trade->update(['close_requested_at' => now()]);

        return back()->with('success', 'Close request submitted. An admin will settle this trade shortly.');
    }

    public function markets(Request $request)
    {
        $class = $request->query('class');
        $search = $request->query('search');

        $query = TradingAsset::where('is_active', true);

        if ($class) {
            $query->where('asset_class', $class);
        }

        if ($search) {
            $query->where(fn ($q) => $q->where('name', 'like', "%{$search}%")->orWhere('symbol', 'like', "%{$search}%"));
        }

        $assets = $query->orderByRaw("field(asset_class, 'crypto', 'forex', 'stock', 'etf', 'index')")->orderBy('name')->get();

        $classCounts = TradingAsset::where('is_active', true)
            ->selectRaw('asset_class, count(*) as total')
            ->groupBy('asset_class')
            ->pluck('total', 'asset_class');

        $totalAssets = $classCounts->sum();
        $topGainer = TradingAsset::where('is_active', true)->orderByDesc('price_change_pct_24h')->first();
        $topLoser = TradingAsset::where('is_active', true)->orderBy('price_change_pct_24h')->first();
        $activeMarkets = $classCounts->count();

        return view('user.markets', compact('assets', 'class', 'search', 'classCounts', 'totalAssets', 'topGainer', 'topLoser', 'activeMarkets'));
    }

    public function marketsnews()
    {
        return view('user.market-news');
    }

    public function copyTrading(Request $request)
    {
        $traders = Trader::where('is_active', true)->orderByDesc('followers_count')->get();

        $subscriptions = $request->user()->copyTradingSubscriptions()->with('trader')->latest()->get();

        return view('user.copy-trading', compact('traders', 'subscriptions'));
    }

    public function showExpert(Trader $trader)
    {
        return view('user.trader-show', compact('trader'));
    }

    public function copySubscribe(Request $request)
    {
        $validated = $request->validate([
            'trader_id' => ['required', 'exists:traders,id'],
            'amount' => ['required', 'numeric', 'min:1'],
        ]);

        $trader = Trader::findOrFail($validated['trader_id']);

        if ($validated['amount'] < $trader->min_capital) {
            return back()->with('error', "Minimum capital to copy {$trader->name} is $" . number_format($trader->min_capital, 2) . '.');
        }

        $request->user()->copyTradingSubscriptions()->create([
            'trader_id' => $trader->id,
            'amount' => $validated['amount'],
            'payment_method' => 'Account Balance',
            'status' => CopyTradingSubscription::STATUS_PENDING,
            'expires_at' => now()->addDays($trader->duration_days),
        ]);

        return redirect()->route('user.copy-trading')->with('success', "Your request to copy {$trader->name} has been submitted and is pending approval.");
    }

    public function history(Request $request)
    {
        $trades = $request->user()->trades()->with('tradingAsset')->latest()->get();

        return view('user.trading-history', compact('trades'));
    }
}
