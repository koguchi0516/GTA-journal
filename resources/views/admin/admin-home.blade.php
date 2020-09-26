@extends('layouts.admin-header')

@section('content')
    @include('layouts.message-box')
    
    <div class="admin-home-container material">
        
        <div class="admin-data">
            <p>ユーザー数</p>
            <p>{{ $data['user_count'] }}人</p>
        </div>
        
        <div class="admin-data">
            <a href="/admin/user-list">
                <p>凍結中ユーザー</p>
            </a>
            <p>{{ $data['suspended_count'] }}人</p>
        </div>
        
        <div class="admin-data">
            <a href="/admin/list">
                <p>報告一覧</p>
            </a>
            <p>{{ $data['report_count'] }}件</p>
        </div>
        
    </div>
@endsection