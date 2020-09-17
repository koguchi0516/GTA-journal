@extends('layouts.header')

@section('content')

    @include('layouts.message-box')

    <div class="mypage-container">
        <div class="profile-area material">
            @if($suspend_check)
                <div>
                    <p>凍結中</p>
                </div>
            @endif
            <div class="user-name">
                <img src="/storage/user-icons/{{ $data['user_data'] -> icon }}" alt="">
                <p>{{ $data['user_data'] -> name }}</p>
                
                <div class="report-area">
                    <div class="message-report">
                        <p onclick="reportIcon(this)">
                            <i class="material-icons">more_horiz</i>
                            <i class="flag">0</i>
                        </p>
                    </div>
                    <div class="report-button-area">
                        @if($suspend_check)
                            <p class="report-button"><a href="/release/{{ $data['user_data'] -> id }}">凍結解除</a></p>
                        @else
                            <p class="report-button" onclick="openBtn(this)">アカウント停止</p>
                        @endif
                        
                        <p class="report-button" onclick="userDelete()">アカウント削除</p>
                    </div>
                </div>
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
        
        <div id="modal" class="modal">
            <form action="/suspend" method="post" class="modal-content material">
                {{ csrf_field() }}
                <div class="modal-content-header">
                    <h3>凍結理由を選択</h3>
                    <i class="material-icons" id="closeBtn">clear</i>
                </div>
                
                <div class="radio-contain">
                    <label class="check_lb">
                        <input type="radio" name="report_content" value="1">法令違反（著作権侵害、プライバシー侵害、名誉棄損等）
                    </label>
                    <label class="check_lb">
                        <input type="radio" name="report_content" value="2">社会的に不適切（公的風俗に反する）
                    </label>
                    <label class="check_lb">
                        <input type="radio" name="report_content" value="3">宣伝行為
                    </label>
                    <label class="check_lb">
                        <input type="radio" name="report_content" value="4">スパムの疑い
                    </label>
                    <label class="check_lb">
                        <input type="radio" name="report_content" value="5">それ以外でGTA journalにふさわしくない（ガイドライン違反）
                    </label>
                </div>
                <input type="hidden" name="user_id" id="target_content_id" value="{{ $data['user_data'] -> id }}">
                <input class="btn-flat-logo" type="submit" value="送信">
            </form>
        </div>
        
        @include('layouts.delete-user-check',['user_id' => $data['user_data'] -> id])
        
    </div>
@endsection