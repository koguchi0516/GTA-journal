@extends('layouts.header')

@section('content')
<div class="setting">

    <form action="" class="change-icon-form" method="post" enctype="multipart/form-data">
        <p>アイコン</p>
        <div>
            <img src="../img/default-icon.jpeg" alt="">
        </div>
        <input type="file" name="change-icon">
        <div class="setting-button">
            <input type="submit" value="変更" class="setting-button">
        </div>
    </form>

    <form action="" class="change-name-form" method="post">
        <p>表示名</p>
        <input type="text" class="change-name" name="change-name" value="今の名前">
        <div class="setting-button">
            <input type="submit" value="変更" class="setting-button">
        </div>
    </form>

    <form action="" class="change-psid-form" method="post">
        <p>PSID</p>
        <input type="text" class="change-psid" name="change-psid" value="今のPSID">
        <div class="setting-button">
            <input type="submit" value="変更" class="setting-button">
        </div>
    </form>

    <form action="" class="change-profile-form" method="post">
        <p>自己紹介</p>
        <textarea class="change-pfofile" name="change-pfofile">今のプロフィール</textarea>
        <div class="setting-button">
            <input type="submit" value="変更" class="setting-button">
        </div>
    </form>

    <form action="" class="change-password-form" method="post">
        <p>パスワード</p>
        <input type="password" name="" class="old-password" placeholder="現在のパスワード">
        <input type="password" name="" class="new-password1" placeholder="新しいパスワード">
        <input type="password" name="" class="new-password2" placeholder="新しいパスワード(確認用)">
        <div class="setting-button">
            <input type="submit" value="変更" class="setting-button">
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