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
        Schema::create('maintenance_request_item_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('maintenance_request_item_id')->nullable();
            $table->string('file_path');
            $table->string('original_name')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_request_item_attachments');
    }
};
