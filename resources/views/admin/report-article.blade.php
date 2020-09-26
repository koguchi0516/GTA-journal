@extends('layouts.admin-header')

@section('content')

    @include('layouts.message-box')
    
    @if(count($data) == 6)
        @include('layouts.admin-report-user',['data' => $data])
    @endif
    
    @if(Session::has('info-'.$data['report_id']))
        @include('layouts.admin-message-box',['report_id' => $data['report_id']])
    @endif
    
    @if(isset($data['title_data']))
        <div class="article-container material">
            <div class="message-head">
                    <div class="user-name">
                        <a class="user-data" href="/mypage/{{ $data['title_data'] -> user -> id }}">
                            <img src="/storage/user-icons/{{ $data['title_data'] -> user -> icon }}" alt="icon">
                            <p>{{ $data['title_data'] -> user -> name }}</p>
                        </a>
                    </div>
                    
                    <div class="report-area">
                        <div class="message-report">
                            <p class="post-date">{{ date('Y/n/j G:i',strtotime($data['title_data'] -> updated_at)) }}</p>
                            <p onclick="reportIcon(this)">
                                <i class="material-icons">more_horiz</i>
                                <i class="flag">0</i>
                            </p>
                        </div>
                        <div class="report-button-area">
                            <p class="report-button" id="article-{{ $data['title_data']['id'] }}" onclick="checkOpenBtn(this)">削除</p>
                        </div>
                    </div>
                </div>
        
            <h2 class="article-title">{{ $data['title_data'] -> title }}</h2>
            <div class="article-tag-container">
                <div class="article-tags">
                    <a href="/home/category/{{ $data['title_data']['category_id'] }}">
                        <p>{{ $data['title_data'] -> category -> category_name }}</p>
                    </a>
                </div>
            </div>
        
            <div class="article-text">
                @php $i = 0; @endphp
                @foreach($content_types as $content_type)
                    @if($content_type == 'h3_content')
                        <h3>{{ $contents[$i]['h3_content'] }}</h3>
                    @elseif($content_type == 'p_content')
                        <p>{{ $contents[$i]['p_content'] }}</p>
                    @else
                        <img src="/storage/article-imgs/{{ $contents[$i]['img_content'] }}"></img>
                    @endif
                    @php $i++; @endphp
                @endforeach
            </div>
        </div>
        
        @if(!empty($data['comments']))
            @foreach($data['comments'] as $comment)
                <div class="comment-list-container material">
                    <div class="message-head">
                        <div class="user-name">
                            <a href="/mypage/{{ $comment -> user -> id }}">
                                <img src="/storage/user-icons/{{ $comment -> user -> icon }}" alt="icon">
                            </a>
                            <p>{{ $comment -> user -> name }}</p>
                        </div>
                        <div class="report-area">
                            <div class="message-report">
                                <p class="post-date">{{ date('m月d日 G時i分',strtotime($comment -> updated_at)) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="comment-text">
                        <p>{{ $comment['comment_content'] }}</p>
                    </div>
                </div>
            @endforeach
        @endif
        
        @include('layouts.modal',['article_title_id'=>$data['title_data']['id']])
        @include('layouts.check-modal')
        
    @endif

@endsection