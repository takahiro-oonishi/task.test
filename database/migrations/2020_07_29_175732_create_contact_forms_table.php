<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_forms', function (Blueprint $table) {//Schema::createはテーブル（contact_forms）新規作成
            $table->bigIncrements('id');
            //氏名、メールアドレス、url、性別、年齢、お問い合わせ内容を追加
            $table->string('your_name', 20);
            $table->string('email', 255);
            $table->longText('url')->nullable($value = true);//urlは空の場合もあるため->nullable($value = true)を追記
            $table->boolean('gender');
            $table->tinyInteger('age');
            $table->string('contact', 200);
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
        Schema::dropIfExists('contact_forms');
    }
}
