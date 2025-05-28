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
        Schema::create('renewals', function (Blueprint $table) {
            $table->id(); // renewal_id
            $table->string('invoice_number')->nullable()->unique(); // Renewal invoice number
            $table->unsignedBigInteger('order_detail_id')->nullable(false);
            $table->boolean('is_renewed')->default(false);
            $table->decimal('renewal_price', 10, 2);
            $table->date('next_due_date');
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('renewals');
    }
};
