@extends('layouts.header')

@section('content')

@include('layouts.message-box')

@auth
    <form class="friend-post-form material" action="{{ url('/recrut-friend') }}" method="post">
        {{ csrf_field() }}
        <div class="user-name">
            <img src="/storage/user-icons/{{ Auth::user() -> icon }}" alt="">
            <p class="white">{{ Auth::user() -> name }}</p>
        </div>
        <div class="friend-post-select">
            <div class="">
                <p>目的</p>
                <select name="purpose" class="input">
                    <option value="1">フレンド募集</option>
                    <option value="2">協力</option>
                    <option value="3">対戦</option>
                    <option value="4">強盗</option>
                    <option value="5">カジノ</option>
                </select>
            </div>
            <div>
                <p>PSID</p>
                <input type="text" name="psid" class="input" placeholder="PSID" value="{{ Auth::user() -> psid }}">
            </div>
            <div>
                <p>PSID表示期間</p>
                <select name="expiration-date" class="input">
                    <option value="0">表示しない</option>
                    <option value="86400">24時間</option>
                    <option value="259200" selected>3日間</option>
                    <option value="604800">7日間</option>
                    <option value="2592000">30日間</option>
                </select>
            </div>
        </div>
        <textarea name="friend-message" placeholder="メッセージ">{{ old('friend-message') }}</textarea>
        <input class="btn-flat-logo friend" type="submit" value="投稿">
    </form>
@else
    <div class="unregister-comment-container">
        <p>あなたも仲間を募集してみませんか？</p>
        <p><a href="/register">登録</a></p>
        <p><a href="/login">ログイン</a></p>
    </div>
@endauth

@php $i = 0; @endphp
@foreach($recruiting_friend as $friend)
    <span hidden id="target-content-keyId-{{ $i }}">{{ $friend -> id }}</span>
    
    <div class="friend-message-container material">
        <div class="message-head">
            <div class="user-name">
                <a href="/mypage/{{ $friend -> user -> id }}">
                    <img src="/storage/user-icons/{{ $friend -> user -> icon }}" alt="ユーザーアイコン">
                </a>
                <p>{{ $friend -> user -> name }}</p>
            </div>
            <div class="report-area">
                <div class="message-report">
                    <p class="post-date">{{ date('m月d日 G時i分',strtotime($friend -> created_at)) }}</p>
                    <p onclick="reportIcon(this)">
                        <i class="material-icons">more_horiz</i>
                        <i class="flag">0</i>
                    </p>
                </div>
                <div class="report-button-area">
                    <p class="report-button" id="friend-{{ $friend -> id }}" onclick="openBtn(this)">報告</p>
                    @auth
                        @if($friend -> user -> id == Auth::user() -> id)
                            <a href="/delete/friend/{{ $friend -> id }}"><p class="report-button">削除</p></a>
                        @endif
                    @endauth 
                </div>
            </div>
        </div>
        
        <div class="friend-message-data">
            <p class="friend-message-purpose">{{ $friend -> purpose -> purpose_name  }}</p>
            @if(time() < $friend -> expiration_date)
                <p class="friend-message-psid">PSID : {{ $friend -> psid }}</p>
            @else
                <p class="friend-message-psid">PSID : 非表示</p>
            @endif
        </div>
        <p>{{ $friend -> friend_message}}</p>
    </div>
    @php $i++; @endphp
@endforeach

@include('layouts.modal',['article_title_id'=>'friend_report'])

@endsection