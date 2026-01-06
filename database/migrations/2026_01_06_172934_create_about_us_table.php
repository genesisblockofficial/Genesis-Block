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
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->string('main_heading')->nullable();
            $table->text('sub_heading')->nullable();
            $table->boolean('_is_start_trading')->default(true);
            $table->boolean('_is_view_our_mission')->default(true);
            $table->integer('experience_year')->default(0);
            $table->integer('traders_count')->default(0);
            $table->integer('countries_count')->default(0);
            $table->integer('traders_volumn')->default(0);
            $table->text('mission')->nullable();
            $table->text('vission')->nullable();
            $table->string('core_value_title_1')->nullable();
            $table->text('core_value_description_1')->nullable();
            $table->string('core_value_title_2')->nullable();
            $table->text('core_value_description_2')->nullable();
            $table->string('core_value_title_3')->nullable();
            $table->text('core_value_description_3')->nullable();
            $table->string('core_value_title_4')->nullable();
            $table->text('core_value_description_4')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};
