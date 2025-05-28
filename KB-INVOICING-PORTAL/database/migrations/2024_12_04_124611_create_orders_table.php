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
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // order_id
            $table->string('invoice_number')->nullable()->unique(); // Renewal invoice number
            $table->json('bank_information_ids')->nullable();
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->string('domain');
            $table->enum('payment_interval', ['mo', 'yr', 'payment']);
            $table->enum('payment_status', ['paid', 'unpaid', 'cancelled'])->default('unpaid');
            $table->text('notes')->nullable();
            $table->string('currency')->default('USD'); // Currency code
            $table->string('currency_symbol')->nullable(); // e.g. $, £, ₨

            $table->enum('payment_type', ['cash', 'stripe', 'bank_transfer'])->nullable();

            $table->enum('tax_type', ['percent', 'amount'])->nullable();
            $table->decimal('tax_value', 10, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
