@extends('layouts.header')

@section('content')
    <div class="main-contents">
        <nav class="material">
            <a href="/home"><p>最新記事</p></a><br>
            <a href="/home/weekly"><p>今種の人気記事</p></a><br>
            <a href="/home/favo"><p>お気に入り</p></a>
            <a href="/recrut-friend"><p>フレンド募集</p></a>
            
            <form action="/home/user" method="post">
                {{ csrf_field() }}
                <p>ユーザー検索</p>
                <input class="input" type="text" name='user-data' placeholder="表示名・ユーザーID"><br>
                <input class="btn-flat-logo" type="submit" value="検索">
            </form>
            
            <form action="/home/category" method="post">
                {{ csrf_field() }}
                <p>カテゴリ検索</p>
                <select class="input" name="category">
                    <option value="1">ストーリー</option>
                    <option value="2">オンライン</option>
                    <option value="3">乗り物</option>
                    <option value="4">洋服</option>
                    <option value="5">不動産</option>
                </select><br>
                <input class="btn-flat-logo" type="submit" value="検索">
            </form>
        </nav>
        <section>
            @include('layouts.article-list',['article_data' => $article_data])
        </section>
    </div>
@endsection