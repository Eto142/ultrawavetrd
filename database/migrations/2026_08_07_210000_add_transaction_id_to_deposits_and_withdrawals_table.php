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
        Schema::table('deposits', function (Blueprint $table) {
            $table->string('transaction_id')->nullable()->unique()->after('user_id');
        });

        Schema::table('withdrawals', function (Blueprint $table) {
            $table->string('transaction_id')->nullable()->unique()->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('deposits', function (Blueprint $table) {
            $table->dropColumn('transaction_id');
        });

        Schema::table('withdrawals', function (Blueprint $table) {
            $table->dropColumn('transaction_id');
        });
    }
};
