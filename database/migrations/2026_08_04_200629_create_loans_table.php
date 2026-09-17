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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('loan_plan_id')->constrained()->cascadeOnDelete();
            $table->decimal('amount', 15, 2);
            $table->unsignedInteger('duration');
            $table->text('purpose')->nullable();
            $table->decimal('interest_rate', 5, 2);
            $table->string('interest_type');
            $table->decimal('total_interest', 15, 2);
            $table->decimal('processing_fee', 15, 2);
            $table->decimal('total_repayable', 15, 2);
            $table->decimal('monthly_payment', 15, 2);
            $table->unsignedTinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
