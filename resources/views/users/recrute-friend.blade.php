@extends('layouts.header')

@section('content')

@if(isset($test))
<p>{{ $test }}</p><br>
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

@auth
<form class="friend-post-form" action="{{ url('/recrute-friend') }}" method="post">
    @csrf
    <div class="user-name">
        <img src="/user-icons/{{ Auth::user() -> icon }}" alt="">
        <p>{{ Auth::user() -> name }}</p>
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
@endauth

@foreach($recruiting_friend as $friend)
    <div class="friend-message-container">
        <div class="friend-message-head">
            <div class="user-name">
                <img src="user-icons/{{ $friend -> user -> icon }}" alt="">
                <p>{{ $friend -> user -> name }}</p>
            </div>
            <div class="friend-message-report">
                <p class="post-date">{{ date('m月d日 G時i分',strtotime($friend -> created_at)) }}</p>
                <p><i class="material-icons">more_horiz</i></p>
            </div>
        </div>
        <div class="friend-message-data">
            <p class="friend-message-purpose">{{ $friend -> purpose }}</p>
            
            @if(time() < $friend -> expiration_date)
            <p class="friend-message-psid">PSID : {{ $friend -> psid }}</p>
            @else
            <p class="friend-message-psid">PSID : 非表示</p>
            @endif
            
        </div>
        <p>{{ $friend -> friend_message}}</p>
    </div>
@endforeach

@endsection