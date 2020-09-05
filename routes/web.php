<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {  // URLの末尾 '/'にアクセスが来たら
    return view('welcome');    // viewファイル（resouces/views/welcom.blade.php）にアクセスさせる
});

Route::get('tests/test','TestController@index');
// tests/testにアクセスされたら、TestController@index(テストコントローラーのindexメソッド)に飛ぶ

Route::get('shops/index','ShopController@index');

// Route::get('contact/index','ContactFormController@index');
// URLがcontact/indexにアクセスされたら、ContactFormController@index(ContactFormControllerのindexメソッド)に飛ぶ

//グループ化
// ['prefix'=>'contact', 'middleware'=>'auth']はよく使う
// 'prefix'=>'contact(フォルダ)'//prefixでフォルダを指定
// 'middleware'=>'auth'で認証されていたら、表示させる
Route::group(['prefix'=>'contact', 'middleware'=>'auth'],function(){
    // Route::get('index','ContactFormController@index');//indexはcontactフォルダのindexファイルを示す
    //'ContactFormController@index'のルーティングに名前(->name(名前))をつけることが可能
    Route::get('index','ContactFormController@index')->name('contact.index');//名前は（フォルダ名.ファイル名）が良い
    Route::get('create','ContactFormController@create')->name('contact.create');
    Route::post('store','ContactFormController@store')->name('contact.store');//storeはpost通信
    Route::get('show/{id}','ContactFormController@show')->name('contact.show');//'show/{id}'でidによって、それぞれの詳細ページを表示
    Route::get('edit/{id}','ContactFormController@edit')->name('contact.edit');//'edit/{id}'でidによって、それぞれの編集ページを表示
    Route::post('update/{id}','ContactFormController@update')->name('contact.update');//保存のため、postになる
    Route::post('destroy/{id}','ContactFormController@destroy')->name('contact.destroy');//formで使う場合は、getかpostで書く
});

// Route::resource('contacts','ContactFormController')->only([
//     'index','show'//only(['index','show'])で２つのみルートの作成
// ]);
//REST
Route::resource('contacts','ContactFormController');

Auth::routes();//php artisan ui bootstrap --auth によって作成

Route::get('/home', 'HomeController@index')->name('home');
