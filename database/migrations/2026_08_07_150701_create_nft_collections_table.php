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
        Schema::create('nft_collections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        DB::table('nft_collections')->insert([
            ['name' => 'Cosmic Explorers', 'slug' => 'cosmic-explorers', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Urban Lens', 'slug' => 'urban-lens', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Beat Drops', 'slug' => 'beat-drops', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pixel Legends', 'slug' => 'pixel-legends', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Meta Estates', 'slug' => 'meta-estates', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nft_collections');
    }
};
