@extends('layouts.header')

@section('content')

    @include('layouts.message-box')

    <div class="main-contents">
        <nav class="material pc">
            <a href="/home"><p>最新記事</p></a><br>
            <a href="/home/weekly"><p>今週の人気記事</p></a><br>
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
                    @include('layouts.select-category')
                <br>
                <input class="btn-flat-logo" type="submit" value="検索">
            </form>
        </nav>
        <section>
            <div class="my-articles-area">
                <p class="white">{{ $home_type }}</p>
            </div>
            
            @if(count($article_data) == 0)
                <div class="article-list">
                    <p>{{ $home_type }}はありません</p>
                </div>
            @endif
            
            @include('layouts.article-list',['article_data' => $article_data])
            
            @if(!isset($page))
                <div class="pagination">
                    {{ $article_data->links() }}
                </div>
            @endif
        </section>
    </div>
@endsection