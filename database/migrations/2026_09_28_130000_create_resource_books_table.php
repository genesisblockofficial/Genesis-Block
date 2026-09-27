<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resource_books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author')->nullable();
            $table->text('amazon_url');
            $table->string('cover_image')->nullable();
            $table->boolean('is_beginner')->default(false);
            $table->boolean('for_experienced_traders')->default(false);
            $table->boolean('is_self_help')->default(false);
            $table->unsignedTinyInteger('rating')->default(5);
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $books = [
            ['The 48 Laws of Power', true, true, true, 5],
            ['Time Wise: The Instant International Bestseller', false, true, true, 4],
            ['The Entrepreneur Mind', true, true, true, 5],
            ['How Successful People Win', true, true, true, 5],
            ['Positivity: Confidence, Resilience, Motivation', true, true, true, 5],
            ['The Art of War', true, true, true, 5],
            ['Focus on What Matters', true, true, true, 4],
            ['How to Stop Worrying and Start Living', true, true, true, 5],
            ['Get Smart!', true, false, true, 5],
            ['Attitude Is Everything', true, true, true, 4],
            ['The Power of Now', true, true, true, 5],
            ['Master Your Time, Master Your Life', true, true, true, 5],
            ['New Trader, Rich Trader - Steve Burns', true, true, false, 5],
            ['Trading in the Zone - Mark Douglas', false, true, false, 4],
            ['Trade Your Way to Financial Freedom', false, true, false, 4],
            ['Trading Habits - Steve Burns', true, true, false, 5],
            ['No Limits: Blow the Cap Off Your Capacity', true, true, true, 4],
            ['The Law of Success in Sixteen Lessons', true, true, true, 5],
            ['Super Trader - Van Tharp', false, true, false, 5],
            ['Lessons from the Greatest Stock Traders of All Time', true, false, false, 4],
            ['Unlimited Power - Tony Robbins', true, true, true, 5],
            ['Eat That Frog! - Brian Tracy', true, true, true, 5],
            ['High Probability Trading - Link Marcel', true, true, false, 5],
        ];

        $now = now();

        DB::table('resource_books')->insert(array_map(
            fn (array $book, int $index): array => [
                'title' => $book[0],
                'amazon_url' => 'https://www.amazon.in/s?k=' . urlencode($book[0]),
                'is_beginner' => $book[1],
                'for_experienced_traders' => $book[2],
                'is_self_help' => $book[3],
                'rating' => $book[4],
                'sort_order' => $index + 1,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            $books,
            array_keys($books),
        ));
    }

    public function down(): void
    {
        Schema::dropIfExists('resource_books');
    }
};
