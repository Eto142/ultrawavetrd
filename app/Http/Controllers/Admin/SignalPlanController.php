<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SignalPlan;
use Illuminate\Http\Request;

class SignalPlanController extends Controller
{
    public function index()
    {
        $plans = SignalPlan::withCount('subscriptions')->latest()->paginate(20);

        return view('admin.signal-plans.index', compact('plans'));
    }

    public function create()
    {
        return view('admin.signal-plans.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);
        $validated['is_active'] = $request->boolean('is_active');

        SignalPlan::create($validated);

        return redirect()->route('admin.signal-plans')->with('success', 'Signal plan created.');
    }

    public function edit(SignalPlan $signalPlan)
    {
        return view('admin.signal-plans.edit', ['plan' => $signalPlan]);
    }

    public function update(Request $request, SignalPlan $signalPlan)
    {
        $validated = $this->validated($request);
        $validated['is_active'] = $request->boolean('is_active');

        $signalPlan->update($validated);

        return redirect()->route('admin.signal-plans')->with('success', 'Signal plan updated.');
    }

    public function destroy(SignalPlan $signalPlan)
    {
        $signalPlan->delete();

        return back()->with('success', 'Signal plan removed.');
    }

    private function validated(Request $request): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'badge_label' => ['nullable', 'string', 'max:50'],
            'price' => ['required', 'numeric', 'min:0'],
            'duration_days' => ['required', 'integer', 'min:1'],
            'features' => ['nullable', 'string'],
        ]);

        $validated['features'] = $validated['features']
            ? array_values(array_filter(array_map('trim', explode("\n", $validated['features']))))
            : [];

        return $validated;
    }
}
