<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trade_journals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->date('trade_date');
            $table->string('symbol', 32);
            $table->string('direction', 8);
            $table->string('setup');
            $table->decimal('entry_price', 18, 5)->nullable();
            $table->decimal('stop_loss', 18, 5)->nullable();
            $table->decimal('target_price', 18, 5)->nullable();
            $table->string('result', 16)->default('planned');
            $table->decimal('pnl', 12, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'trade_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trade_journals');
    }
};
