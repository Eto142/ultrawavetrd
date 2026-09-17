<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StockOrder;
use App\Models\Transaction;
use Illuminate\Http\Request;

class StockOrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = StockOrder::with(['user', 'stock'])
            ->when($request->filled('stock'), fn ($q) => $q->where('stock_id', $request->integer('stock')))
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->integer('status')))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.stock-orders.index', compact('orders'));
    }

    public function approve(StockOrder $order)
    {
        $order->update(['status' => StockOrder::STATUS_APPROVED]);

        Transaction::record(
            user: $order->user,
            type: $order->side === StockOrder::SIDE_SELL ? Transaction::TYPE_CREDIT : Transaction::TYPE_DEBIT,
            category: 'stock_order',
            amount: (float) $order->amount,
            reference: $order,
            description: strtoupper($order->side) . ' ' . ($order->stock->symbol ?? 'stock'),
        );

        return back()->with('success', 'Order approved.');
    }
}
