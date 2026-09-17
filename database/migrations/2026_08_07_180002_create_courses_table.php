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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('thumbnail_url')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->string('level')->default('Beginner');
            $table->string('instructor_name')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $categoryIds = DB::table('course_categories')->pluck('id', 'slug');

        $now = now();

        DB::table('courses')->insert([
            [
                'course_category_id' => $categoryIds['crypto-basics'],
                'title' => 'Introduction to Cryptocurrency',
                'slug' => 'introduction-to-cryptocurrency',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1639762681485-074b7f938ba0?w=600',
                'description' => "A beginner-friendly walkthrough of what cryptocurrency is, how blockchain technology works, and how to safely buy your first coins. No prior experience required.",
                'price' => 0,
                'level' => 'Beginner',
                'instructor_name' => 'Finvora Academy',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'course_category_id' => $categoryIds['technical-analysis'],
                'title' => 'Technical Analysis Masterclass',
                'slug' => 'technical-analysis-masterclass',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?w=600',
                'description' => "Learn to read price action like a professional trader. This masterclass covers candlestick patterns, support and resistance, chart patterns, and the indicators that matter most.",
                'price' => 49.00,
                'level' => 'Intermediate',
                'instructor_name' => 'Finvora Academy',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'course_category_id' => $categoryIds['risk-management'],
                'title' => 'Risk Management & Portfolio Strategy',
                'slug' => 'risk-management-portfolio-strategy',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600',
                'description' => "Protect your capital and grow it consistently. This course covers position sizing, diversification, and the portfolio construction principles used by professional fund managers.",
                'price' => 29.00,
                'level' => 'Intermediate',
                'instructor_name' => 'Finvora Academy',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'course_category_id' => $categoryIds['forex'],
                'title' => 'Forex Trading for Beginners',
                'slug' => 'forex-trading-for-beginners',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1642790106117-e829e14a795f?w=600',
                'description' => "Your first step into currency trading. Learn how the forex market works, how pips and lots are calculated, and how to place your first trade with confidence.",
                'price' => 19.00,
                'level' => 'Beginner',
                'instructor_name' => 'Finvora Academy',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
