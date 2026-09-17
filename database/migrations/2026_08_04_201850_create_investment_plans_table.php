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
        Schema::create('investment_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('badge_label')->nullable();
            $table->decimal('min_amount', 15, 2);
            $table->decimal('max_amount', 15, 2);
            $table->unsignedInteger('duration_days');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        DB::table('investment_plans')->insert([
            [
                'name' => 'Basic Plan',
                'badge_label' => 'Popular',
                'min_amount' => 1000.00,
                'max_amount' => 4999.00,
                'duration_days' => 30,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Standard Plan',
                'badge_label' => 'regular',
                'min_amount' => 5000.00,
                'max_amount' => 19999.00,
                'duration_days' => 30,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Business Plan',
                'badge_label' => 'VIP',
                'min_amount' => 10000.00,
                'max_amount' => 49999.00,
                'duration_days' => 30,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Elite Plan',
                'badge_label' => 'VIP',
                'min_amount' => 50000.00,
                'max_amount' => 500000.00,
                'duration_days' => 30,
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
        Schema::dropIfExists('investment_plans');
    }
};
