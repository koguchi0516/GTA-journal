@extends('layouts.admin-header')

@section('content')

    <p class="admin-title">報告者</p>
    
    <div class="report-container material">
        <a href="/mypage/{{ $data['report']['user_id'] }}" class="report-user-data">
            <img src="/storage/user-icons/{{ $data['report'] -> user -> icon }}"></img>
            <p>{{ $data['report'] -> user -> name }}</p>
        </a>
        <div class="report-list-data">
            <p>このユーザーからの報告数 : {{ $data['report_count'] }}件</p>
        </div>
    </div>
    
    @if(Session::has('info-'.$data['report_id']))
        @include('layouts.message-box',['report_id' => $data['report_id']])
    @else
        <div class="comment-list-container admin material">
            <div class="message-head">
                <div class="user-name">
                    <a href="/mypage/{{ $data['comment'] -> user -> id }}">
                        <img src="/storage/user-icons/{{ $data['comment'] -> user -> icon }}" alt="icon">
                    </a>
                    <p>{{ $data['comment'] -> user -> name }}</p>
                </div>
                <div class="report-area">
                    <div class="message-report">
                        <p class="post-date">{{ date('m月d日 G時i分',strtotime($data['comment'] -> updated_at)) }}</p>
                        <p onclick="reportIcon(this)">
                            <i class="material-icons">more_horiz</i>
                            <i class="flag">0</i>
                        </p>
                    </div>
                    <div class="report-button-area">
                        <a href="/delete/comment/{{ $data['comment'] -> id }}">
                            <p class="report-button">削除</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="comment-text">
                <p>{{ $data['comment']['comment_content'] }}</p>
            </div>
            <div class="admin-comment-link">
                <p><a href="/article/{{ $data['report'] -> target_id }}">該当記事 : {{ $data['report'] -> articleTitle -> title}}</a></p>
            </div>
        </div>
    @endif

@endsection