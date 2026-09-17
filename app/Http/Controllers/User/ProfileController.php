<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CopyTradingSubscription;
use App\Models\Deposit;
use App\Models\Investment;
use App\Models\Loan;
use App\Models\PreIpoHolding;
use App\Models\StockOrder;
use App\Models\Trade;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $stats = $this->buildStats($user);

        return view('user.profile', compact('user', 'stats'));
    }

    protected function buildStats(User $user): array
    {
        $trades = $user->trades()->get();
        $closedTrades = $trades->whereIn('status', [Trade::STATUS_WON, Trade::STATUS_LOST]);
        $tradingInvested = (float) $trades->sum('amount');
        $tradingProfit = (float) $closedTrades->filter(fn ($t) => (float) $t->pnl > 0)->sum('pnl');
        $tradingLoss = abs((float) $closedTrades->filter(fn ($t) => (float) $t->pnl < 0)->sum('pnl'));
        $tradingPnl = (float) $closedTrades->sum('pnl');
        $wonCount = $trades->where('status', Trade::STATUS_WON)->count();
        $closedCount = $closedTrades->count();
        $winRate = $closedCount > 0 ? round(($wonCount / $closedCount) * 100, 1) : null;

        $copySubs = $user->copyTradingSubscriptions()->get();
        $activeCopySubs = $copySubs->filter(fn ($s) => $s->isActive());
        $copyInvested = (float) $copySubs->where('status', CopyTradingSubscription::STATUS_APPROVED)->sum('amount');

        $investments = $user->investments()->where('status', Investment::STATUS_APPROVED)->get();
        $investmentInvested = (float) $investments->sum('amount');

        $preIpoHoldings = $user->preIpoHoldings()->with('preIpoCompany')->where('status', PreIpoHolding::STATUS_APPROVED)->get();
        $preIpoCost = (float) $preIpoHoldings->sum('total_cost');
        $preIpoValue = (float) $preIpoHoldings->sum(fn ($h) => (float) $h->quantity * (float) optional($h->preIpoCompany)->share_price);

        $stockOrders = $user->stockOrders()->with('stock')->where('status', StockOrder::STATUS_APPROVED)->get();
        $stockInvested = (float) $stockOrders->sum(fn ($o) => $o->side === StockOrder::SIDE_BUY ? (float) $o->amount : -(float) $o->amount);
        $netQtyByStock = $stockOrders->groupBy('stock_id')->map(function ($orders) {
            return $orders->sum(fn ($o) => $o->side === StockOrder::SIDE_BUY ? (float) $o->quantity : -(float) $o->quantity);
        });
        $stockPositions = 0;
        $stockValue = 0.0;
        foreach ($netQtyByStock as $stockId => $qty) {
            if ($qty > 0.00000001) {
                $stockPositions++;
                $stock = $stockOrders->firstWhere('stock_id', $stockId)?->stock;
                $stockValue += $qty * (float) optional($stock)->price;
            }
        }

        $nfts = $user->nfts()->get();
        $nftValue = (float) $nfts->sum('price');

        $depositsTotal = (float) $user->deposits()->where('status', Deposit::STATUS_APPROVED)->sum('amount');
        $depositsCount = $user->deposits()->where('status', Deposit::STATUS_APPROVED)->count();
        $withdrawalsTotal = (float) $user->withdrawals()->where('status', Withdrawal::STATUS_APPROVED)->sum('amount');
        $withdrawalsCount = $user->withdrawals()->where('status', Withdrawal::STATUS_APPROVED)->count();

        $activeLoans = $user->loans()->where('status', Loan::STATUS_APPROVED)->get();
        $loanOutstanding = (float) $activeLoans->sum('total_repayable');

        $totalInvested = $investmentInvested + $preIpoCost + max($stockInvested, 0) + $copyInvested;
        $netWorth = ($depositsTotal - $withdrawalsTotal) + $tradingPnl + $stockValue + $nftValue + $preIpoCost;

        $allocation = collect([
            'Trading' => max($tradingInvested, 0),
            'Copy Trading' => $copyInvested,
            'Investment Plans' => $investmentInvested,
            'Pre-IPO' => $preIpoCost,
            'Stocks' => max($stockValue, 0),
            'NFTs' => $nftValue,
        ])->filter(fn ($value) => $value > 0);

        return [
            'net_worth' => $netWorth,
            'total_invested' => $totalInvested,
            'total_pnl' => $tradingPnl,
            'win_rate' => $winRate,
            'allocation' => $allocation,
            'allocation_total' => (float) $allocation->sum(),

            'trading' => [
                'total_trades' => $trades->count(),
                'open' => $trades->where('status', Trade::STATUS_OPEN)->count(),
                'invested' => $tradingInvested,
                'profit' => $tradingProfit,
                'loss' => $tradingLoss,
            ],
            'copy_trading' => [
                'active' => $activeCopySubs->count(),
                'invested' => $copyInvested,
                'profit' => 0.0,
            ],
            'investments' => [
                'active' => $investments->count(),
                'invested' => $investmentInvested,
                'earned' => 0.0,
            ],
            'pre_ipo' => [
                'holdings' => $preIpoHoldings->count(),
                'cost' => $preIpoCost,
                'value' => $preIpoValue,
            ],
            'stocks' => [
                'positions' => $stockPositions,
                'invested' => max($stockInvested, 0),
                'value' => $stockValue,
            ],
            'nfts' => [
                'owned' => $nfts->count(),
                'value' => $nftValue,
            ],
            'deposits' => [
                'count' => $depositsCount,
                'total' => $depositsTotal,
            ],
            'withdrawals' => [
                'count' => $withdrawalsCount,
                'total' => $withdrawalsTotal,
            ],
            'loans' => [
                'active' => $activeLoans->count(),
                'outstanding' => $loanOutstanding,
                'repaid' => 0.0,
            ],
        ];
    }

    public function updateInfo(Request $request)
    {
        $validated = $request->validate([
            'country' => ['nullable', 'string', 'max:255'],
            'currency_code' => ['nullable', 'string', 'size:3'],
            'state' => ['nullable', 'string', 'max:255'],
            'zipcode' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
        ]);

        $request->user()->update($validated);

        return back()->with('success', 'Your profile has been updated.');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Your password has been changed. Please log in again.');
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'profileimage' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
        ]);

        $user = $request->user();

        if ($user->avatar_path) {
            Storage::disk('public')->delete($user->avatar_path);
        }

        $path = $request->file('profileimage')->store('avatars', 'public');

        $user->update(['avatar_path' => $path]);

        return back()->with('success', 'Your profile photo has been updated.');
    }
}
