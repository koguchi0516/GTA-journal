@extends('layouts.article-list')

@section('content-top')
<div class="main-contents">
    <nav>
        <a href="recrut-friend">フレンド募集</a>
        <div class="line"></div>
        <a href="#">最新記事</a><br>
        <a href="#">今種の人気記事</a><br>
        <a href="#">お気に入り</a>
        <div class="line"></div>
        <form action="#" method="post">
            <p>ユーザー検索</p>
            <input class="search-window" type="text" placeholder="ユーザーID"><br>
            <input class="button" type="submit" value="検索">
        </form>
        <form action="category" method="post">
            <p>カテゴリ検索</p>
            <select class="search-window" name="category" id="">
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
@endsection

@section('content-bottom')
    </section>
</div>
@endsection