@extends('layouts.header')

@section('content')
<div class="register-header">
        <div class="header-container">
            <h1>Service Names</h1>
            <div class="header-menu">
                <a href="article-post.html">投稿する</a>
                <img src="../img/default-icon.jpeg" alt="icon">
            </div>
        </div>
</div>

<form class="friend-post-form" action="" method="post">
    <div class="user-name">
        <img src="../img/default-icon.jpeg" alt="">
        <p>User naem</p>
    </div>
    <div class="friend-post-select">
        <div class="">
            <p>目的</p>
            <select name="purpose" id="">
                <option value="">フレンド募集</option>
                <option value="">協力</option>
                <option value="">対戦</option>
                <option value="">強盗</option>
                <option value="">カジノ</option>
            </select>
        </div>
        <div class="">
            <p>PSID</p>
            <input type="text" name="psid" placeholder="PSID">
        </div>
        <div class="">
            <p>PSID表示期間</p>
            <select name="expiration-date" id="">
                <option value="">表示しない</option>
                <option value="">24時間</option>
                <option value="" selected>3日間</option>
                <option value="">7日間</option>
                <option value="">30日間</option>
            </select>
        </div>
    </div>
    <textarea name="friend-message" id="" placeholder="メッセージ"></textarea>
    <input class="friend-post-button" type="submit" value="投稿">
</form>

<div class="friend-message-container">
    <div class="friend-message-head">
        <div class="user-name">
            <img src="../img/default-icon.jpeg" alt="">
            <p>User naem</p>
        </div>
        <div class="friend-message-report">
            <p class="post-date">2xxx/xx/xx</p>
            <p><i class="material-icons">more_horiz</i></p>
        </div>
    </div>
    <div class="friend-message-data">
        <p class="friend-message-purpose">協力</p>
        <p class="friend-message-psid">PSID : koguchi-0516</p>
    </div>
    <p>でなぜかnain.cssが以前の設定から反映されない
        →キャッシュが残っていたことが原因。
        ディベロッパーツールを開きリロード矢印↻で右クリック、
        ［キャッシュの消去とハード再読み込み］でキャッシュを削除で解決。</p>
</div>

<div class="friend-message-container">
    <div class="friend-message-head">
        <div class="user-name">
            <img src="../img/default-icon.jpeg" alt="">
            <p>ミラクルハゲの介</p>
        </div>
        <div class="friend-message-report">
            <p class="post-date">2xxx/xx/xx</p>
            <p><i class="material-icons">more_horiz</i></p>
        </div>
    </div>
    <div class="friend-message-data">
        <p class="friend-message-purpose">フレンド募集</p>
        <p class="friend-message-psid">PSID : xxqqiAippxx</p>
    </div>
    <p>SEOってどんな全体像なのかな？イメージできないSEOを学ぶ優先順位を教えて欲しい
        ツイッター運営に関して0から教えて欲しい
        『個』として生き抜くノウハウを知りたい
        やりたいことってどうやって見つかるの？
        だから上記のような悩みが解決できるように、ツイッターで発信したり、記事にして情報提供しています。</p>
</div>
@endsection