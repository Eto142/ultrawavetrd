<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('trading_asset_id')->constrained()->cascadeOnDelete();
            $table->enum('trade_type', ['binary', 'spot']);
            $table->enum('side', ['buy', 'sell']);
            $table->decimal('amount', 15, 2);
            $table->unsignedInteger('leverage')->default(1);
            $table->unsignedInteger('duration_minutes')->nullable();
            $table->decimal('entry_price', 20, 8);
            $table->decimal('exit_price', 20, 8)->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->boolean('is_demo')->default(false);
            $table->timestamp('close_requested_at')->nullable();
            $table->enum('status', ['open', 'won', 'lost'])->default('open');
            $table->decimal('pnl', 15, 2)->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trades');
    }
};
