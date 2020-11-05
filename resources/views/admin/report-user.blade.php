@extends('layouts.admin-header')

@section('content')

    <p class="admin-title">凍結中ユーザー</p>
    
    @foreach($suspends as $suspend)
        <div class="report-container material">
            <a href="/mypage/{{ $suspend -> user -> id }}" class="report-user-data">
                <img src="{{ Storage::url($suspend -> user -> icon) }}"></img>
                <p>{{ $suspend -> user -> name }}</p>
            </a>
            <div class="report-list-data">
                <p>{{ $suspend -> reason -> reason }}</p>
                <p>{{date('m月d日 G時i分',strtotime($suspend -> created_at)) }}～</p>
            </div>
        </div>
    @endforeach
    
    <div class="pagination">
        {{ $suspends->links() }}
    </div>
    
@endsection