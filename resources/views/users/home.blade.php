@extends('layouts.header')

@section('content')
    <div class="message-box">
        <ul>
            @error('user-data')
                <li>{{ $message }}</li>
            @enderror
            
            @if(Session::has('info'))
                <li>{{ Session('info') }}</li>
            @endif
        </ul>
    </div>

    <div class="main-contents">
        <nav>
            <a href="/recrut-friend">フレンド募集</a>
            <div class="line"></div>
            <a href="/home">最新記事</a><br>
            <a href="/home/weekly">今種の人気記事</a><br>
            <a href="/home/favo">お気に入り</a>
            <div class="line"></div>
            
            <form action="/home/user" method="post">
                {{ csrf_field() }}
                <p>ユーザー検索</p>
                <input class="search-window" type="text" name='user-data' placeholder="表示名・ユーザーID"><br>
                <input class="button" type="submit" value="検索">
            </form>
            
            <form action="/home/category" method="post">
                {{ csrf_field() }}
                <p>カテゴリ検索</p>
                <select class="search-window" name="category">
                    <option value="1">ストーリー</option>
                    <option value="2">オンライン</option>
                    <option value="3">乗り物</option>
                    <option value="4">洋服</option>
                    <option value="5">不動産</option>
                </select><br>
                <input class="button" type="submit" value="検索">
            </form>
        </nav>
        <section>
            @include('layouts.article-list',['article_data' => $article_data])
        </section>
    </div>
@endsection