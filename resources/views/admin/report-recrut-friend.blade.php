@extends('layouts.admin-header')

@section('content')

    @include('layouts.admin-report-user',['data' => $data])
    
    
    @if(Session::has('info-'.$data['report_id']))
        @include('layouts.admin-message-box',['report_id' => $data['report_id']])
    @else
        <div class="friend-message-container admin material">
            <div class="message-head">
                <div class="user-name">
                    <a href="/mypage/{{ $friend -> user -> id }}">
                        <img src="/storage/user-icons/{{ $friend -> user -> icon }}" alt="ユーザーアイコン">
                    </a>
                    <p>
                        <a href="/mypage/{{ $friend -> user -> id }}">{{ $friend -> user -> name }}</a>
                    </p>
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
                                <a href="/delete/friend/{{ $friend -> id }}"><p class="report-button">削除</p></a>
                    </div>
                </div>
            </div>
            
            <div class="friend-message-data">
                <p class="friend-message-purpose">{{ $friend -> purpose -> purpose_name  }}</p>
                    <p class="friend-message-psid">PSID : {{ $friend -> psid }}</p>
            </div>
            <p>{{ $friend -> friend_message}}</p>
        </div>
    @endif

@endsection