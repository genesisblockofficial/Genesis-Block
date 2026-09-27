<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trade_setups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('indicator_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('symbol', 64);
            $table->string('market', 64)->nullable();
            $table->string('direction', 16);
            $table->string('entry_zone', 100)->nullable();
            $table->string('stop_loss', 100)->nullable();
            $table->string('target_zone', 255)->nullable();
            $table->longText('analysis')->nullable();
            $table->string('chart_image')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['is_active', 'published_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trade_setups');
    }
};
