@extends('layouts.article-list')

@section('content-top')
<div class="mypage-container">
    <div class="profile-area">
        <div class="user-name">
            <img src="/user-icons/{{ Auth::user()->icon }}" alt="">
            <p>{{ $data->name }}</p>
        </div>
        
        <div class="id-display">
            <p>User Id : {{ $data->user_code }}</p>
            @if(!$data->psid)
            <p>PSID : 未登録</p>
            @else
            <p>PSID : {{ $data->psid }}</p>
            @endif
        </div>
        
        @if($data->profile)
        <div class="mypage-profile">
            <p>{{ $data->profile }}</p>
        </div>
        @endif
        
        <div class="article-data">
            <p>投稿数 : xx</p>
            <p>Get <i class="material-icons">favorite</i> : xx</p>
        </div>
        
        <div class="to-setting">
            <a href="setting"><p>プロフィール設定</p></a>
        </div>
    </div>

    <section>
        <div class="my-articles-area">
            <p>あなたさんの投稿</p>
        </div>
@endsection

@section('content-bottom')
    </section>
</div>
@endsection