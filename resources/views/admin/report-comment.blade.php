@extends('layouts.admin-header')

@section('content')

    @include('layouts.admin-report-user',['data' => $data])
    
    @if(Session::has('info-'.$data['report_id']))
        @include('layouts.admin-message-box',['report_id' => $data['report_id']])
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
                        <p class="report-button" id="comment-{{ $data['comment']['id'] }}" onclick="checkOpenBtn(this)">削除</p>
                    </div>
                </div>
            </div>
            <div class="comment-text">
                <p>{{ $data['comment']['comment_content'] }}</p>
            </div>
            <div class="admin-comment-link">
                <p>
                    <a href="/article/{{ $data['report'] -> article_title_id }}">該当記事 : {{ $data['report'] -> articleTitleId -> title }}</a>
                </p>
            </div>
        </div>
    @endif
    
    @include('layouts.check-modal')

@endsection