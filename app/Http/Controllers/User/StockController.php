<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use App\Models\StockOrder;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::where('is_active', true)->orderBy('name')->get();

        return view('user.stocks', compact('stocks'));
    }

    public function show(Request $request, Stock $stock)
    {
        $heldQuantity = $this->approvedQuantity($request->user(), $stock);

        return view('user.stocks-show', compact('stock', 'heldQuantity'));
    }

    /**
     * Place a buy order for a stock, sized in dollars.
     */
    public function buy(Request $request, Stock $stock)
    {
        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'min:1'],
        ]);

        $quantity = $validated['amount'] / (float) $stock->price;

        $request->user()->stockOrders()->create([
            'stock_id' => $stock->id,
            'side' => StockOrder::SIDE_BUY,
            'quantity' => $quantity,
            'price_per_share' => $stock->price,
            'amount' => $validated['amount'],
            'status' => StockOrder::STATUS_PENDING,
        ]);

        return back()->with('success', "Your order to buy {$stock->symbol} has been submitted and is pending approval.");
    }

    /**
     * Place a sell order for a stock, sized in shares.
     */
    public function sell(Request $request, Stock $stock)
    {
        $held = $this->approvedQuantity($request->user(), $stock);

        $validated = $request->validate([
            'quantity' => ['required', 'numeric', 'min:0.00000001', 'max:' . max($held, 0)],
        ]);

        $amount = $validated['quantity'] * (float) $stock->price;

        $request->user()->stockOrders()->create([
            'stock_id' => $stock->id,
            'side' => StockOrder::SIDE_SELL,
            'quantity' => $validated['quantity'],
            'price_per_share' => $stock->price,
            'amount' => $amount,
            'status' => StockOrder::STATUS_PENDING,
        ]);

        return back()->with('success', "Your order to sell {$stock->symbol} has been submitted and is pending approval.");
    }

    /**
     * Show the authenticated user's current stock positions.
     */
    public function portfolio(Request $request)
    {
        $orders = $request->user()->stockOrders()
            ->where('status', StockOrder::STATUS_APPROVED)
            ->with('stock')
            ->get();

        $positions = $orders->groupBy('stock_id')->map(function ($group) {
            $stock = $group->first()->stock;
            $buys = $group->where('side', StockOrder::SIDE_BUY);
            $sells = $group->where('side', StockOrder::SIDE_SELL);

            $buyQuantity = $buys->sum('quantity');
            $buyAmount = $buys->sum('amount');
            $sellQuantity = $sells->sum('quantity');

            $shares = $buyQuantity - $sellQuantity;
            $avgCost = $buyQuantity > 0 ? $buyAmount / $buyQuantity : 0;
            $costBasis = $avgCost * $shares;
            $currentValue = $shares * (float) $stock->price;

            return (object) [
                'stock' => $stock,
                'shares' => $shares,
                'avg_cost' => $avgCost,
                'cost_basis' => $costBasis,
                'current_value' => $currentValue,
                'gain' => $currentValue - $costBasis,
                'gain_percent' => $costBasis > 0 ? round((($currentValue - $costBasis) / $costBasis) * 100, 2) : 0,
            ];
        })->filter(fn ($position) => $position->shares > 0)->values();

        $totalValue = $positions->sum('current_value');
        $totalCostBasis = $positions->sum('cost_basis');

        return view('user.stocks-portfolio', [
            'positions' => $positions,
            'totalValue' => $totalValue,
            'totalGain' => $totalValue - $totalCostBasis,
        ]);
    }

    /**
     * List the authenticated user's buy/sell order history.
     */
    public function history(Request $request)
    {
        $orders = $request->user()->stockOrders()->with('stock')->latest()->get();

        return view('user.stocks-history', compact('orders'));
    }

    private function approvedQuantity($user, Stock $stock): float
    {
        return (float) $user->stockOrders()
            ->where('stock_id', $stock->id)
            ->where('status', StockOrder::STATUS_APPROVED)
            ->get()
            ->reduce(function ($carry, $order) {
                return $carry + ($order->side === StockOrder::SIDE_BUY ? (float) $order->quantity : -(float) $order->quantity);
            }, 0.0);
    }
}
