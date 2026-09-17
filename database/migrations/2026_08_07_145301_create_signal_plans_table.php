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
        Schema::create('signal_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('badge_label')->nullable();
            $table->decimal('price', 15, 2);
            $table->unsignedInteger('duration_days');
            $table->json('features')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        DB::table('signal_plans')->insert([
            [
                'name' => 'Alpha Signals',
                'badge_label' => null,
                'price' => 99.00,
                'duration_days' => 7,
                'features' => json_encode([
                    'General trading signals',
                    'High-accuracy signals with risk-reward ratios.',
                    '24/7 Expert support',
                ]),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Velocity Pro Signals',
                'badge_label' => 'Popular',
                'price' => 299.00,
                'duration_days' => 28,
                'features' => json_encode([
                    'General trading signals',
                    'Real-time signals with smart trade execution.',
                    '24/7 Expert support',
                ]),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Legendary Investor Plan',
                'badge_label' => 'VIP',
                'price' => 999.00,
                'duration_days' => 84,
                'features' => json_encode([
                    'General trading signals',
                    'Lifetime mentorship, AI-powered signals, & personalized strategies.',
                    '24/7 Expert support',
                ]),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signal_plans');
    }
};
