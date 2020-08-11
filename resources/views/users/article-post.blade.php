@extends('layouts.header')

@section('content')

@error('title')
<p>{{ $message }}</p>
@enderror

@for($i=0 ; $i <= 100 ; $i++)
@error('post-'.$i)
<p>{{ $message }}</p>
@enderror
@endfor

@if(isset($info))
<p>{{ $info }}</p>
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
        </div>
    </div>

    <div class="text-contents" id="text-contents">
        <input class="title text" name="title" type="text" placeholder="記事タイトル" value="{{ old('title') }}">
    </div>
</form>
@endsection