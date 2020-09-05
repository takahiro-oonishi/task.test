


@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    showです
                    <!-- 
                    $contact = ContactForm::find($id);
                    return view('contact.show',compact('contact','gender','age'));//変数をviewへ渡す
                    上記を表示 
                    -->
                    {{$contact->your_name}}
                    {{$contact->title}}
                    {{$contact->email}}
                    {{$contact->url}}
                    {{$gender}}
                    {{$age}}
                    {{$age}}
                    {{$contact->contact}}


                    <form method="GET" action="{{ route('contact.edit', ['id' => $contact->id ]) }}">
                        @csrf
                        <input class="btn btn-info" type="submit" value="変更する">
                    </form>

                    <form method="POST" action="{{ route('contact.destroy', ['id' => $contact->id ]) }}" id="delete_{{ $contact->id }}">
                    <!-- id="delete_{{ $contact->id }} //JavaScriptを使うために、idを指定する必要がある -->
                        @csrf
                        <a href="#" class ="btn btn-danger" data-id="{{$contact->id}}" onclick="deletePost(this);">削除する</a>
                        <!-- href="#"===中身はない,  onclick="deletePost(this);"===クリックされたらjavascriptのdeletePost関数を実行 -->
                    </form>

                    
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // 削除ボタンを押してすぐにレコードが削除されるのも問題なので、
    // 一旦javascriptで確認メッセージを流す 
    function deletePost(e){
        'use strict';
        if(confirm('本当に削除してもいいですか？')){
            document.getElementById('delete_' + e.dataset.id).submit();
        }
    }
</script>


@endsection