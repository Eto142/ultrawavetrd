<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trader;
use Illuminate\Http\Request;

class TraderController extends Controller
{
    public function index()
    {
        $traders = Trader::withCount('subscriptions')->orderBy('name')->paginate(20);

        return view('admin.traders.index', compact('traders'));
    }

    public function create()
    {
        return view('admin.traders.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);
        $validated['is_verified'] = $request->boolean('is_verified');
        $validated['is_active'] = $request->boolean('is_active');

        Trader::create($validated);

        return redirect()->route('admin.traders')->with('success', 'Trader created.');
    }

    public function edit(Trader $trader)
    {
        return view('admin.traders.edit', compact('trader'));
    }

    public function update(Request $request, Trader $trader)
    {
        $validated = $this->validated($request);
        $validated['is_verified'] = $request->boolean('is_verified');
        $validated['is_active'] = $request->boolean('is_active');

        $trader->update($validated);

        return redirect()->route('admin.traders')->with('success', 'Trader updated.');
    }

    public function destroy(Trader $trader)
    {
        $trader->delete();

        return back()->with('success', 'Trader removed.');
    }

    private function validated(Request $request): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'avatar_url' => ['nullable', 'string', 'max:2048'],
            'style_label' => ['nullable', 'string', 'max:255'],
            'risk_level' => ['nullable', 'string', 'max:50'],
            'headline' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'followers_count' => ['required', 'integer', 'min:0'],
            'daily_roi_pct' => ['required', 'numeric'],
            'total_roi_pct' => ['required', 'numeric'],
            'win_rate_pct' => ['required', 'numeric', 'min:0', 'max:100'],
            'min_capital' => ['required', 'numeric', 'min:0'],
            'duration_days' => ['required', 'integer', 'min:1'],
            'total_trades' => ['required', 'integer', 'min:0'],
            'years_experience' => ['required', 'integer', 'min:0'],
            'markets_traded' => ['nullable', 'string'],
        ]);

        $validated['markets_traded'] = $validated['markets_traded']
            ? array_values(array_filter(array_map('trim', explode(',', $validated['markets_traded']))))
            : [];

        return $validated;
    }
}
