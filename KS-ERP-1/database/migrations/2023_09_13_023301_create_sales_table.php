<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            // $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->enum('payment_type', ['cash', 'card']);
            $table->string('transaction_id')->nullable(true);
            $table->decimal('discount_amount', 8, 2)->nullable(true);
            $table->decimal('discount_percent', 8, 2)->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
};
