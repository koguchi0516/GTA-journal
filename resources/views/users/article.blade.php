@extends('layouts.header')

@section('content')
<div class="article-container">
    <div class="article-head">
        <div class="article-head-data">
            <div class="user-name">
                <img src="../img/default-icon.jpeg" alt="">
                <p>筋肉プレイヤー</p>
            </div>
            <p>2xxx/xx/xx 更新</p>
        </div>
        <i class="material-icons">more_horiz</i>
    </div>

    <h2 class="article-title">記事タイトル</h2>
    <div class="article-tag-container">
        <div class="article-tags">
            <p>ストーリー</p>
            <p>オンライン</p>
            <p>乗り物</p>
        </div>
        <div class="article-favorite">
            <i class="material-icons">favorite_border</i>
        </div>
    </div>

    <div class="article-text">
        <h3>見出しが入るよ</h3>
        <p>ここに本文が入ります。ここに本文が入ります。ここに本文が入ります。ここに本文が入ります。
            ここに本文が入ります。ここに本文が入ります。ここに本文が入ります。ここに本文が入ります。こ
            こに本文が入ります。ここに本文が入ります。ここに本文が入ります。ここに本文が入ります。ここ
            に本文が入ります。ここに本文が入ります。ここに本文が入ります。ここに本文が入ります。ここに
            本文が入ります。ここに本文が入ります。ここに本文が入ります。ここに本文が入ります。ここに本
            文が入ります。ここに本文が入ります。ここに本文が入ります。ここに本文が入ります。ここに本文
            が入ります。ここに本文が入ります。ここに本文が入ります。ここに本文が入ります。ここに本文が
            入ります。ここに本文が入ります。ここに本文が入ります。ここに本文が入ります。ここに本文が入
            ります。ここに本文が入ります。ここに本文が入ります。ここに本文が入ります。
        </p>
        <img src="../img/IMG_20191208_171352.jpg" alt="">
        <p>ここに本文が入ります。ここに本文が入ります。ここに本文が入ります。ここに本文が入ります。
            ここに本文が入ります。ここに本文が入ります。ここに本文が入ります。ここに本文が入ります。こ
            こに本文が入ります。ここに本文が入ります。ここに本文が入ります。ここに本文が入ります。ここ
            に本文が入ります。ここに本文が入ります。ここに本文が入ります。ここに本文が入ります。ここに
            本文が入ります。ここに本文が入ります。ここに本文が入ります。ここに本文が入ります。ここに本
            文が入ります。ここに本文が入ります。ここに本文が入ります。ここに本文が入ります。ここに本文
            が入ります。ここに本文が入ります。ここに本文が入ります。ここに本文が入ります。ここに本文が
            入ります。ここに本文が入ります。ここに本文が入ります。ここに本文が入ります。ここに本文が入
            ります。ここに本文が入ります。ここに本文が入ります。ここに本文が入ります。
        </p>
        <h3>見出しが入るよ</h3>
        <img src="../img/todd-diemer-uFomxGheuGk-unsplash.jpg" alt="">
        <img src="../img/tumblr_mzg4xl85Eb1qz5rxno5_1280.jpg" alt="">
    </div>
</div>

<div class="comment-list-container">
    <div class="comment-head">
        <div class="user-name">
            <img src="../img/default-icon.jpeg" alt="">
            <p>魔法戦士ボーイング</p>
        </div>
        <div class="commetn-report">
            <p>2xxx/xx/xx</p>
            <i class="material-icons">more_horiz</i>
        </div>
    </div>
    <div class="comment-text">
        <p>ここにコメントが入ります。ここにコメントが入ります。ここにコメントが入ります。ここにコメントが入ります。ここにコメントが入ります。ここにコメントが入ります。ここにコメントが入ります。ここにコメントが入ります。ここにコメントが入ります。ここにコメントが入ります。ここにコメントが入ります。
    </div>
</div>

<form method="post" action="" class="comment-post-form">
    <div class="user-name">
        <img src="../img/default-icon.jpeg" alt="">
        <p>あなたの名前
        </p>
    </div>
    <textarea name="comment-post"></textarea>
    <input type="submit" value="コメント">
</form>
<div class="unregister-comment-container">
    <p>あなたもコメントしてみませんか？</p>
    <p><a href="create.html">登録</a></p>
    <p><a href="login.html">ログイン</a></p>
</div>

@endsection