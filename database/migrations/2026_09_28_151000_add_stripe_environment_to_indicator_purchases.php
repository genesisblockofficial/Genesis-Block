<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('indicator_purchases', function (Blueprint $table) {
            $table->string('stripe_environment', 8)->default('test')->after('currency');
        });
    }

    public function down(): void
    {
        Schema::table('indicator_purchases', function (Blueprint $table) {
            $table->dropColumn('stripe_environment');
        });
    }
};
