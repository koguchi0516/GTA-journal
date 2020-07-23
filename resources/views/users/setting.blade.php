@extends('layouts.header')

@section('content')


<div class="setting">

    <form action="" class="change-icon-form" method="post" enctype="multipart/form-data">
        <p>アイコン</p>
        <div>
            <img src="{{ Auth::user()->icon }}" alt="">
        </div>
        <input type="file" name="change-icon">
        <div class="setting-button">
            <input type="submit" value="変更" class="setting-button" name="icon">
        </div>
    </form>

    <form action="" class="change-name-form" method="post">
        <p>表示名</p>
        <input type="text" class="change-name" name="change-name" value="{{ Auth::user()->name }}">
        <div class="setting-button">
            <input type="submit" value="変更" class="setting-button" name="name">
        </div>
    </form>

    <form action="" class="change-psid-form" method="post">
        <p>PSID</p>
        @if(!Auth::user()->psid)
        <input type="text" class="change-psid" name="change-psid" placeholder="公開するPSID">
        @else
        <input type="text" class="change-psid" name="change-psid" value="{{ Auth::user()->psdi }}">
        @endif
        <div class="setting-button">
            <input type="submit" value="変更" class="setting-button" name="psid">
        </div>
    </form>

    <form action="" class="change-profile-form" method="post">
        <p>自己紹介</p>
         @if(!Auth::user()->profile)
        <textarea class="change-pfofile" name="change-pfofile"></textarea>
        @else
        <textarea class="change-pfofile" name="change-pfofile">{{ Auth::user()->profile }}</textarea>
        @endif
        <div class="setting-button">
            <input type="submit" value="変更" class="setting-button" name="profile">
        </div>
    </form>

    <form action="" class="change-password-form" method="post">
        <p>パスワード</p>
        <input type="password" name="" class="old-password" placeholder="現在のパスワード">
        <input type="password" name="" class="new-password1" placeholder="新しいパスワード">
        <input type="password" name="" class="new-password2" placeholder="新しいパスワード(確認用)">
        <div class="setting-button">
            <input type="submit" value="変更" class="setting-button" name="password">
        </div>
    </form>

    <div class="setting-logout-container">
        <p>ログアウト</p>
    </div>

    <div class="setting-delete-container">
        <p>アカウント削除</p>
    </div>

</div>
@endsection