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
        Schema::create('custom_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->nullable()->unique(); // Renewal invoice number
            $table->string('c_name');
            $table->string('c_email')->nullable();
            $table->string('c_phone')->nullable();
            $table->text('c_address')->nullable();
            $table->string('company_name');
            $table->text('notes')->nullable();
            $table->json('bank_information_ids')->nullable();
            $table->enum('payment_status', ['paid', 'unpaid', 'cancelled'])->default('unpaid');
            $table->json('meta_data')->nullable(); // Order details (JSON)
            $table->string('logo_image')->nullable(); // Logo image path
            $table->string('currency')->default('USD'); // Currency code
            $table->string('currency_symbol')->nullable(); // e.g. $, £, ₨

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_invoices');
    }
};
