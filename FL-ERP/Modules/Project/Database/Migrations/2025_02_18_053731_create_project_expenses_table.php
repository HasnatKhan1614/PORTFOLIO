<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('project_expenses')) {
            Schema::create('project_expenses', function (Blueprint $table) {
                $table->id();
                $table->unsignedInteger('pjt_project_id')
                    ->nullable();
                $table->integer('business_id')->index();
                $table->string('name');
                $table->decimal('amount', 10, 2);
                $table->text('remarks')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_expenses');
    }
};
