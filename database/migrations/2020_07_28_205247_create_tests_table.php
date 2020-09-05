<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("text",100);//カラムのtextカラムを作成
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
        Schema::dropIfExists('tests');
    }
}


// マイグレーション（Migration）
//     DBテーブルの履歴管理
// php artisan make:migration create_tests_table（detabese/migrations/直下にファイルが作られる）マイグレーション(テーブル)は複数形
//     →php artisan migrationで作成
//     php artisan migrate:fresh  または、 refresh

//     モデルは単数形マイグレーション(テーブル)は複数形
// Person->people

// laravelマニュアルのマイグレーションに色々なカラムタイプが記載されている
