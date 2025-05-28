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
        Schema::create('maintenance_requests', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('building_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->enum('urgency', ['low', 'medium', 'high'])->nullable();
            $table->text('description');
            $table->enum('status', ['waiting', 'first contact', 'started', 'in progress', 'finished', 'unable to complete', 'quoted'])->default('waiting');
            $table->enum('accounting_status', ['awaiting completion', 'awaiting report', 'invoice sent', 'invoice paid', 'quoted'])->default('awaiting completion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_requests');
    }
};
