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
        Schema::create('signals', function (Blueprint $table) {
            $table->id();
            $table->string('symbol');
            $table->enum('direction', ['buy', 'sell']);
            $table->decimal('entry_price', 15, 5);
            $table->decimal('take_profit', 15, 5)->nullable();
            $table->decimal('stop_loss', 15, 5)->nullable();
            $table->enum('status', ['active', 'tp_hit', 'sl_hit', 'closed'])->default('active');
            $table->text('notes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signals');
    }
};
