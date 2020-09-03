@extends('layouts.admin-header')

@section('content')

    @include('layouts.admin-report-user',['data' => $data])

    @if(Session::has('info-'.$data['report_id']))
        @include('layouts.admin-message-box',['report_id' => $data['report_id']])
    @endif

@endsection