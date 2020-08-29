@extends('layouts.admin-header')

@section('content')
<div class="admin-home-container material">
    
    <div class="admin-data">
        <p>ユーザー数</p>
        <p>394人</p>
    </div>
    
    <a href="/admin/report/user">
        <div class="admin-data border">
            <p>凍結中ユーザー</p>
            <p>13人</p>
        </div>
    </a>
    
    <a href="/admin/report/list">
        <div class="admin-data border">
            <p>報告一覧</p>
            <p></p>
        </div>
    </a>
    
</div>
@endsection