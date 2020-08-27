@extends('layouts.header')

@section('content')

<div class="message-box">
    <ul>
        @error('comment-post')
            <li>{{ $message }}</li>
        @enderror
        
        @if(Session::has('info'))
            <li>{{ Session('info') }}</li>
        @endif
    </ul>
</div>

<div class="article-container">
    <div class="message-head">
            <div class="user-name">
                <a href="/mypage/{{ $data['title_data'] -> user -> id }}">
                    <img src="/storage/user-icons/{{ $data['title_data'] -> user -> icon }}" alt="icon">
                </a>
                <p>{{ $data['title_data'] -> user -> name }}</p>
            </div>
            <div class="report-area">
                <div class="message-report">
                    <p class="post-date">{{ date('Y/n/j G:i',strtotime($data['title_data'] -> updated_at)) }}</p>
                    <p id="report-icon">
                        <i class="material-icons">more_horiz</i>
                    </p>
                </div>
                <div class="report-button-area">
                    <p class="report-button" id="article-{{ $data['title_data']['id'] }}" onclick="openBtn(this)">報告</p>
                    @auth
                        @if($data['title_data'] -> user_id == Auth::user() -> id)
                            <a href="/edit/{{ $data['title_data'] -> id }}">
                                <p class="report-button">編集</p>
                            </a>
                            <a href="/delete/article/{{ $data['title_data'] -> id }}">
                                <p class="report-button">削除</p>
                            </a>
                        @endif
                    @endauth                    
                </div>
            </div>
        </div>

    <h2 class="article-title">{{ $data['title_data'] -> title }}</h2>
    <div class="article-tag-container">
        <div class="article-tags">
            <a href="/home/category/{{ $data['title_data']['category_id'] }}">
                <p>{{ $data['title_data'] -> category -> category_name }}</p>
            </a>
        </div>
        @if(Auth::check())
            <a href="/favo/{{ $data['title_data']['id'] }}" class="article-favorite">
                @if($data['favo_article'] == 0)
                <i class="material-icons">favorite_border</i>
                @else
                <i class="material-icons">favorite</i>
                @endif
            </a>
        @endif
    </div>

    <div class="article-text">
        @php $i = 0; @endphp
        @foreach($content_types as $content_type)
            @if($content_type == 'h3_content')
                <h3>{{ $contents[$i]['h3_content'] }}</h3>
            @elseif($content_type == 'p_content')
                <p>{{ $contents[$i]['p_content'] }}</p>
            @else
                <img src="/storage/article-imgs/{{ $contents[$i]['img_content'] }}"></img>
            @endif
            @php $i++; @endphp
        @endforeach
    </div>
</div>

@if(!empty($data['comments']))
    @foreach($data['comments'] as $comment)
        <div class="comment-list-container">
            <div class="message-head">
                <div class="user-name">
                    <a href="/mypage/{{ $comment -> user -> id }}">
                        <img src="/storage/user-icons/{{ $comment -> user -> icon }}" alt="icon">
                    </a>
                    <p>{{ $comment -> user -> name }}</p>
                </div>
                <div class="report-area">
                    <div class="message-report">
                        <p class="post-date">{{ date('m月d日 G時i分',strtotime($comment -> updated_at)) }}</p>
                        <p id="report-icon">
                            <i class="material-icons">more_horiz</i>
                        </p>
                    </div>
                    <div class="report-button-area">
                        <p class="report-button" id="comment-{{ $comment -> id }}" onclick="openBtn(this)">報告</p>
                        @auth
                            @if($comment -> user_id == Auth::user() -> id)
                                <a href="/delete/comment/{{ $comment -> id }}">
                                    <p class="report-button">削除</p>
                                </a>
                            @endif
                        @endauth                    
                    </div>
                </div>
            </div>
            <div class="comment-text">
                <p>{{ $comment['comment_content'] }}</p>
            </div>
        </div>
    @endforeach
@endif

@auth
    <form method="post" action="/article/{{ $data['title_data'] -> id }}" class="comment-post-form">
        {{ csrf_field() }}
        <div class="user-name">
            <img src="/storage/user-icons/{{ Auth::user() -> icon }}" alt="icon">
            <p>{{ Auth::user() -> name }}</p>
        </div>
        <textarea name="comment-post"></textarea>
        <input type="submit" value="コメント">
    </form>
@else
    <div class="unregister-comment-container">
        <p>あなたもコメントしてみませんか？</p>
        <p><a href="/register">登録</a></p>
        <p><a href="/login">ログイン</a></p>
    </div>
@endauth

@include('layouts.modal',['article_title_id'=>$data['title_data']['id']])

@endsection