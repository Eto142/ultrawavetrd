<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PreIpoCompany;
use Illuminate\Http\Request;

class PreIpoCompanyController extends Controller
{
    public function index()
    {
        $companies = PreIpoCompany::withCount('holdings')->latest()->paginate(20);

        return view('admin.pre-ipo-companies.index', compact('companies'));
    }

    public function create()
    {
        return view('admin.pre-ipo-companies.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);
        $validated['is_featured'] = $request->boolean('is_featured');

        PreIpoCompany::create($validated);

        return redirect()->route('admin.pre-ipo-companies')->with('success', 'Company created.');
    }

    public function edit(PreIpoCompany $preIpoCompany)
    {
        return view('admin.pre-ipo-companies.edit', ['company' => $preIpoCompany]);
    }

    public function update(Request $request, PreIpoCompany $preIpoCompany)
    {
        $validated = $this->validated($request);
        $validated['is_featured'] = $request->boolean('is_featured');

        $preIpoCompany->update($validated);

        return redirect()->route('admin.pre-ipo-companies')->with('success', 'Company updated.');
    }

    public function destroy(PreIpoCompany $preIpoCompany)
    {
        $preIpoCompany->delete();

        return back()->with('success', 'Company removed.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'symbol' => ['required', 'string', 'max:50'],
            'sector' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'share_price' => ['required', 'numeric', 'min:0'],
            'initial_price' => ['required', 'numeric', 'min:0'],
            'total_shares' => ['required', 'integer', 'min:1'],
            'shares_sold' => ['required', 'integer', 'min:0'],
            'min_purchase' => ['required', 'integer', 'min:1'],
            'max_purchase_per_user' => ['nullable', 'integer', 'min:1'],
            'expected_ipo_date' => ['nullable', 'date'],
            'status' => ['required', 'in:open,upcoming,closed,sold_out'],
        ]);
    }
}
