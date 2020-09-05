<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Test;//modelsフォルダのTestファイルを引っ張ってくる//モデルのデータを持ってくる

//DB部分を変えることで、様々なファザードを使うことも可能
//Illuminate\Support\Facades\DB  は vendor/laravel/framework/Illuminate\Support\Facadesにファイルがある
use Illuminate\Support\Facades\DB;//名前空間のDBファザードをインストール

class TestController extends Controller
{
//Route::get('tests/test','TestController@index');//ルーティングの指定でindexメソッドを実行
    public function index(){
        
        $values = Test::all();//Test::all(allでテストに入っているデータをすべて取得);

        // $tests = DB::table('tests')->get();//DB::table(テーブル名)->
        $tests = DB::table('tests')->select('id')->get();//メソッドチェーンを用いてidのみの取得可
        // dd($tests);

        //コレクション型関数の例
        $collection = collect([1, 2, 3, 4, 5, 6, 7]);
        $chunks = $collection->chunk(4);
        $chunks->toArray();
        // [[1, 2, 3, 4], [5, 6, 7]]
        // dd($chunks);

        // dd($values);
        //dd===die+var_dumpをセットにしたコマンド
        //dd();は処理を止めて、変数の中身を表示してくれる
        //Illuminate\Database\Eloquent\Collection {#1342 ▶} と表示され、Collection型

        return view('tests.test',compact('values'));
          //viewフォルダのtestsフォルダのtestファイルに飛ぶ
          //$valuesという変数をviewに持っていくために、compact()関数を使う、複数の変数を渡すことも可
          //compact('values')  文字の変数を引数に渡す際は、シングルクォーテーションで囲む
    }
}



// コントローラー（処理）
//    php artisan make:controller TestController
// app/Http/Controllers/直下にファイルが作成される

