<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('maintenance_request_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('maintenance_request_id')->nullable();
            $table->text('remarks')->nullable();
            $table->enum('status', ['waiting', 'first contact', 'started', 'in progress', 'finished', 'unable to complete', 'quoted'])->default('waiting');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_request_items');
    }
};
