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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('symbol')->unique();
            $table->string('name');
            $table->string('logo_url')->nullable();
            $table->decimal('price', 15, 4);
            $table->decimal('previous_close', 15, 4);
            $table->decimal('day_high', 15, 4);
            $table->decimal('day_low', 15, 4);
            $table->unsignedBigInteger('volume')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $stocks = [
            ['symbol' => 'AMD', 'name' => 'Advanced Micro Devices, Inc.', 'logo_url' => null, 'price' => 494.95, 'change_percent' => -5.17, 'volume' => 24086408],
            ['symbol' => 'GOOGL', 'name' => 'Alphabet Inc.', 'logo_url' => 'https://static2.finnhub.io/file/publicdatany/finnhubimage/stock_logo/GOOG.png', 'price' => 326.56, 'change_percent' => 2.13, 'volume' => 18234500],
            ['symbol' => 'AMZN', 'name' => 'Amazon.com, Inc.', 'logo_url' => 'https://static2.finnhub.io/file/publicdatany/finnhubimage/stock_logo/AMZN.png', 'price' => 231.39, 'change_percent' => -0.31, 'volume' => 32456100],
            ['symbol' => 'AAPL', 'name' => 'Apple Inc.', 'logo_url' => 'https://static2.finnhub.io/file/publicdatany/finnhubimage/stock_logo/AAPL.png', 'price' => 336.91, 'change_percent' => 1.17, 'volume' => 41235900],
            ['symbol' => 'BA', 'name' => 'Boeing Company', 'logo_url' => 'https://logo.clearbit.com/boeing.com', 'price' => 211.50, 'change_percent' => 0.95, 'volume' => 6234800],
            ['symbol' => 'INTC', 'name' => 'Intel Corporation', 'logo_url' => 'https://static2.finnhub.io/file/publicdatany/finnhubimage/stock_logo/INTC.png', 'price' => 91.67, 'change_percent' => -0.70, 'volume' => 28456700],
            ['symbol' => 'JPM', 'name' => 'JPMorgan Chase & Co.', 'logo_url' => 'https://logo.clearbit.com/jpmorganchase.com', 'price' => 356.20, 'change_percent' => 0.85, 'volume' => 9345200],
            ['symbol' => 'META', 'name' => 'Meta Platforms Inc Class A', 'logo_url' => 'https://static2.finnhub.io/file/publicdatany/finnhubimage/stock_logo/FB.png', 'price' => 593.87, 'change_percent' => -0.22, 'volume' => 14567300],
            ['symbol' => 'MSFT', 'name' => 'Microsoft Corp.', 'logo_url' => 'https://static2.finnhub.io/file/publicdatany/finnhubimage/stock_logo/MSFT.png', 'price' => 389.10, 'change_percent' => 1.94, 'volume' => 21345600],
            ['symbol' => 'NFLX', 'name' => 'Netflix, Inc.', 'logo_url' => 'https://static2.finnhub.io/file/publicdatany/finnhubimage/stock_logo/NFLX.png', 'price' => 70.40, 'change_percent' => 0.44, 'volume' => 5678900],
            ['symbol' => 'NVDA', 'name' => 'NVIDIA Corporation', 'logo_url' => 'https://static2.finnhub.io/file/publicdatany/finnhubimage/stock_logo/NVDA.png', 'price' => 196.51, 'change_percent' => -4.99, 'volume' => 45678200],
            ['symbol' => 'PYPL', 'name' => 'PayPal Holdings Inc', 'logo_url' => 'https://logo.clearbit.com/paypal.com', 'price' => 56.07, 'change_percent' => -0.14, 'volume' => 8901200],
            ['symbol' => 'TSLA', 'name' => 'Tesla, Inc.', 'logo_url' => 'https://static2.finnhub.io/file/publicdatany/finnhubimage/stock_logo/TSLA.png', 'price' => 309.22, 'change_percent' => -1.22, 'volume' => 38901400],
            ['symbol' => 'DIS', 'name' => 'The Walt Disney Company', 'logo_url' => 'https://logo.clearbit.com/disney.com', 'price' => 96.65, 'change_percent' => 1.90, 'volume' => 11234500],
        ];

        $now = now();

        DB::table('stocks')->insert(array_map(function ($stock) use ($now) {
            $previousClose = round($stock['price'] / (1 + $stock['change_percent'] / 100), 4);

            return [
                'symbol' => $stock['symbol'],
                'name' => $stock['name'],
                'logo_url' => $stock['logo_url'],
                'price' => $stock['price'],
                'previous_close' => $previousClose,
                'day_high' => round($stock['price'] * 1.015, 4),
                'day_low' => round($stock['price'] * 0.98, 4),
                'volume' => $stock['volume'],
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }, $stocks));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
