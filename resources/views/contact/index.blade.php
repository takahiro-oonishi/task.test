indexです


@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- create.blade.php への遷移  -->
                    <!-- <a href="{{ route('contact.create') }}">新規登録</a> -->
                    <!-- bootstpap を使ったボタン -->
                    <form method="get" action="{{ route('contact.create') }}" >
                        <button type="submit" class="btn btn-primary">新規登録</button>
                    </form>

                    <!-- サーチボックスの設置 -->
                    <form method="GET" action="{{route('contact.index')}}" class="form-inline my-2 my-lg-0"><!-- formでデータを取得したいので、action="{{route('contact.index')}}"でコントローラのfunction indexに処理を追記 -->
                        <input class="form-control mr-sm-2" name="search" type="search" placeholder="検索" aria-label="Search"><!-- データを持ってくるのにname属性は必須 -->
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">検索する</button>
                    </form>

                    <!--$contacts = DB::table('contact_forms')->select('id','your_name')->get();
                        return view('contact.index',compact('contacts'));
                        コントローラーでfunction.indexで書いた$contats変数のデータの表示
                    -->
                    <!-- @foreach($contacts as $contact)
                    {{ $contact->id }}
                    {{ $contact->your_name }}
                    {{ $contact->title }}
                    {{ $contact->created_at }}
                    @endforeach -->

                    <!-- bootstrapのテーブルを利用した場合 -->
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">id</th>
                            <th scope="col">氏名</th>
                            <th scope="col">件名</th>
                            <th scope="col">登録日時</th>
                            <th scope="col">詳細</th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach($contacts as $contact)
                            <tr>
                            <th>{{ $contact->id }}</th>
                            <td>{{ $contact->your_name }}</td>
                            <td>{{ $contact->title }}</td>
                            <td>{{ $contact->created_at }}</td>
                            <td><a href="{{route('contact.show',['id' => $contact->id] )}}">詳細を見る</a></td>
                            <!-- "{{route('contact.show',['id' => $contact->id] )}}"  名前付きルート -->
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <!-- ページネーションの結果を表示 -->
                    {{ $contacts->links() }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection