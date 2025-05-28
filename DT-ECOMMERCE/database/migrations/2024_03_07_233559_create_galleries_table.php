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
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->year('year');
            $table->string('make');
            $table->string('model');
            $table->string('drive')->nullable();
            $table->text('vehicle_details')->nullable();
            $table->string('rubbing')->nullable()->nullable();
            $table->string('trimming')->nullable()->nullable();
            $table->string('spacers')->nullable()->nullable();
            $table->string('front_wheel_spacers')->nullable();
            $table->string('rear_wheel_spacers')->nullable();
            $table->string('wheel_title')->nullable();
            $table->string('front_wheel')->nullable();
            $table->string('rear_wheel')->nullable();
            $table->string('offset_wheel')->nullable();
            $table->string('backspacing_wheel')->nullable();
            $table->string('tire_title')->nullable();
            $table->string('front_tire')->nullable();
            $table->string('rear_tire')->nullable();
            $table->string('brand_suspension')->nullable();
            $table->string('suspension')->nullable();
            $table->string('modification')->nullable();

            $table->string('wheel_diameter')->nullable();
            $table->string('wheel_width')->nullable();
            $table->string('tire_height')->nullable();
            $table->string('tire_width')->nullable();

            $table->string('type_of_stance')->nullable();

            $table->string('wheel_brand')->nullable();
            $table->string('wheel_model')->nullable();

            $table->string('tire_brand')->nullable();
            $table->string('tire_model')->nullable();
            
            $table->text('additional_information')->nullable();
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('image4')->nullable();
            $table->string('image5')->nullable();
            $table->string('image6')->nullable();
            $table->string('image7')->nullable();
            $table->string('image8')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
