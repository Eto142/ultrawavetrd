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
        Schema::create('pre_ipo_companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('symbol');
            $table->string('sector')->nullable();
            $table->text('description')->nullable();
            $table->decimal('share_price', 15, 2);
            $table->decimal('initial_price', 15, 2);
            $table->unsignedBigInteger('total_shares');
            $table->unsignedBigInteger('shares_sold')->default(0);
            $table->unsignedInteger('min_purchase')->default(1);
            $table->unsignedInteger('max_purchase_per_user')->nullable();
            $table->date('expected_ipo_date')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->string('status')->default('open');
            $table->timestamps();
        });

        DB::table('pre_ipo_companies')->insert([
            [
                'name' => 'SpaceX',
                'symbol' => 'SPACEX',
                'sector' => 'Aerospace',
                'description' => 'Space Exploration Technologies Corp. designs, manufactures, and launches advanced rockets and spacecraft. Founded by Elon Musk, SpaceX is revolutionizing space technology with reusable launch vehicles and the Starlink satellite internet constellation.',
                'share_price' => 185.00,
                'initial_price' => 185.00,
                'total_shares' => 50000,
                'shares_sold' => 1,
                'min_purchase' => 1,
                'max_purchase_per_user' => 500,
                'expected_ipo_date' => '2026-09-15',
                'is_featured' => true,
                'status' => 'open',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Stripe',
                'symbol' => 'STRIPE',
                'sector' => 'Fintech',
                'description' => 'Stripe builds economic infrastructure for the internet, providing payment processing and financial APIs used by businesses of all sizes to accept payments and manage online commerce.',
                'share_price' => 72.50,
                'initial_price' => 72.50,
                'total_shares' => 100000,
                'shares_sold' => 0,
                'min_purchase' => 1,
                'max_purchase_per_user' => 500,
                'expected_ipo_date' => null,
                'is_featured' => true,
                'status' => 'open',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Databricks',
                'symbol' => 'DATABR',
                'sector' => 'Data & AI',
                'description' => 'Databricks provides a unified data and AI platform built around the lakehouse architecture, helping organizations store, process, and analyze large-scale data for analytics and machine learning.',
                'share_price' => 54.00,
                'initial_price' => 54.00,
                'total_shares' => 75000,
                'shares_sold' => 0,
                'min_purchase' => 1,
                'max_purchase_per_user' => 500,
                'expected_ipo_date' => null,
                'is_featured' => false,
                'status' => 'upcoming',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Canva',
                'symbol' => 'CANVA',
                'sector' => 'Design Software',
                'description' => 'Canva is an online design platform that lets individuals and teams create graphics, presentations, and marketing materials through an easy-to-use drag-and-drop editor.',
                'share_price' => 38.25,
                'initial_price' => 38.25,
                'total_shares' => 120000,
                'shares_sold' => 0,
                'min_purchase' => 1,
                'max_purchase_per_user' => 500,
                'expected_ipo_date' => null,
                'is_featured' => true,
                'status' => 'open',
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
        Schema::dropIfExists('pre_ipo_companies');
    }
};
