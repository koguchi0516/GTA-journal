@extends('layouts.header')

@section('content')

@include('layouts.message-box')

<div class="setting">
    <form action="{{ url('/setting') }}" class="setting-form" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-container material">
            <p>アイコン</p>
            <div>
                <img src="/storage/user-icons/{{ Auth::user()->icon }}" alt="">
            </div>
            <input type="file" name="newIcon">
            <div class="setting-button">
                <input type="submit" value="アイコン" class="btn-flat-logo" name="setting-subbmit">
            </div>
        </div>
        
        <div class="form-container material">
            <p>表示名</p>
            
            <input type="text" class="change-name input" name="change-name" value="{{ Auth::user()->name }}">
            <div class="setting-button">
                <input type="submit" value="表示名" class="btn-flat-logo" name="setting-subbmit">
            </div>
        </div>

        <div class="form-container material">
            <p>PSID（未入力で削除できます）</p>
            
            @if(!Auth::user()->psid)
                <input type="text" class="change-psid  input" name="change-psid" placeholder="公開するPSID">
            @else
                <input type="text" class="change-psid  input" name="change-psid" value="{{ Auth::user()->psid }}">
            @endif
            
            <div class="setting-button">
                <input type="submit" value="PSID" class="btn-flat-logo" name="setting-subbmit">
            </div>
        </div>

        <div class="form-container material">
            <p>プロフィール</p>
            
            @if(!Auth::user()->profile)
                <textarea class="change-profile" name="change-profile"></textarea>
            @else
                <textarea class="change-profile" name="change-profile">{{ Auth::user()->profile }}</textarea>
            @endif
            
            <div class="setting-button">
                <input type="submit" value="プロフィール" class="btn-flat-logo" name="setting-subbmit">
            </div>
        </div>

        <div class="form-container material">
            <p>パスワード</p>
            
            <input type="password" class="input" name="old-password" class="old-password" placeholder="現在のパスワード">
            <input type="password" class="input" name="new-password1" class="new-password1" placeholder="新しいパスワード">
            <input type="password" class="input" name="new-password2" class="new-password2" placeholder="新しいパスワード(確認用)">
            <div class="setting-button">
                <input type="submit" value="パスワード" class="btn-flat-logo" name="setting-subbmit">
            </div>
        </div>
    </form>

    <div>
        <a class="setting btn-flat-logo" href="logout"><p>ログアウト</p></a>
    </div>

    <di>
        <p class="setting btn-flat-logo">アカウント削除</p>
    </div>

</div>
@endsection