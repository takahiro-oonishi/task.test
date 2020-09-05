<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('shop_name',20);
            $table->unsignedBigInteger('area_id');//ここに外部キーを設定//FK  areaのidが存在するものしか登録できなくする
            //areaと紐づけるための列//bigIncrements('id');と紐づけるためにはunsignedBigIntegerを使う
            $table->timestamps();

            $table->foreign('area_id')->references('id')->on('areas');
            //$table->foreign('外部キーをつけたい列')->references('相手先の列')->on('相手先のテーブル名');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops');
    }
}
