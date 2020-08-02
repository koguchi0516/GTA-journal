@extends('layouts.header')

@section('content')

@yield('content-top')
    <div class="article-list">
        <a href="mypage">
            <img src="../img/default-icon.jpeg" alt="icon">
        </a>
        <div class="article-supplement">
            <h2>記事タイトル</h2>
            <div class="favorite-count">
                <p>20xx/xx/xx</p>
                <i class="material-icons">favorite</i>
                <p>x</p>
            </div>
        </div>
    </div>
@yield('content-bottom')

@endsection
