@extends('layouts.header')

@section('content')
<form class="article-post-form" action="#" method="post" name="" enctype="multipart/form-data">
    <div class="add-container">
        <div class="add-article-parts">
            <div class="add-h3-tag-container">
                <p>見出し</p>
                <i class="material-icons">add_circle_outline</i>
            </div>
            <div class="add-p-tag-container">
                <p>本文</p>
                <i class="material-icons">add_circle_outline</i>
            </div>
            <div class="add-img-tag-container">
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

    <div class="text-contents">
        <input class="title text" name="title" type="text" placeholder="記事タイトル">
        <div class="h3-tag-container">
            <input class="h3-tag text" name="h3-tag" type="text" placeholder="見出し">
            <div class="delete-icon delete-h3-tag">
                <p><i class="material-icons">remove_circle_outline</i></p>
            </div>
        </div>
        <div class="p-tag-container">
            <textarea class="p-tag" name="p-tag" placeholder="本文"></textarea>
            <div class="delete-icon delete-p-tag">
                <p><i class="material-icons">remove_circle_outline</i></p>
            </div>
        </div>
        <div class="img-tag-container">
            <input type="file" name="img-tag">
            <div class="delete-icon delete-img-tag">
                <p><i class="material-icons">remove_circle_outline</i></p>
            </div>
        </div>
    </div>
</form>
@endsection