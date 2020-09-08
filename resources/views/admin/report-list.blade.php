@extends('layouts.admin-header')

@section('content')
    <p class="admin-title">報告一覧</p>
    
    @foreach($reports as $report)
        <div class="report-container material">
            <a class="report-title" href="/admin/report/{{ $report -> id }}">
                <p>{{ $report -> reason -> reason }}</p>
            </a>
            
            <div class="report-list-data">
                @if($report['content_type'] == 1)
                    <p>type : 記事</p>
                @elseif($report['content_type'] == 2)
                    <p>type : 記事コメント</p>
                @else
                    <p>type : フレンド募集</p>
                @endif
                
                
                @if($report -> user_id == 0)
                    <p>報告ユーザーID : 未登録</p>
                @else
                    <p>報告ユーザーID : {{ $report -> user['user_code'] }}</p>
                @endif
            </div>
        </div>
    @endforeach

@endsection