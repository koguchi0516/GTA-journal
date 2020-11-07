@extends('layouts.header')

@section('content')

    @include('layouts.message-box')
    
    <form class="article-post-form" action="{{ route('article_post') }}" method="post" name="article-post" enctype="multipart/form-data">
        {{ csrf_field() }}
        
        @include('layouts.article-console',['display'=>'投稿','aim'=>'all-clear','message'=>'クリア'])
    
        <div class="text-contents material" id="text-contents">
            @if(Session::has('title'))
                <input class="title-text" name="title" type="text" placeholder="記事タイトル" value="{{ Session('title') }}">
            @else
                <input class="title-text" name="title" type="text" placeholder="記事タイトル" value="{{ old('title') }}">
            @endif
            
            @if(Session::has('post_num'))
                @php $i = 0; @endphp
                @foreach(Session('post_num') as $num)
                    @if(Session('post_type')[$i] == 'h3')
                    <div class="h3-tag-container" id="post-item-{{ Session('post_num')[$i] }}">
                        <input class="h3-tag text" type="text" placeholder="見出し" name="post-{{ Session('post_num')[$i] }}" value="{{ old('post-'.Session('post_num')[$i]) }}">
                        <input type="hidden" name="type[]" value="h3">
                        <input type="hidden" name="post-num[]" value="{{ Session('post_num')[$i] }}">
                        <div class="delete-icon delete-img-tag" id="delete-item-{{ Session('post_num')[$i] }}" onclick="postDelete(this)">
                            <p>
                                <i class="material-icons">close</i>
                            </p>
                        </div>
                    </div>
                    @elseif(Session('post_type')[$i] == 'p')
                    <div class="h3-tag-container" id="post-item-{{ Session('post_num')[$i] }}">
                        <textarea class="p-tag" name="post-{{ Session('post_num')[$i] }}" placeholder="本文">{{ old('post-'.Session('post_num')[$i]) }}</textarea>
                        <input type="hidden" name="type[]" value="p">
                        <input type="hidden" name="post-num[]" value="{{ Session('post_num')[$i] }}">
                        <div class="delete-icon delete-img-tag" id="delete-item-{{ Session('post_num')[$i] }}" onclick="postDelete(this)">
                            <p>
                                <i class="material-icons">close</i>
                            </p>
                        </div>
                    </div>
                    @else
                    <div class="h3-tag-container" id="post-item-{{ Session('post_num')[$i] }}">
                        <input type="file" class="post-img" name="post-{{ Session('post_num')[$i] }}" value="{{ old('post-'.Session('post_num')[$i]) }}">
                        <input type="hidden" name="type[]" value="img">
                        <input type="hidden" name="post-num[]" value="{{ Session('post_num')[$i] }}">
                        <div class="delete-icon delete-img-tag" id="delete-item-{{ Session('post_num')[$i] }}" onclick="postDelete(this)">
                            <p>
                                <i class="material-icons">close</i>
                            </p>
                        </div>
                    </div>
                    @endif
                @php $i++; @endphp
                @endforeach
            @endif
            
            @if(!Session::has('last_post_num'))
            <input type="hidden" name="last-post-num" id="last-post-num" value="">
            @else
            <input type="hidden" name="last-post-num" id="last-post-num" value="{{ Session('last_post_num') }}">
            @endif
        </div>
    </form>
@endsection