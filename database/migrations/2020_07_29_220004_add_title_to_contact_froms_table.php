<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitleToContactFromsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact_forms', function (Blueprint $table) {//Schema::tableは既存のテーブル（contact_forms）の変更
            //
            // $table->string('title',50);//カラムの追加
            $table->string('title',50)->after('your_name');;//after('your_name')でyour_nameカラムの下にtitleカラムが追加される
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()//php artisan migrate:rollback で実行
    {
        Schema::table('contact_forms', function (Blueprint $table) {
            //
            $table->dropColumn('title');//dropColumn('title')でtitleカラムの削除//php artisan migrate:rollback で実行
        });
    }
}
