<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trading_assets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('symbol');
            $table->enum('asset_class', ['crypto', 'forex', 'stock', 'etf', 'index']);
            $table->decimal('price', 20, 8);
            $table->decimal('price_change_24h', 20, 8)->default(0);
            $table->decimal('price_change_pct_24h', 8, 4)->default(0);
            $table->decimal('high_24h', 20, 8);
            $table->decimal('low_24h', 20, 8);
            $table->unsignedBigInteger('volume_24h')->default(0);
            $table->unsignedBigInteger('market_cap')->nullable();
            $table->string('logo_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $assets = [
            // Crypto
            ['name' => 'Bitcoin', 'symbol' => 'BTC', 'asset_class' => 'crypto', 'price' => 63560.00, 'pct' => -0.80, 'volume_24h' => 28450000000, 'market_cap' => 1250000000000, 'logo_url' => 'https://coin-images.coingecko.com/coins/images/1/large/bitcoin.png'],
            ['name' => 'Ethereum', 'symbol' => 'ETH', 'asset_class' => 'crypto', 'price' => 1897.60, 'pct' => 0.00, 'volume_24h' => 12340000000, 'market_cap' => 228000000000, 'logo_url' => 'https://coin-images.coingecko.com/coins/images/279/large/ethereum.png'],
            ['name' => 'Tether', 'symbol' => 'USDT', 'asset_class' => 'crypto', 'price' => 1.00, 'pct' => 0.01, 'volume_24h' => 45600000000, 'market_cap' => 118000000000, 'logo_url' => 'https://coin-images.coingecko.com/coins/images/325/large/Tether.png'],
            ['name' => 'BNB', 'symbol' => 'BNB', 'asset_class' => 'crypto', 'price' => 578.40, 'pct' => 1.85, 'volume_24h' => 1560000000, 'market_cap' => 84000000000, 'logo_url' => 'https://coin-images.coingecko.com/coins/images/825/large/bnb-icon2_2x.png'],
            ['name' => 'Solana', 'symbol' => 'SOL', 'asset_class' => 'crypto', 'price' => 142.30, 'pct' => 3.42, 'volume_24h' => 2980000000, 'market_cap' => 68000000000, 'logo_url' => 'https://coin-images.coingecko.com/coins/images/4128/large/solana.png'],
            ['name' => 'XRP', 'symbol' => 'XRP', 'asset_class' => 'crypto', 'price' => 0.5480, 'pct' => -1.24, 'volume_24h' => 1230000000, 'market_cap' => 31000000000, 'logo_url' => 'https://coin-images.coingecko.com/coins/images/44/large/xrp-symbol-white-128.png'],
            ['name' => 'USD Coin', 'symbol' => 'USDC', 'asset_class' => 'crypto', 'price' => 1.00, 'pct' => 0.00, 'volume_24h' => 5400000000, 'market_cap' => 34000000000, 'logo_url' => 'https://coin-images.coingecko.com/coins/images/6319/large/usdc.png'],
            ['name' => 'Cardano', 'symbol' => 'ADA', 'asset_class' => 'crypto', 'price' => 0.3720, 'pct' => -2.15, 'volume_24h' => 340000000, 'market_cap' => 13100000000, 'logo_url' => 'https://coin-images.coingecko.com/coins/images/975/large/cardano.png'],
            ['name' => 'Dogecoin', 'symbol' => 'DOGE', 'asset_class' => 'crypto', 'price' => 0.1145, 'pct' => 4.67, 'volume_24h' => 780000000, 'market_cap' => 16700000000, 'logo_url' => 'https://coin-images.coingecko.com/coins/images/5/large/dogecoin.png'],
            ['name' => 'TRON', 'symbol' => 'TRX', 'asset_class' => 'crypto', 'price' => 0.1620, 'pct' => 0.58, 'volume_24h' => 410000000, 'market_cap' => 14000000000, 'logo_url' => 'https://coin-images.coingecko.com/coins/images/1094/large/tron-logo.png'],
            ['name' => 'Polkadot', 'symbol' => 'DOT', 'asset_class' => 'crypto', 'price' => 4.850, 'pct' => -1.67, 'volume_24h' => 120000000, 'market_cap' => 6900000000, 'logo_url' => 'https://coin-images.coingecko.com/coins/images/12171/large/polkadot.png'],
            ['name' => 'Chainlink', 'symbol' => 'LINK', 'asset_class' => 'crypto', 'price' => 13.85, 'pct' => 2.94, 'volume_24h' => 390000000, 'market_cap' => 8700000000, 'logo_url' => 'https://coin-images.coingecko.com/coins/images/877/large/chainlink-new-logo.png'],
            ['name' => 'Litecoin', 'symbol' => 'LTC', 'asset_class' => 'crypto', 'price' => 84.20, 'pct' => -0.45, 'volume_24h' => 310000000, 'market_cap' => 6300000000, 'logo_url' => 'https://coin-images.coingecko.com/coins/images/2/large/litecoin.png'],
            ['name' => 'Avalanche', 'symbol' => 'AVAX', 'asset_class' => 'crypto', 'price' => 22.60, 'pct' => 5.12, 'volume_24h' => 260000000, 'market_cap' => 9200000000, 'logo_url' => 'https://coin-images.coingecko.com/coins/images/12559/large/Avalanche_Circle_RedWhite_Trans.png'],
            ['name' => 'Polygon', 'symbol' => 'MATIC', 'asset_class' => 'crypto', 'price' => 0.4180, 'pct' => -3.62, 'volume_24h' => 190000000, 'market_cap' => 4100000000, 'logo_url' => 'https://coin-images.coingecko.com/coins/images/4713/large/polygon.png'],

            // Forex
            ['name' => 'Euro / US Dollar', 'symbol' => 'EUR/USD', 'asset_class' => 'forex', 'price' => 1.1400, 'pct' => 0.06, 'volume_24h' => 0, 'market_cap' => null, 'logo_url' => 'https://hatscripts.github.io/circle-flags/flags/eu.svg'],
            ['name' => 'British Pound / US Dollar', 'symbol' => 'GBP/USD', 'asset_class' => 'forex', 'price' => 1.3260, 'pct' => -0.12, 'volume_24h' => 0, 'market_cap' => null, 'logo_url' => 'https://hatscripts.github.io/circle-flags/flags/gb.svg'],
            ['name' => 'US Dollar / Japanese Yen', 'symbol' => 'USD/JPY', 'asset_class' => 'forex', 'price' => 148.35, 'pct' => 0.31, 'volume_24h' => 0, 'market_cap' => null, 'logo_url' => 'https://hatscripts.github.io/circle-flags/flags/us.svg'],
            ['name' => 'US Dollar / Swiss Franc', 'symbol' => 'USD/CHF', 'asset_class' => 'forex', 'price' => 0.8790, 'pct' => -0.08, 'volume_24h' => 0, 'market_cap' => null, 'logo_url' => 'https://hatscripts.github.io/circle-flags/flags/us.svg'],
            ['name' => 'Australian Dollar / US Dollar', 'symbol' => 'AUD/USD', 'asset_class' => 'forex', 'price' => 0.6510, 'pct' => 0.44, 'volume_24h' => 0, 'market_cap' => null, 'logo_url' => 'https://hatscripts.github.io/circle-flags/flags/au.svg'],
            ['name' => 'US Dollar / Canadian Dollar', 'symbol' => 'USD/CAD', 'asset_class' => 'forex', 'price' => 1.3670, 'pct' => -0.21, 'volume_24h' => 0, 'market_cap' => null, 'logo_url' => 'https://hatscripts.github.io/circle-flags/flags/us.svg'],
            ['name' => 'New Zealand Dollar / US Dollar', 'symbol' => 'NZD/USD', 'asset_class' => 'forex', 'price' => 0.5980, 'pct' => 0.17, 'volume_24h' => 0, 'market_cap' => null, 'logo_url' => 'https://hatscripts.github.io/circle-flags/flags/nz.svg'],
            ['name' => 'Euro / British Pound', 'symbol' => 'EUR/GBP', 'asset_class' => 'forex', 'price' => 0.8595, 'pct' => 0.09, 'volume_24h' => 0, 'market_cap' => null, 'logo_url' => 'https://hatscripts.github.io/circle-flags/flags/eu.svg'],
            ['name' => 'Euro / Japanese Yen', 'symbol' => 'EUR/JPY', 'asset_class' => 'forex', 'price' => 169.10, 'pct' => 0.38, 'volume_24h' => 0, 'market_cap' => null, 'logo_url' => 'https://hatscripts.github.io/circle-flags/flags/eu.svg'],
            ['name' => 'British Pound / Japanese Yen', 'symbol' => 'GBP/JPY', 'asset_class' => 'forex', 'price' => 196.75, 'pct' => -0.27, 'volume_24h' => 0, 'market_cap' => null, 'logo_url' => 'https://hatscripts.github.io/circle-flags/flags/gb.svg'],

            // Stocks
            ['name' => 'Apple Inc.', 'symbol' => 'AAPL', 'asset_class' => 'stock', 'price' => 336.91, 'pct' => 1.17, 'volume_24h' => 41235900, 'market_cap' => null, 'logo_url' => 'https://logo.clearbit.com/apple.com'],
            ['name' => 'Microsoft Corp.', 'symbol' => 'MSFT', 'asset_class' => 'stock', 'price' => 389.10, 'pct' => 1.94, 'volume_24h' => 21345600, 'market_cap' => null, 'logo_url' => 'https://logo.clearbit.com/microsoft.com'],
            ['name' => 'Alphabet Inc.', 'symbol' => 'GOOGL', 'asset_class' => 'stock', 'price' => 326.56, 'pct' => 2.13, 'volume_24h' => 18234500, 'market_cap' => null, 'logo_url' => 'https://logo.clearbit.com/abc.xyz'],
            ['name' => 'Amazon.com, Inc.', 'symbol' => 'AMZN', 'asset_class' => 'stock', 'price' => 231.39, 'pct' => -0.31, 'volume_24h' => 32456100, 'market_cap' => null, 'logo_url' => 'https://logo.clearbit.com/amazon.com'],
            ['name' => 'Tesla, Inc.', 'symbol' => 'TSLA', 'asset_class' => 'stock', 'price' => 309.22, 'pct' => -1.22, 'volume_24h' => 38901400, 'market_cap' => null, 'logo_url' => 'https://logo.clearbit.com/tesla.com'],
            ['name' => 'NVIDIA Corporation', 'symbol' => 'NVDA', 'asset_class' => 'stock', 'price' => 196.51, 'pct' => -4.99, 'volume_24h' => 45678200, 'market_cap' => null, 'logo_url' => 'https://logo.clearbit.com/nvidia.com'],
            ['name' => 'Meta Platforms Inc.', 'symbol' => 'META', 'asset_class' => 'stock', 'price' => 593.87, 'pct' => -0.22, 'volume_24h' => 14567300, 'market_cap' => null, 'logo_url' => 'https://logo.clearbit.com/meta.com'],
            ['name' => 'Netflix, Inc.', 'symbol' => 'NFLX', 'asset_class' => 'stock', 'price' => 70.40, 'pct' => 0.44, 'volume_24h' => 5678900, 'market_cap' => null, 'logo_url' => 'https://logo.clearbit.com/netflix.com'],
            ['name' => 'JPMorgan Chase & Co.', 'symbol' => 'JPM', 'asset_class' => 'stock', 'price' => 356.20, 'pct' => 0.85, 'volume_24h' => 9345200, 'market_cap' => null, 'logo_url' => 'https://logo.clearbit.com/jpmorganchase.com'],
            ['name' => 'Boeing Company', 'symbol' => 'BA', 'asset_class' => 'stock', 'price' => 211.50, 'pct' => 0.95, 'volume_24h' => 6234800, 'market_cap' => null, 'logo_url' => 'https://logo.clearbit.com/boeing.com'],

            // ETFs
            ['name' => 'SPDR S&P 500 ETF Trust', 'symbol' => 'SPY', 'asset_class' => 'etf', 'price' => 561.30, 'pct' => 0.62, 'volume_24h' => 68450000, 'market_cap' => null, 'logo_url' => 'https://logo.clearbit.com/ssga.com'],
            ['name' => 'Invesco QQQ Trust', 'symbol' => 'QQQ', 'asset_class' => 'etf', 'price' => 486.75, 'pct' => 0.91, 'volume_24h' => 41230000, 'market_cap' => null, 'logo_url' => 'https://logo.clearbit.com/invesco.com'],
            ['name' => 'SPDR Dow Jones Industrial Average ETF', 'symbol' => 'DIA', 'asset_class' => 'etf', 'price' => 411.20, 'pct' => 0.28, 'volume_24h' => 3120000, 'market_cap' => null, 'logo_url' => 'https://logo.clearbit.com/ssga.com'],
            ['name' => 'iShares Russell 2000 ETF', 'symbol' => 'IWM', 'asset_class' => 'etf', 'price' => 218.40, 'pct' => -0.55, 'volume_24h' => 22340000, 'market_cap' => null, 'logo_url' => 'https://logo.clearbit.com/ishares.com'],
            ['name' => 'SPDR Gold Shares', 'symbol' => 'GLD', 'asset_class' => 'etf', 'price' => 245.90, 'pct' => 1.35, 'volume_24h' => 7450000, 'market_cap' => null, 'logo_url' => 'https://logo.clearbit.com/ssga.com'],
            ['name' => 'ARK Innovation ETF', 'symbol' => 'ARKK', 'asset_class' => 'etf', 'price' => 52.80, 'pct' => -2.87, 'volume_24h' => 5670000, 'market_cap' => null, 'logo_url' => 'https://logo.clearbit.com/ark-invest.com'],
            ['name' => 'Financial Select Sector SPDR Fund', 'symbol' => 'XLF', 'asset_class' => 'etf', 'price' => 46.15, 'pct' => 0.44, 'volume_24h' => 34500000, 'market_cap' => null, 'logo_url' => 'https://logo.clearbit.com/ssga.com'],
            ['name' => 'iShares MSCI Emerging Markets ETF', 'symbol' => 'EEM', 'asset_class' => 'etf', 'price' => 43.60, 'pct' => -0.19, 'volume_24h' => 28900000, 'market_cap' => null, 'logo_url' => 'https://logo.clearbit.com/ishares.com'],

            // Indices
            ['name' => 'Dow Jones Industrial Average', 'symbol' => 'US30', 'asset_class' => 'index', 'price' => 41250.60, 'pct' => 0.34, 'volume_24h' => 0, 'market_cap' => null, 'logo_url' => 'https://logo.clearbit.com/wsj.com'],
            ['name' => 'Nasdaq 100', 'symbol' => 'US100', 'asset_class' => 'index', 'price' => 19870.15, 'pct' => 0.78, 'volume_24h' => 0, 'market_cap' => null, 'logo_url' => 'https://logo.clearbit.com/nasdaq.com'],
            ['name' => 'S&P 500', 'symbol' => 'SPX500', 'asset_class' => 'index', 'price' => 5620.40, 'pct' => 0.51, 'volume_24h' => 0, 'market_cap' => null, 'logo_url' => 'https://logo.clearbit.com/spglobal.com'],
            ['name' => 'FTSE 100', 'symbol' => 'UK100', 'asset_class' => 'index', 'price' => 8195.30, 'pct' => -0.22, 'volume_24h' => 0, 'market_cap' => null, 'logo_url' => 'https://logo.clearbit.com/londonstockexchange.com'],
            ['name' => 'DAX 40', 'symbol' => 'GER40', 'asset_class' => 'index', 'price' => 18640.90, 'pct' => 0.65, 'volume_24h' => 0, 'market_cap' => null, 'logo_url' => 'https://logo.clearbit.com/deutsche-boerse.com'],
            ['name' => 'Nikkei 225', 'symbol' => 'JPN225', 'asset_class' => 'index', 'price' => 39420.10, 'pct' => -0.41, 'volume_24h' => 0, 'market_cap' => null, 'logo_url' => 'https://logo.clearbit.com/jpx.co.jp'],
            ['name' => 'ASX 200', 'symbol' => 'AUS200', 'asset_class' => 'index', 'price' => 8120.55, 'pct' => 0.19, 'volume_24h' => 0, 'market_cap' => null, 'logo_url' => 'https://logo.clearbit.com/asx.com.au'],
        ];

        $now = now();

        DB::table('trading_assets')->insert(array_map(function ($asset) use ($now) {
            $priceChange = round($asset['price'] * $asset['pct'] / 100, 8);

            return [
                'name' => $asset['name'],
                'symbol' => $asset['symbol'],
                'asset_class' => $asset['asset_class'],
                'price' => $asset['price'],
                'price_change_24h' => $priceChange,
                'price_change_pct_24h' => $asset['pct'],
                'high_24h' => round($asset['price'] + abs($priceChange) * 1.3, 8),
                'low_24h' => round(max($asset['price'] - abs($priceChange) * 1.3, 0), 8),
                'volume_24h' => $asset['volume_24h'],
                'market_cap' => $asset['market_cap'],
                'logo_url' => $asset['logo_url'],
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }, $assets));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trading_assets');
    }
};
