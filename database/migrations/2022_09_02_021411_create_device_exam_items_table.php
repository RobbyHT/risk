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
        Schema::create('device_exam_items', function (Blueprint $table) {
            $table->id();
            $table->integer('device_id');
            $table->foreign('device_id')->references('id')->on('devices')->onDelete('cascade');
            $table->string('exam_item');
            $table->enum('accept', ['validation', 'numeric'])->default('validation');
            $table->double('accept_min')->nullable();
            $table->double('accept_max')->nullable();
            $table->string('accept_unit')->nullable();
            $table->string('desc')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('device_exam_items');
    }
};
