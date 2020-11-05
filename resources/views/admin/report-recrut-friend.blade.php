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
                        <img src="{{ Storage::url($friend -> user -> icon) }}" alt="ユーザーアイコン">
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
                        <p class="report-button" id="friend-{{ $friend -> id }}" onclick="checkOpenBtn(this)">削除</p>
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
    
    @include('layouts.check-modal')

@endsection