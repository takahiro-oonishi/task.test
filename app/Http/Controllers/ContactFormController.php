<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;// vender/laravel/framework/src内にある

use App\Models\ContactForm;//store保存で使用

use Illuminate\Support\Facades\DB;//名前空間のDBファザードをインストール

use App\Services\CheckFormData;//function show で切り離したものをインストール

use App\Http\Requests\StoreContactForm;//バリデーションのためのクラスをインストール

class ContactFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)//フォームのデータを持ってきて検索するために Request $request を追記
    {
        $search = $request->input('search');//検索したものを$searchに代入//input('search')のsearchは、formのname="search"のこと
        // dd($request);
        // dd($search);

        // 検索フォーム用
        $query = DB::table('contact_forms');

        //もしキーワードがあったら
        if($search !== null){//中身があれば
            // 全角スペースを半角に
            $search_split = mb_convert_kana($search,'s');//s で全角を半角に

            // 空白で区切る //preg_split関数を確認
            $search_split2 = preg_split('/[\s]+/',$search_split,-1,PREG_SPLIT_NO_EMPTY);

            //単語をループで回す
            foreach($search_split2 as $value){
                $query->where('your_name','like','%'.$value.'%');
            }
        }

        $query->select('id','your_name','title','created_at');
        $query->orderBy('id','asc');//順番の入れ替えで  orderBy関数を利用 //asc と desc で変更
        $contacts = $query->paginate(20);//取得件数を指定


        //エロクワント ORマッパー
        // $contacts = ContactForm::all();//データ全部持ってくる

        //クエリビルダ 
        //必要なデータのみ取得しやすい
        //DB::table('テーブル名')->select('列＝＝＝カラム名')->get();getでデータ取得
        // $contacts = DB::table('contact_forms')
        // ->select('id','your_name','title','created_at')
        // ->orderBy('id','asc')//順番の入れ替えで  orderBy関数を利用 //asc と desc で変更
        // ->paginate(20);//取得件数を指定
        // ->get();

        // dd($contacts);

        // return view('contact.index');//'contact.index'==='フォルダ名.ファイル名'

        //変数をviewに渡す際に、compact関数を使う
        //compact('変数名')//変数名の前に$マークはいらない
        return view('contact.index',compact('contacts'));//contacts===$contacts変数
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('contact.create');//'contact.create'==='フォルダ名.ファイル名'
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)//上記の use Illuminate\Http\Requestで Requestクラスを読み込んでいる//下記に変更
    public function store(StoreContactForm $request)//バリデーションをしたStoreContactFormクラスで読み込み
    {
        $contact = new ContactForm;//ContactFormクラスをインスタンス化

        $contact->your_name = $request->input('your_name');//your_nameの部分がテーブルのカラム部分となる
        $contact->title = $request->input('title');
        $contact->email = $request->input('email');
        $contact->url = $request->input('url');
        $contact->gender = $request->input('gender');
        $contact->age = $request->input('age');
        $contact->contact = $request->input('contact');

        $contact->save();//データベースへ保存

        return redirect('contact/index');

        //


        //一般的なｐｈｐでPOSTのデータを取るときは、スーパーグローバル変数 $_POST['name'];を使っていたが、
        //laravelでは、 Requestクラスを使ってデータを持ってくる
        //インスタンス化したRequestクラスのデータを持ってきている
        // $your_name = $request->input('your_name');
        // $title = $request->input('title');
        // $email = $request->input('email');
        // $url = $request->input('url');
        // $gender = $request->input('gender');
        // $age = $request->input('age');
        // $contact = $request->input('contact');
        // dd($your_name,$title);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //エロクエントでfindを利用
        $contact = ContactForm::find($id);

        //use App\Services\CheckFormData;のクラスメソッドを呼んで実行
        $gender = CheckFormData::checkGender($contact);//static functionで作っているため、スコープ演算子で使用可能
        $age = CheckFormData::checkAge($contact);

        //conpact関数は変数を複数渡せる
        return view('contact.show',compact('contact','gender','age'));//変数をviewへ渡す

        // $contact->gender; //数字の0、1が入っている
        // $contact->age;    //数字の1，2，3，4，5，6が入っている

        // コントローラ内が大きくなってしまうため、App\Services\CheckFormData;内に下記のgender age のif文 を分離

        // if($contact->gender === 0){
        //     $gender ='男性';
        // }
        // if($contact->gender === 1){
        //     $gender ='女性';
        // }

        // if($contact->age === 1){
        //     $age = '～19歳';
        // }
        // if($contact->age === 2){
        //     $age = '20歳～29歳';
        // }
        // if($contact->age === 3){
        //     $age = '30歳～39歳';
        // }
        // if($contact->age === 4){
        //     $age = '40歳～49歳';
        // }
        // if($contact->age === 5){
        //     $age = '50歳～59歳';
        // }
        // if($contact->age === 6){
        //     $age = '60歳～';
        // }

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $contact = ContactForm::find($id);

        return view('contact.edit',compact('contact'));//変数をviewへ渡す
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // $contact = new ContactForm;//id毎のデータの書きになるため、下記の書き方
        $contact = ContactForm::find($id);

        $contact->your_name = $request->input('your_name');//your_nameの部分がテーブルのカラム部分となる
        $contact->title = $request->input('title');
        $contact->email = $request->input('email');
        $contact->url = $request->input('url');
        $contact->gender = $request->input('gender');
        $contact->age = $request->input('age');
        $contact->contact = $request->input('contact');

        $contact->save();//データベースへ保存

        return redirect('contact/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $contact = ContactForm::find($id);
        $contact->delete();//データの削除

        return redirect('contact/index');
    }
}
