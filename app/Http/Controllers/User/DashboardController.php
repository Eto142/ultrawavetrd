<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use App\Models\Balance;
class DashboardController extends Controller
{
    /**
     * Display the user dashboard.
     */
    public function index(Request $request)
    {
        $balance = Balance::for($request->user());
        $marketOverview = $this->marketOverview();

        return view('user.home', compact('balance', 'marketOverview'));
    }

    private function marketOverview(): array
    {
        $coins = [
            'bitcoin' => ['symbol' => 'BTC', 'image' => 'https://coin-images.coingecko.com/coins/images/1/large/bitcoin.png'],
            'ethereum' => ['symbol' => 'ETH', 'image' => 'https://coin-images.coingecko.com/coins/images/279/large/ethereum.png'],
            'tether' => ['symbol' => 'USDT', 'image' => 'https://coin-images.coingecko.com/coins/images/325/large/Tether.png'],
            'binancecoin' => ['symbol' => 'BNB', 'image' => 'https://coin-images.coingecko.com/coins/images/825/large/bnb-icon2_2x.png'],
            'usd-coin' => ['symbol' => 'USDC', 'image' => 'https://coin-images.coingecko.com/coins/images/6319/large/USDC.png'],
        ];

        try {
            $response = Http::acceptJson()
                ->timeout(5)
                ->retry(1, 100)
                ->get('https://api.coingecko.com/api/v3/simple/price', [
                    'ids' => implode(',', array_keys($coins)),
                    'vs_currencies' => 'usd',
                    'include_24hr_change' => 'true',
                ])
                ->throw()
                ->json();

            $marketOverview = collect($coins)->map(function (array $coin, string $id) use ($response) {
                $marketData = $response[$id] ?? null;

                if (! is_array($marketData) || ! isset($marketData['usd'])) {
                    return null;
                }

                return [
                    ...$coin,
                    'price' => (float) $marketData['usd'],
                    'change' => (float) ($marketData['usd_24h_change'] ?? 0),
                ];
            })->filter()->values()->all();

            if ($marketOverview !== []) {
                Cache::put('market_overview', $marketOverview, now()->addMinutes(10));

                return $marketOverview;
            }
        } catch (\Throwable $exception) {
            report($exception);
        }

        return Cache::get('market_overview', []);
    }

    public function profile()
    {
        return view('user.profile');
    }

}
