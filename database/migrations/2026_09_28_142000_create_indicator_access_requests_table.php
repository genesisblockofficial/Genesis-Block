<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('indicator_access_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('indicator_id')->nullable()->constrained()->nullOnDelete();
            $table->string('indicator_name');
            $table->string('name')->nullable();
            $table->string('email');
            $table->text('message')->nullable();
            $table->string('status', 24)->default('new');
            $table->timestamp('notified_at')->nullable();
            $table->timestamps();

            $table->index(['status', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('indicator_access_requests');
    }
};
