<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\PreIpoCompany;
use App\Models\PreIpoHolding;
use Illuminate\Http\Request;

class PreIpoController extends Controller
{
    public function index()
    {
        $companies = PreIpoCompany::orderByDesc('is_featured')->orderBy('name')->get();

        return view('user.pre-ipo', compact('companies'));
    }

    public function show(PreIpoCompany $company)
    {
        return view('user.pre-ipo-show', compact('company'));
    }

    /**
     * Buy shares in a pre-IPO company.
     */
    public function buy(Request $request, PreIpoCompany $company)
    {
        if ($company->status !== 'open') {
            return back()->with('error', 'This offering is not currently open for purchase.');
        }

        if ($company->shares_available < $company->min_purchase) {
            return back()->with('error', 'This offering is sold out.');
        }

        $maxAllowed = $company->max_purchase_per_user
            ? min($company->max_purchase_per_user, $company->shares_available)
            : $company->shares_available;

        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:' . $company->min_purchase, 'max:' . $maxAllowed],
        ]);

        $totalCost = $validated['quantity'] * (float) $company->share_price;

        $request->user()->preIpoHoldings()->create([
            'pre_ipo_company_id' => $company->id,
            'quantity' => $validated['quantity'],
            'price_per_share' => $company->share_price,
            'total_cost' => $totalCost,
            'status' => PreIpoHolding::STATUS_PENDING,
        ]);

        $company->increment('shares_sold', $validated['quantity']);

        return redirect()->route('user.pre-ipo.holdings')->with('success', 'Your share purchase has been submitted and is pending approval.');
    }

    /**
     * List the authenticated user's pre-IPO holdings, individually and grouped per company.
     */
    public function holdings(Request $request)
    {
        $holdings = $request->user()->preIpoHoldings()->with('preIpoCompany')->latest()->get();

        $totalInvested = $holdings->sum('total_cost');
        $totalShares = $holdings->sum('quantity');

        $portfolio = $holdings->groupBy('pre_ipo_company_id')->map(function ($group) {
            $company = $group->first()->preIpoCompany;
            $shares = $group->sum('quantity');
            $costBasis = $group->sum('total_cost');
            $currentValue = $shares * (float) $company->share_price;

            return (object) [
                'company' => $company,
                'shares' => $shares,
                'cost_basis' => $costBasis,
                'avg_price' => $shares > 0 ? $costBasis / $shares : 0,
                'current_value' => $currentValue,
                'gain' => $currentValue - $costBasis,
                'gain_percent' => $costBasis > 0 ? round((($currentValue - $costBasis) / $costBasis) * 100, 2) : 0,
            ];
        })->values();

        return view('user.pre-ipo-holdings', [
            'holdings' => $holdings,
            'portfolio' => $portfolio,
            'totalInvested' => $totalInvested,
            'totalShares' => $totalShares,
            'companiesCount' => $portfolio->count(),
        ]);
    }
}
