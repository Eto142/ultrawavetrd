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
        Schema::create('traders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('avatar_url')->nullable();
            $table->string('style_label')->default('Mixed');
            $table->string('risk_level')->default('Medium');
            $table->string('headline')->nullable();
            $table->text('bio')->nullable();
            $table->unsignedBigInteger('followers_count')->default(0);
            $table->decimal('daily_roi_pct', 8, 2)->default(0);
            $table->decimal('total_roi_pct', 10, 2)->default(0);
            $table->decimal('win_rate_pct', 5, 2)->default(0);
            $table->decimal('min_capital', 15, 2)->default(0);
            $table->unsignedInteger('duration_days')->default(30);
            $table->unsignedInteger('total_trades')->nullable();
            $table->unsignedTinyInteger('years_experience')->nullable();
            $table->json('markets_traded')->nullable();
            $table->boolean('is_verified')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $traders = [
            [
                'name' => 'Albert Burgess',
                'avatar_url' => 'https://i.pravatar.cc/300?img=12',
                'risk_level' => 'Medium',
                'headline' => 'Macro-driven swing trader focused on major FX pairs and blue-chip crypto.',
                'bio' => "Albert has spent nearly a decade trading global macro themes across currencies and digital assets. His approach blends fundamental catalysts with disciplined technical entries, prioritizing consistent, repeatable gains over high-risk swings.",
                'followers_count' => 4000,
                'daily_roi_pct' => 12.00,
                'total_roi_pct' => 120.0,
                'win_rate_pct' => 67,
                'min_capital' => 500.00,
                'total_trades' => 842,
                'years_experience' => 8,
                'markets_traded' => ['Forex', 'Crypto', 'Indices'],
            ],
            [
                'name' => 'Axel Merk',
                'avatar_url' => 'https://i.pravatar.cc/300?img=33',
                'risk_level' => 'High',
                'headline' => 'Currency strategist specializing in volatility breakouts.',
                'bio' => "Axel built his reputation trading high-volatility FX and commodity moves around major central bank events. He favors momentum-driven setups and manages risk tightly with predefined stop levels on every position.",
                'followers_count' => 3000,
                'daily_roi_pct' => 20.00,
                'total_roi_pct' => 598.0,
                'win_rate_pct' => 65,
                'min_capital' => 2500.00,
                'total_trades' => 615,
                'years_experience' => 10,
                'markets_traded' => ['Forex', 'Commodities'],
            ],
            [
                'name' => 'Paul Tudor Jones',
                'avatar_url' => 'https://i.pravatar.cc/300?img=14',
                'risk_level' => 'Medium',
                'headline' => 'Veteran global macro investor with a multi-decade track record.',
                'bio' => "A legendary name in global macro trading, known for reading market cycles and positioning ahead of major turns across equities, bonds, and currencies. Followers copy his trades for exposure to institutional-grade macro strategy.",
                'followers_count' => 40000,
                'daily_roi_pct' => 6.34,
                'total_roi_pct' => 4570.0,
                'win_rate_pct' => 86,
                'min_capital' => 1300.00,
                'total_trades' => 2103,
                'years_experience' => 20,
                'markets_traded' => ['Indices', 'Forex', 'Stocks', 'Commodities'],
            ],
            [
                'name' => 'Andrew Kreiger',
                'avatar_url' => 'https://i.pravatar.cc/300?img=22',
                'risk_level' => 'High',
                'headline' => 'Aggressive FX specialist known for outsized directional bets.',
                'bio' => "Andrew is renowned for identifying structurally mispriced currencies and taking large, high-conviction positions. His track record includes some of the most talked-about single trades in the copy trading community.",
                'followers_count' => 5456766,
                'daily_roi_pct' => 14.00,
                'total_roi_pct' => 9000.0,
                'win_rate_pct' => 95,
                'min_capital' => 5400.00,
                'total_trades' => 3985,
                'years_experience' => 15,
                'markets_traded' => ['Forex', 'Crypto'],
            ],
            [
                'name' => 'Andrei Neagu',
                'avatar_url' => 'https://i.pravatar.cc/300?img=45',
                'risk_level' => 'High',
                'headline' => 'Crypto-native trader capturing momentum across major and altcoins.',
                'bio' => "Andrei focuses almost exclusively on digital assets, combining on-chain data with technical momentum signals to time entries around major crypto market cycles. Followers benefit from fast, high-frequency copy execution.",
                'followers_count' => 7000000,
                'daily_roi_pct' => 65.00,
                'total_roi_pct' => 6000.0,
                'win_rate_pct' => 66,
                'min_capital' => 300.00,
                'total_trades' => 1560,
                'years_experience' => 12,
                'markets_traded' => ['Crypto'],
            ],
            [
                'name' => 'Abdullah Rasheed',
                'avatar_url' => 'https://i.pravatar.cc/300?img=6',
                'risk_level' => 'Medium',
                'headline' => 'Systematic trend-follower across indices and commodities.',
                'bio' => "Abdullah runs a rules-based trend-following system built over years of backtesting across indices, commodities, and metals. His disciplined, unemotional execution has produced steady long-term compounding for followers.",
                'followers_count' => 65000,
                'daily_roi_pct' => 12.00,
                'total_roi_pct' => 18000.0,
                'win_rate_pct' => 78,
                'min_capital' => 700.00,
                'total_trades' => 4210,
                'years_experience' => 9,
                'markets_traded' => ['Indices', 'Commodities', 'Forex'],
            ],
            [
                'name' => 'Alex Gonzalez',
                'avatar_url' => 'https://i.pravatar.cc/300?img=51',
                'risk_level' => 'Low',
                'headline' => 'Conservative stock picker prioritizing capital preservation.',
                'bio' => "Alex takes a measured, research-driven approach to equities, favoring quality companies and controlled position sizing. His low-drawdown style appeals to followers who want steady growth with minimal volatility.",
                'followers_count' => 400000,
                'daily_roi_pct' => 13.00,
                'total_roi_pct' => 1200.0,
                'win_rate_pct' => 98,
                'min_capital' => 500.00,
                'total_trades' => 972,
                'years_experience' => 6,
                'markets_traded' => ['Stocks', 'ETFs'],
            ],
        ];

        $now = now();

        DB::table('traders')->insert(array_map(function ($trader) use ($now) {
            return [
                'name' => $trader['name'],
                'avatar_url' => $trader['avatar_url'],
                'style_label' => 'Mixed',
                'risk_level' => $trader['risk_level'],
                'headline' => $trader['headline'],
                'bio' => $trader['bio'],
                'followers_count' => $trader['followers_count'],
                'daily_roi_pct' => $trader['daily_roi_pct'],
                'total_roi_pct' => $trader['total_roi_pct'],
                'win_rate_pct' => $trader['win_rate_pct'],
                'min_capital' => $trader['min_capital'],
                'duration_days' => 30,
                'total_trades' => $trader['total_trades'],
                'years_experience' => $trader['years_experience'],
                'markets_traded' => json_encode($trader['markets_traded']),
                'is_verified' => true,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }, $traders));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traders');
    }
};
