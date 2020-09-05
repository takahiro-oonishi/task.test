<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRouteShopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_shop', function (Blueprint $table) {
            $table->unsignedBigInteger('route_id');//紐づける相手先
            $table->unsignedBigInteger('shop_id');//紐づける相手先
            $table->primary(['route_id','shop_id']);//2つ合わせて、プライマリーキー（PK）を設定
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('route_shop');
    }
}
