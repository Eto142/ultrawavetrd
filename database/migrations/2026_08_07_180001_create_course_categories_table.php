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
        Schema::create('course_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        $now = now();

        DB::table('course_categories')->insert([
            ['name' => 'Crypto Basics', 'slug' => 'crypto-basics', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Technical Analysis', 'slug' => 'technical-analysis', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Risk Management', 'slug' => 'risk-management', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Forex', 'slug' => 'forex', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_categories');
    }
};
