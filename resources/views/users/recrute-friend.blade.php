@extends('layouts.header')

@section('content')

@if(isset($hoge))
<P>{{ $hoge }}</p>
@endif

@error('psid')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong><br>
    </span>
@enderror

@error('friend-message')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror

<form class="friend-post-form" action="{{ url('/recrute-friend') }}" method="post">
    @csrf
    <div class="user-name">
        <img src="/user-icons/{{ Auth::user() -> icon }}" alt="">
        <p>User naem</p>
    </div>
    <div class="friend-post-select">
        <div class="">
            <p>目的</p>
            <select name="purpose" id="">
                <option value="フレンド募集">フレンド募集</option>
                <option value="協力">協力</option>
                <option value="対戦">対戦</option>
                <option value="強盗">強盗</option>
                <option value="カジノ">カジノ</option>
            </select>
        </div>
        <div class="">
            <p>PSID</p>
            <input type="text" name="psid" placeholder="PSID" value="{{ Auth::user() -> psid }}">
        </div>
        <div class="">
            <p>PSID表示期間</p>
            <select name="expiration-date" id="">
                <option value="0">表示しない</option>
                <option value="86400">24時間</option>
                <option value="259200" selected>3日間</option>
                <option value="604800">7日間</option>
                <option value="2592000">30日間</option>
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

@endsection