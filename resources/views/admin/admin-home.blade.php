@extends('layouts.admin-header')

@section('content')
<div class="admin-home-container material">
    
    <div class="admin-data">
        <p>ユーザー数</p>
        <p>{{ $user_count }}人</p>
    </div>
    
    <a href="/admin/user-list">
        <div class="admin-data border">
            <p>凍結中ユーザー</p>
            <p>{{ $suspended_count }}人</p>
        </div>
    </a>
    
    <a href="/admin/list">
        <div class="admin-data border">
            <p>報告一覧</p>
            <p></p>
        </div>
    </a>
    
</div>
@endsection