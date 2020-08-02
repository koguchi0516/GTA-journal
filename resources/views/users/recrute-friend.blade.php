@extends('layouts.header')

@section('content')

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

<span hidden>{{ $i = 1 }}</span>
@foreach($recruiting_friend as $friend)
<span hidden id="target-content-keyId-{{ $i }}">{{ $friend -> id }}</span>
    <div class="friend-message-container">
        <div class="friend-message-head">
            <div class="user-name">
                <img src="user-icons/{{ $friend -> user -> icon }}" alt="ユーザーアイコン">
                <p>{{ $friend -> user -> name }}</p>
            </div>

            <div class="report-area">
                <div class="friend-message-report">
                    <p class="post-date">{{ date('m月d日 G時i分',strtotime($friend -> created_at)) }}</p>
                    <p id="report-icon">
                        <i class="material-icons">more_horiz</i>
                    </p>
                </div>
                <div class="openBtn" id="keyId-{{ $i }}" onclick="openBtn(this)">
                    <p>報告する</p>
                </div>
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
    <span hidden>{{ $i++ }}</span>
@endforeach

<div id="modal" class="modal">
    <form action="#" method="post" class="modal-content">
        <div class="modal-content-header">
            <h3>報告内容を選択</h3>
            <i class="material-icons" id="closeBtn">clear</i>
        </div>
        <div class="radio-contain">
            <label class="check_lb">
                <input type="radio" name="report-content" value="法令違反">法令違反（著作権侵害、プライバシー侵害、名誉棄損等）
            </label>
            <label class="check_lb">
                <input type="radio" name="report-content" value="社会的に不適切">社会的に不適切（公的風俗に反する）
            </label>
            <label class="check_lb">
                <input type="radio" name="report-content" value="宣伝行為">宣伝行為
            </label>
            <label class="check_lb">
                <input type="radio" name="report-content" value="スパムの疑い">スパムの疑い
            </label>
            <label class="check_lb">
                <input type="radio" name="report-content" value="その他">それ以外でGTA journalにふさわしくない（ガイドライン違反）
            </label>
        </div>
        <input type="hidden" name="repoeter_id" value="{{ Auth::user() -> user_code }}">
        <input type="hidden" name="target_content_id" id="target_content_id" value="">
        <input type="submit" value="送信">
    </form>
</div>

@endsection