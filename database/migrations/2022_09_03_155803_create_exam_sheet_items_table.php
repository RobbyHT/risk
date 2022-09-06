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
        Schema::create('exam_sheet_items', function (Blueprint $table) {
            $table->id();
            $table->integer('sheet_id');
            $table->foreign('sheet_id')->references('id')->on('exam_sheets')->onDelete('cascade');
            $table->integer('item_id');
            $table->foreign('item_id')->references('id')->on('device_exam_items')->onDelete('cascade');
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
        Schema::dropIfExists('exam_sheet_items');
    }
};
