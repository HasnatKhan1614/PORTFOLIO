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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id(); // order_detail_id
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('server_id')->nullable(true); // Optional
            $table->boolean('is_free')->default(false);
            $table->decimal('price', 10, 2);
            $table->integer('quantity')->default(1);
            $table->boolean('time_interval')->default(false);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('extra_days')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
