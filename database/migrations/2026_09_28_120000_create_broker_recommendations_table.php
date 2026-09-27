<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('broker_recommendations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('market', 32);
            $table->text('website_url');
            $table->string('logo')->nullable();
            $table->text('description')->nullable();
            $table->text('action_note')->nullable();
            $table->string('contact_email')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $now = now();

        DB::table('broker_recommendations')->insert([
            [
                'name' => 'Zerodha',
                'market' => 'stock',
                'website_url' => 'https://bit.ly/3gyhIWN',
                'description' => 'Open a stock-market Demat account with Zerodha.',
                'action_note' => 'After opening your account, send your account ID to this email address.',
                'contact_email' => 'demat@boomingbulls.com',
                'sort_order' => 1,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Upstox',
                'market' => 'stock',
                'website_url' => 'https://upstox.com/open-account/?f=LPQY',
                'description' => 'Open a stock-market Demat account with Upstox.',
                'action_note' => 'After opening your account, send your account ID to this email address.',
                'contact_email' => 'demat@boomingbulls.com',
                'sort_order' => 2,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Exness',
                'market' => 'forex',
                'website_url' => 'https://one.exnesstrack.com/a/senizhs8qo',
                'description' => 'Explore the Exness forex account options.',
                'action_note' => 'After opening your account, send your account ID to this email address.',
                'contact_email' => 'forex@boomingbulls.com',
                'sort_order' => 1,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('broker_recommendations');
    }
};
