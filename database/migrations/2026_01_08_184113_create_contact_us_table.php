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
        Schema::create('contact_us', function (Blueprint $table) {
            $table->id();
            // Customer Support Inquiries
            $table->string('customer_support_title')->nullable();
            $table->text('customer_support_description')->nullable();
            $table->string('customer_support_email')->nullable();
            $table->string('customer_support_phone')->nullable();
            $table->string('customer_support_hours')->nullable();
            // Sales And Partnerships
            $table->string('sales_partnerships_title')->nullable();
            $table->text('sales_partnerships_description')->nullable();
            $table->string('sales_partnerships_email')->nullable();
            $table->string('sales_partnerships_phone')->nullable();
            $table->string('sales_partnerships_hours')->nullable();
            // Education and Training Support
            $table->string('education_training_title')->nullable();
            $table->text('education_training_description')->nullable();
            $table->string('education_training_email')->nullable();
            $table->string('education_training_phone')->nullable();
            $table->string('education_training_hours')->nullable();

            // General Fields
            $table->string('company_name')->nullable();
            $table->string('address')->nullable();
            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_us');
    }
};
