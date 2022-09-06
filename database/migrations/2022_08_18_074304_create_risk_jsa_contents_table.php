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
        Schema::create('risk_jsa_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sub_id')->nullable()->comment('次標id');
            $table->text('action')->nullable()->comment('操作動作');
            $table->text('description')->nullable()->comment('說明');
            $table->String('inaccurate')->nullable()->comment('動作不確實(跳過、部分完成、或反向動作)');
            $table->text('affect')->nullable()->comment('可能造成影響之情境描述');
            $table->String('protect_engineering')->nullable()->comment('工程控制');
            $table->String('protect_manage')->nullable()->comment('管理控制');
            $table->String('protect_personal')->nullable()->comment('個人防護具');
            $table->String('before_category', 30)->nullable()->comment('類別(安0、環1、營2、設3)');
            $table->String('before_s', 3)->nullable()->comment('控制前嚴重性(S)');
            $table->String('before_p', 3)->nullable()->comment('控制前事件機率(P)');
            $table->String('before_level', 3)->nullable()->comment('控制前風險等級');
            $table->text('reduce_risk')->nullable()->comment('風降低風險所採取之控制措施險等級');
            $table->String('after_s', 3)->nullable()->comment('控制後嚴重性(S)');
            $table->String('after_p', 3)->nullable()->comment('控制後事件機率(P)');
            $table->String('after_level', 3)->nullable()->comment('控制後風險等級');
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
        Schema::dropIfExists('risk_jsa_contents');
    }
};
