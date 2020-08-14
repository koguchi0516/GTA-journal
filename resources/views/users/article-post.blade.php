@extends('layouts.header')

@section('content')

@error('title')
<p>{{ $message }}</p>
@enderror

@for($i=0 ; $i <= 100 ; $i++)
@error('post-'.$i)
<p>空の入力項目があります</p>
@enderror
@endfor

@if(Session::has('info'))
<p>{{ Session('info') }}</p>
@endif

<form class="article-post-form" action="/article-post" method="post" name="article-post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="add-container">
        <div class="add-article-parts">
            <div class="add-h3-tag-container" id="addH3" onclick="addText(this)">
                <p>見出し</p>
                <i class="material-icons">add_circle_outline</i>
            </div>
            <div class="add-p-tag-container" id="addP" onclick="addText(this)">
                <p>本文</p>
                <i class="material-icons">add_circle_outline</i>
            </div>
            <div class="add-img-tag-container" id="addImg" onclick="addText(this)">
                <p>画像</p>
                <i class="material-icons">add_circle_outline</i>
            </div>
        </div>

        <div class="add-category">
            <p>カテゴリ</p>
            <select class="search-window" name="category" id="">
                <option value="1">ストーリー</option>
                <option value="2">オンラインセッション</option>
                <option value="3">乗り物</option>
                <option value="4">洋服</option>
                <option value="5">不動産</option>
            </select>
            <input class="button" type="submit" value="投稿">
            <input class="button" type="submit" name='all-clear' value="クリア">
        </div>
    </div>

    <div class="text-contents" id="text-contents">
        <input class="title-text" name="title" type="text" placeholder="記事タイトル" value="{{ old('title') }}">
        
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
                            <i class="material-icons">remove_circle_outline</i>
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
                            <i class="material-icons">remove_circle_outline</i>
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
                            <i class="material-icons">remove_circle_outline</i>
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