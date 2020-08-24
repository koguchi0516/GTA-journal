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
    <div class="article-head">
        <div class="article-head-data">
            <div class="user-name">
                <a href="/mypage/{{ $data['title_data'] -> user -> id }}">
                    <img src="/user-icons/{{ $data['title_data'] -> user -> icon }}" alt="icon">
                </a>
                <p>{{ $data['title_data'] -> user -> name }}</p>
            </div>
            <p>{{ date('Y/n/j G:i',strtotime($data['title_data'] -> updated_at)) }} 更新</p>
        </div>
        <i class="material-icons">more_horiz</i>
    </div>
        <div class="openBtn" id="article-{{ $data['title_data']['id'] }}" onclick="openBtn(this)">
                <p>報告する</p>
        </div>
        @auth
            @if($data['title_data'] -> user_id == Auth::user() -> id)
                <a class="openBtn" href="/edit/{{ $data['title_data'] -> id }}">
                    <p>編集</p>
                </a>
                <a class="openBtn" href="/delete/article/{{ $data['title_data'] -> id }}">
                    <p>削除</p>
                </a>
            @endif
        @endauth

    <h2 class="article-title">{{ $data['title_data'] -> title }}</h2>
    <div class="article-tag-container">
        <div class="article-tags">
            <p>{{ $data['title_data'] -> category -> category_name }}</p>
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
                <img src="/article-imgs/{{ $contents[$i]['img_content'] }}"></img>
            @endif
            @php $i++; @endphp
        @endforeach
    </div>
</div>

@if(!empty($data['comments']))
    @foreach($data['comments'] as $comment)
        <div class="comment-list-container">
            <div class="comment-head">
                <a href="/mypage/{{ $comment -> user -> id }}" class="user-name">
                    <img src="/user-icons/{{ $comment -> user -> icon }}" alt="icon">
                    <p>{{ $comment -> user -> name }}</p>
                </a>
                <div class="commetn-report">
                    <p>{{ date('m月d日 G時i分',strtotime($comment -> updated_at)) }}</p>
                    <i class="material-icons">more_horiz</i>
                </div>
            </div>
            <div class="openBtn" id="comment-{{ $comment -> id }}" onclick="openBtn(this)">
                <p>報告</p>
            </div>
            @auth
                @if($comment -> user_id == Auth::user() -> id)
                    <a class="openBtn" href="/delete/comment/{{ $comment -> id }}">
                        <p>削除</p>
                    </a>
                @endif
            @endauth
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
            <img src="/user-icons/{{ Auth::user() -> icon }}" alt="icon">
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