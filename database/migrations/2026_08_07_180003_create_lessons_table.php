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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('course_category_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('duration')->nullable();
            $table->string('video_url')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        $courseIds = DB::table('courses')->pluck('id', 'slug');
        $categoryIds = DB::table('course_categories')->pluck('id', 'slug');
        $now = now();

        $lessons = [
            // Introduction to Cryptocurrency
            ['course' => 'introduction-to-cryptocurrency', 'title' => 'What is Cryptocurrency?', 'description' => 'An overview of digital currency and why it matters.', 'duration' => '6:20', 'sort_order' => 1],
            ['course' => 'introduction-to-cryptocurrency', 'title' => 'How Blockchain Works', 'description' => 'The technology that powers every cryptocurrency, explained simply.', 'duration' => '8:45', 'sort_order' => 2],
            ['course' => 'introduction-to-cryptocurrency', 'title' => 'Buying Your First Crypto', 'description' => 'A step-by-step guide to making your first purchase safely.', 'duration' => '5:10', 'sort_order' => 3],

            // Technical Analysis Masterclass
            ['course' => 'technical-analysis-masterclass', 'title' => 'Reading Candlestick Charts', 'description' => 'Understand what every candle is telling you.', 'duration' => '9:05', 'sort_order' => 1],
            ['course' => 'technical-analysis-masterclass', 'title' => 'Support & Resistance', 'description' => 'Identify the price levels that matter most.', 'duration' => '7:40', 'sort_order' => 2],
            ['course' => 'technical-analysis-masterclass', 'title' => 'Chart Patterns', 'description' => 'Spot recurring patterns before they play out.', 'duration' => '10:15', 'sort_order' => 3],
            ['course' => 'technical-analysis-masterclass', 'title' => 'Indicators & Oscillators', 'description' => 'Add RSI, MACD, and moving averages to your toolkit.', 'duration' => '11:30', 'sort_order' => 4],

            // Risk Management & Portfolio Strategy
            ['course' => 'risk-management-portfolio-strategy', 'title' => 'Position Sizing Fundamentals', 'description' => 'How much to risk on any single trade.', 'duration' => '8:00', 'sort_order' => 1],
            ['course' => 'risk-management-portfolio-strategy', 'title' => 'Building a Diversified Portfolio', 'description' => 'Spread risk across assets the right way.', 'duration' => '9:50', 'sort_order' => 2],

            // Forex Trading for Beginners
            ['course' => 'forex-trading-for-beginners', 'title' => 'Forex Market Basics', 'description' => 'How the world\'s largest financial market operates.', 'duration' => '6:55', 'sort_order' => 1],
            ['course' => 'forex-trading-for-beginners', 'title' => 'Understanding Pips & Lots', 'description' => 'The units every forex trader needs to know.', 'duration' => '7:10', 'sort_order' => 2],
            ['course' => 'forex-trading-for-beginners', 'title' => 'Your First Forex Trade', 'description' => 'Placing and managing a trade from start to finish.', 'duration' => '8:25', 'sort_order' => 3],
        ];

        DB::table('lessons')->insert(array_map(function ($lesson) use ($courseIds, $now) {
            return [
                'course_id' => $courseIds[$lesson['course']],
                'course_category_id' => null,
                'title' => $lesson['title'],
                'description' => $lesson['description'],
                'duration' => $lesson['duration'],
                'video_url' => null,
                'sort_order' => $lesson['sort_order'],
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }, $lessons));

        // Standalone lessons shown in the "More Lessons" section, not tied to a paid course.
        DB::table('lessons')->insert([
            [
                'course_id' => null,
                'course_category_id' => $categoryIds['crypto-basics'],
                'title' => 'Bitcoin vs Ethereum',
                'description' => 'Key differences between the two largest cryptocurrencies.',
                'duration' => '7:30',
                'video_url' => null,
                'sort_order' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'course_id' => null,
                'course_category_id' => $categoryIds['technical-analysis'],
                'title' => 'Volume Profile Trading',
                'description' => 'Use volume profile to find high-probability setups.',
                'duration' => '9:15',
                'video_url' => null,
                'sort_order' => 1,
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
        Schema::dropIfExists('lessons');
    }
};
