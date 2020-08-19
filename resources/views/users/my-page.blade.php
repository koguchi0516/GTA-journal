@extends('layouts.header')

@section('content')
    <div class="mypage-container">
        <div class="profile-area">
            <div class="user-name">
                <img src="/user-icons/{{ $data['user_data'] -> icon }}" alt="">
                <p>{{ $data['user_data'] -> name }}</p>
            </div>
            
            <div class="id-display">
                <p>User Id : {{ $data['user_data'] -> user_code }}</p>
                @if(!$data['user_data'] -> psid)
                <p>PSID : 未登録</p>
                @else
                <p>PSID : {{ $data['user_data'] -> psid }}</p>
                @endif
            </div>
            
            @if($data['user_data'] -> profile)
            <div class="mypage-profile">
                <p>{{ $data['user_data'] -> profile }}</p>
            </div>
            @endif
            
            <div class="article-data">
                <p>投稿数 : {{ count($data['article_data']) }}</p>
                <p>Get <i class="material-icons">favorite</i> : {{ $data['favo_total'] }}</p>
            </div>
            
            <div class="to-setting">
                <a href="setting"><p>プロフィール設定</p></a>
            </div>
        </div>

        <section>
            <div class="my-articles-area">
                <p>{{ $data['user_data'] -> name }}の投稿</p>
            </div>
            
        @if($data['article_data'] == Null)
            <div class="article-list">
            <p>投稿はありません</p>
            </div>
        @else
            @foreach($data['article_data'] as $val)
            <a href="/article/{{ $val['id'] }}" class="link-btn">
                <div class="article-list">
                    <img src="/user-icons/{{ $data['user_data'] -> icon }}" alt="icon">
                    <div class="article-supplement">
                        <h2>{{ $val['title'] }}</h2>
                        <div class="favorite-count">
                            <p>{{ date('m月d日 G時i分',strtotime($val['updated_at'])) }}</p>
                            <i class="material-icons">favorite</i>
                            <p>favoCount</p>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        @endif
        </section>
        
    </div>
@endsection