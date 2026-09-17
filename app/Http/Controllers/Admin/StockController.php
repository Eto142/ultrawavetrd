<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::withCount('orders')->orderBy('symbol')->paginate(20);

        return view('admin.stocks.index', compact('stocks'));
    }

    public function create()
    {
        return view('admin.stocks.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);
        $validated['is_active'] = $request->boolean('is_active');

        Stock::create($validated);

        return redirect()->route('admin.stocks')->with('success', 'Stock created.');
    }

    public function edit(Stock $stock)
    {
        return view('admin.stocks.edit', compact('stock'));
    }

    public function update(Request $request, Stock $stock)
    {
        $validated = $this->validated($request);
        $validated['is_active'] = $request->boolean('is_active');

        $stock->update($validated);

        return redirect()->route('admin.stocks')->with('success', 'Stock updated.');
    }

    public function destroy(Stock $stock)
    {
        $stock->delete();

        return back()->with('success', 'Stock removed.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'symbol' => ['required', 'string', 'max:20'],
            'name' => ['required', 'string', 'max:255'],
            'logo_url' => ['nullable', 'string', 'max:2048'],
            'price' => ['required', 'numeric', 'min:0'],
            'previous_close' => ['required', 'numeric', 'min:0'],
            'day_high' => ['required', 'numeric', 'min:0'],
            'day_low' => ['required', 'numeric', 'min:0'],
            'volume' => ['required', 'integer', 'min:0'],
        ]);
    }
}
