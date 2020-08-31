@extends('layouts.admin-header')

@section('content')
    <p class="admin-title">報告一覧</p>
    
    @foreach($reports as $report)
        <div class="report-container material">
            <a class="report-title" href="/admin/report/{{ $report -> id }}">
                @if($report -> report_content == 1)
                    <p>社会的に不適切</p>
                @elseif($report -> report_content == 2)
                    <p>法令違反</p>
                @elseif($report -> report_content == 3)
                    <p>スパムの疑い</p>
                @elseif($report -> report_content == 4)
                    <p>宣伝行為</p>
                @else
                    <p>それ以外</p>
                @endif
            </a>
            
            <div class="report-list-data">
                @if($report['content_type'] == 1)
                    <p>type : 記事</p>
                @elseif($report['content_type'] == 2)
                    <p>type : 記事コメント</p>
                @else
                    <p>type : フレンド募集</p>
                @endif
                <p>対象ユーザーID : {{ $report -> user -> user_code }}</p>
            </div>
        </div>
    @endforeach

@endsection