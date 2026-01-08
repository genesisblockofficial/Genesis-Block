<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('folder_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('folder_id')
                ->constrained('folders')
                ->onDelete('cascade');
            $table->string('image_path');
            $table->boolean('status')->default(true);
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('folder_images');
    }
};
