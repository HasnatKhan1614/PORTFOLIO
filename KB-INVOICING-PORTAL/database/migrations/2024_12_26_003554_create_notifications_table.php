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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id(); // notification_id
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->string('invoice_number')->nullable();
            $table->string('type'); // e.g., 'renewal_reminder', 'invoice', etc.
            $table->enum('channel', ['email', 'sms', 'push']); // Communication medium
            $table->timestamp('sent_at')->nullable(); // When the notification was sent
            $table->boolean('is_successful')->default(true); // Whether the notification was successfully delivered
            $table->text('response_details')->nullable(); // To store delivery response or error details
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
