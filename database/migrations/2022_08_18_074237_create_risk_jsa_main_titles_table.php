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
        Schema::create('risk_jsa_main_titles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('device_id')->nullable()->comment('設備id');
            $table->String('main_title')->nullable()->comment('主標');
            $table->integer('sort_num')->nullable()->comment('順序');
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
        Schema::dropIfExists('risk_jsa_main_titles');
    }
};
