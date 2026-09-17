<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('deposits')->where('status', 'approved')->update(['status' => '1']);
        DB::table('deposits')->whereNotIn('status', ['0', '1'])->update(['status' => '0']);
        DB::statement('ALTER TABLE deposits MODIFY status TINYINT UNSIGNED NOT NULL DEFAULT 0');

        DB::table('withdrawals')->where('status', 'approved')->update(['status' => '1']);
        DB::table('withdrawals')->whereNotIn('status', ['0', '1'])->update(['status' => '0']);
        DB::statement('ALTER TABLE withdrawals MODIFY status TINYINT UNSIGNED NOT NULL DEFAULT 0');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE deposits MODIFY status VARCHAR(255) NOT NULL DEFAULT 'pending'");
        DB::table('deposits')->where('status', '1')->update(['status' => 'approved']);
        DB::table('deposits')->where('status', '0')->update(['status' => 'pending']);

        DB::statement("ALTER TABLE withdrawals MODIFY status VARCHAR(255) NOT NULL DEFAULT 'pending'");
        DB::table('withdrawals')->where('status', '1')->update(['status' => 'approved']);
        DB::table('withdrawals')->where('status', '0')->update(['status' => 'pending']);
    }
};
