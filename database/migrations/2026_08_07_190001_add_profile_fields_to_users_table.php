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
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar_path')->nullable()->after('gender');
            $table->string('address')->nullable()->after('country');
            $table->string('state')->nullable()->after('address');
            $table->string('zipcode')->nullable()->after('state');
            $table->string('referral_code')->nullable()->unique()->after('zipcode');
            $table->foreignId('referred_by')->nullable()->after('referral_code')->constrained('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('referred_by');
            $table->dropColumn(['avatar_path', 'address', 'state', 'zipcode', 'referral_code']);
        });
    }
};
