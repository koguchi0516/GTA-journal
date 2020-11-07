@extends('layouts.header')

@section('content')

@include('layouts.message-box')

<div class="article-container material">
    <div class="message-head">
            <div class="user-name">
                <a class="user-data" href="{{ route('mypage.',['user_id' => $data['title_data'] -> user -> id]) }}">
                    <img src="{{ Storage::url($data['title_data'] -> user -> icon) }}" alt="icon">
                    <p>
                        # {{ $data['title_data'] -> user -> user_code }}
                    </p>
                </a>
            </div>
            
            <div class="report-area">
                <div class="message-report">
                    <p class="post-date">{{ date('m月d日 G時i分',strtotime($data['title_data'] -> updated_at)) }}</p>
                    <p onclick="reportIcon(this)">
                        <i class="material-icons">more_horiz</i>
                        <i class="flag">0</i>
                    </p>
                </div>
                <div class="report-button-area">
                    <p class="report-button" id="article-{{ $data['title_data']['id'] }}" onclick="openBtn(this)">報告</p>
                    @auth
                        @if($data['title_data'] -> user_id == Auth::user() -> id)
                            <a href="{{ route('edit_article_page.',['article_title_id' => $data['title_data'] -> id]) }}">
                                <p class="report-button">編集</p>
                            </a>
                            <p class="report-button" id="article-{{ $data['title_data']['id'] }}" onclick="checkOpenBtn(this)">削除</p>
                        @endif
                    @endauth                    
                </div>
            </div>
            
        </div>

    <h2 class="article-title">{{ $data['title_data'] -> title }}</h2>
    <div class="article-tag-container">
        <div class="article-tags">
            <a href="{{ route('category_tag.',['category_id' => $data['title_data']['category_id']]) }}">
                <p>{{ $data['title_data'] -> category -> category_name }}</p>
            </a>
        </div>
        @if(Auth::check())
            <a href="{{ route('favo_push.',['article_title_id' => $data['title_data']['id']]) }}" class="article-favorite">
                @if($data['favo_article'] == 0)
                <i class="material-icons article-heart">favorite_border</i>
                @else
                <i class="material-icons article-heart">favorite</i>
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
                <img src="{{ Storage::url($contents[$i]['img_content']) }}"></img>
            @endif
            @php $i++; @endphp
        @endforeach
    </div>
</div>

<div class="comment-icon">
    <i class="material-icons article-comment">forum</i>
    <p>コメント</p>
</div>

@if(!empty($data['comments']))
    @foreach($data['comments'] as $comment)
        <div class="comment-list-container material">
            <div class="message-head">
                <div class="user-name">
                    <a href="{{ route('mypage.',['user_id' => $comment -> user -> id]) }}">
                        <img src="{{ Storage::url($comment -> user -> icon) }}" alt="icon">
                    </a>
                    <p># {{ $comment -> user -> user_code }}</p>
                </div>
                <div class="report-area">
                    <div class="message-report">
                        <p class="post-date">{{ date('m月d日 G時i分',strtotime($comment -> updated_at)) }}</p>
                        <p onclick="reportIcon(this)">
                            <i class="material-icons">more_horiz</i>
                            <i class="flag">0</i>
                        </p>
                    </div>
                    <div class="report-button-area">
                        <p class="report-button" id="comment-{{ $comment -> id }}" onclick="openBtn(this)">報告</p>
                        @auth
                            @if($comment -> user_id == Auth::user() -> id)
                                <p class="report-button" id="comment-{{ $comment -> id }}" onclick="checkOpenBtn(this)">削除</p>
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
    <form method="post" action="{{ route('post_comment.',['article_title_id' => $data['title_data'] -> id]) }}" class="comment-post-form material">
        {{ csrf_field() }}
        <div class="user-name">
            <img src="{{ Storage::url(Auth::user() -> icon) }}" alt="icon">
            <p class="white">#{{ Auth::user() -> user_code }}</p>
        </div>
        <textarea name="comment-post"></textarea>
        <input type="submit" class="btn-flat-logo" value="コメント">
    </form>
@else
    <div class="unregister-comment-container material">
        <p>あなたもコメントしてみませんか？</p>
        <p><a href="/register">登録</a></p>
        <p><a href="/login">ログイン</a></p>
    </div>
@endauth

@include('layouts.modal',['article_title_id'=>$data['title_data']['id']])
@include('layouts.check-modal')

@endsection