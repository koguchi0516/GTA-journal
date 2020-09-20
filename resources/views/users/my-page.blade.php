@extends('layouts.header')

@section('content')

    @include('layouts.message-box')

    <div class="mypage-container">
        <div class="profile-area material">
            <div class="user-name">
                <img src="/storage/user-icons/{{ $data['user_data'] -> icon }}" alt="">
                <p>{{ $data['user_data'] -> name }}</p>
            </div>
            
            <div class="id-display">
                <p>ユーザーID : {{ $data['user_data'] -> user_code }}</p>
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
                <p>Get <i class="material-icons mypage">favorite</i> : {{ $data['favo_total'] }}</p>
            </div>
        </div>

        <section>
            <div class="my-articles-area">
                <p class="white">{{ $data['user_data'] -> name }}の投稿</p>
            </div>
            
            @if(count($data['article_data']) == 0)
                <div class="article-list">
                    <p>投稿はありません</p>
                </div>
            @else
            @include('layouts.article-list',['article_data' => $data['article_data']])
            <div class="pagination">
                {{ $data['article_data']->links() }}
            </div>
            @endif
        </section>
        
    </div>
@endsection