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
        Schema::create('expense_payables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expense_payable_head_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 8, 2)->nullable(false);
            $table->text('remarks')->nullable(false);
            $table->date('date')->nullable(false);
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
        Schema::dropIfExists('expense_payables');
    }
};
