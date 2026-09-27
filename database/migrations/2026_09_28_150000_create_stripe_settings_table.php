<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stripe_settings', function (Blueprint $table) {
            $table->id();
            $table->string('active_environment', 8)->default('test');
            $table->string('test_publishable_key')->nullable();
            $table->text('test_secret_key')->nullable();
            $table->text('test_webhook_secret')->nullable();
            $table->string('live_publishable_key')->nullable();
            $table->text('live_secret_key')->nullable();
            $table->text('live_webhook_secret')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stripe_settings');
    }
};
