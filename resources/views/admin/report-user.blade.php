@extends('layouts.admin-header')

@section('content')

    <p class="admin-title">凍結中ユーザー</p>
    
    @foreach($suspends as $suspend)
        <div class="report-container material">
            <a href="/mypage/{{ $suspend -> user -> id }}" class="report-user-data">
                <img src="/storage/user-icons/{{ $suspend -> user -> icon }}"></img>
                <p>{{ $suspend -> user -> name }}</p>
            </a>
            <div class="report-list-data">
                <p>凍結理由 : {{ $suspend -> reason -> reason }}</p>
                <p>凍結日時 : {{date('m月d日 G時i分',strtotime($suspend -> created_at)) }}</p>
            </div>
        </div>
    @endforeach
    
    <div class="pagination">
        {{ $suspends->links() }}
    </div>
    
@endsection