
test

<!-- $values = Test::all();のデータを表示させる -->
@foreach($values as $value)<!-- Collection型を表示させる時は@foreach,@endforeachで囲む -->
{{$value->id}}<br>
{{$value->text}}<br>
@endforeach

<!-- 
表示までの流れ

ルーティング（routes/web.php）
  Route::get('tests/test','TestController@index');
  // tests/testにアクセスされたら、TestController@index(テストコントローラーのindexメソッド)に飛ぶ

コントローラー（Controllers/TestContoroller.php）
  use App\Models\Test;//modelsフォルダのTestファイルを引っ張ってくる//モデルのデータを持ってくる
  class TestController extends Controller
  {
  //Route::get('tests/test','TestController@index');//ルーティングの指定でindexメソッドを実行
      public function index(){
          $values = Test::all();//Test::all(allでテストに入っているデータをすべて取得);

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

ビュー（views/tests/test.blade.php）

 -->