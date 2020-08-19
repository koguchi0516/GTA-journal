@extends('layouts.header')

@section('content')

@error('comment-post')
<p>{{ $message }}</p>
@enderror

<div class="article-container">
    <div class="article-head">
        <div class="article-head-data">
            <div class="user-name">
                <img src="/user-icons/{{ $data['title_data'] -> user -> icon }}" alt="icon">
                <p>{{ $data['title_data'] -> user -> name }}</p>
            </div>
            <p>{{ date('m月d日 G時i分',strtotime($data['title_data'] -> updated_at)) }} 更新</p>
        </div>
        <i class="material-icons">more_horiz</i>
    </div>

    <h2 class="article-title">{{ $data['title_data'] -> title }}</h2>
    <div class="article-tag-container">
        <div class="article-tags">
            <p>{{ $data['title_data'] -> category -> category_name }}</p>
        </div>
        <a href="/favo/{{ $data['title_data']['id'] }}" class="article-favorite">
            <i class="material-icons">favorite_border</i>
        </a>
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
                <div class="user-name">
                    <img src="/user-icons/{{ $comment -> user -> icon }}" alt="icon">
                    <p>{{ $comment -> user -> name }}</p>
                </div>
                <div class="commetn-report">
                    <p>{{ date('m月d日 G時i分',strtotime($comment -> updated_at)) }}</p>
                    <i class="material-icons">more_horiz</i>
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
            <img src="/user-icons/{{ Auth::user() -> icon }}" alt="icon">
            <p>{{ Auth::user() -> name }}</p>
        </div>
        <textarea name="comment-post"></textarea>
        <input type="submit" value="コメント">
    </form>
@else
    <div class="unregister-comment-container">
        <p>あなたもコメントしてみませんか？</p>
        <p><a href="create.html">登録</a></p>
        <p><a href="login.html">ログイン</a></p>
    </div>
@endauth

@endsection