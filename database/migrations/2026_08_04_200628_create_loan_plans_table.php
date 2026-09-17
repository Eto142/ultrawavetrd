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
        Schema::create('loan_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('min_amount', 15, 2);
            $table->decimal('max_amount', 15, 2);
            $table->decimal('interest_rate', 5, 2);
            $table->string('interest_type');
            $table->unsignedInteger('min_duration');
            $table->unsignedInteger('max_duration');
            $table->unsignedInteger('max_active_loans')->default(1);
            $table->decimal('min_account_balance', 15, 2)->default(0);
            $table->boolean('requires_collateral')->default(false);
            $table->decimal('collateral_percentage', 5, 2)->nullable();
            $table->decimal('processing_fee', 5, 2)->default(0);
            $table->unsignedInteger('grace_period_days')->default(0);
            $table->decimal('late_fee_percentage', 5, 2)->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        DB::table('loan_plans')->insert([
            [
                'name' => 'Trading Margin Loan',
                'description' => 'Short-term leverage for active traders. Higher amounts, lower rates, designed for quick market opportunities.',
                'min_amount' => 5000.00,
                'max_amount' => 500000.00,
                'interest_rate' => 3.50,
                'interest_type' => 'simple',
                'min_duration' => 1,
                'max_duration' => 12,
                'max_active_loans' => 2,
                'min_account_balance' => 1000.00,
                'requires_collateral' => false,
                'collateral_percentage' => null,
                'processing_fee' => 0.50,
                'grace_period_days' => 3,
                'late_fee_percentage' => 2.00,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Personal Loan',
                'description' => 'General-purpose loan for personal needs. Medium amounts with flexible terms.',
                'min_amount' => 1000.00,
                'max_amount' => 100000.00,
                'interest_rate' => 8.00,
                'interest_type' => 'compound',
                'min_duration' => 3,
                'max_duration' => 36,
                'max_active_loans' => 1,
                'min_account_balance' => 500.00,
                'requires_collateral' => false,
                'collateral_percentage' => null,
                'processing_fee' => 1.00,
                'grace_period_days' => 5,
                'late_fee_percentage' => 1.50,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Business Expansion Loan',
                'description' => 'Long-term financing for business growth and investment expansion.',
                'min_amount' => 10000.00,
                'max_amount' => 1000000.00,
                'interest_rate' => 6.00,
                'interest_type' => 'compound',
                'min_duration' => 6,
                'max_duration' => 60,
                'max_active_loans' => 1,
                'min_account_balance' => 5000.00,
                'requires_collateral' => true,
                'collateral_percentage' => 10.00,
                'processing_fee' => 1.50,
                'grace_period_days' => 7,
                'late_fee_percentage' => 1.00,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Quick Cash Loan',
                'description' => 'Small, short-term loan for immediate needs. Fast approval, higher rate.',
                'min_amount' => 100.00,
                'max_amount' => 10000.00,
                'interest_rate' => 12.00,
                'interest_type' => 'simple',
                'min_duration' => 1,
                'max_duration' => 6,
                'max_active_loans' => 1,
                'min_account_balance' => 0.00,
                'requires_collateral' => false,
                'collateral_percentage' => null,
                'processing_fee' => 2.00,
                'grace_period_days' => 0,
                'late_fee_percentage' => 3.00,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Portfolio Leverage Loan',
                'description' => 'Leverage your trading portfolio with competitive rates. Designed for experienced investors.',
                'min_amount' => 25000.00,
                'max_amount' => 2000000.00,
                'interest_rate' => 4.50,
                'interest_type' => 'compound',
                'min_duration' => 3,
                'max_duration' => 24,
                'max_active_loans' => 1,
                'min_account_balance' => 10000.00,
                'requires_collateral' => true,
                'collateral_percentage' => 15.00,
                'processing_fee' => 0.75,
                'grace_period_days' => 5,
                'late_fee_percentage' => 1.50,
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
        Schema::dropIfExists('loan_plans');
    }
};
