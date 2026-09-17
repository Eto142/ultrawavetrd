<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Signal;
use Illuminate\Http\Request;

class SignalController extends Controller
{
    public function index()
    {
        $signals = Signal::latest()->paginate(20);

        return view('admin.signals.index', compact('signals'));
    }

    public function create()
    {
        return view('admin.signals.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);
        $validated['is_active'] = $request->boolean('is_active');

        Signal::create($validated);

        return redirect()->route('admin.signals')->with('success', 'Signal created.');
    }

    public function edit(Signal $signal)
    {
        return view('admin.signals.edit', compact('signal'));
    }

    public function update(Request $request, Signal $signal)
    {
        $validated = $this->validated($request);
        $validated['is_active'] = $request->boolean('is_active');

        $signal->update($validated);

        return redirect()->route('admin.signals')->with('success', 'Signal updated.');
    }

    public function destroy(Signal $signal)
    {
        $signal->delete();

        return back()->with('success', 'Signal removed.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'symbol' => ['required', 'string', 'max:50'],
            'direction' => ['required', 'in:buy,sell'],
            'entry_price' => ['required', 'numeric'],
            'take_profit' => ['nullable', 'numeric'],
            'stop_loss' => ['nullable', 'numeric'],
            'status' => ['required', 'in:active,tp_hit,sl_hit,closed'],
            'notes' => ['nullable', 'string'],
        ]);
    }
}
