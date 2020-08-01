@extends('layouts.header')

@section('content')

<div class="setting">
    <form action="{{ url('/setting') }}" class="change-icon-form" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-container">
            <p>アイコン</p>
            
        　　@if(isset( $message ) && $message == 'アイコン' )
        　　<p>{{ $message }}を変更しました</p>
        　　@endif
        　　
        　　@error('newIcon')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            
            <div>
                <img src="/user-icons/{{ Auth::user()->icon }}" alt="">
            </div>
            <input type="file" name="newIcon">
            <div class="setting-button">
                <input type="submit" value="アイコン変更" class="setting-button" name="setting-subbmit">
            </div>
        </div>
        
        <div class="form-container">
            <p>表示名</p>
            
        　　@if(isset( $message ) && $message == "表示名")
        　　<p>{{ $message }}を変更しました</p>
        　　@endif            
        　　
            @error('change-name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            
            <input type="text" class="change-name" name="change-name" value="{{ Auth::user()->name }}">
            <div class="setting-button">
                <input type="submit" value="表示名変更" class="setting-button" name="setting-subbmit">
            </div>
        </div>

        <div class="form-container">
            <p>PSID（未入力で削除できます）</p>
            
            @if(isset( $message ) && $message == "PSID")
        　　<p>{{ $message }}を変更しました</p>
        　　@endif
        　　
        　　@error('change-psid')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            
            @if(!Auth::user()->psid)
            <input type="text" class="change-psid" name="change-psid" placeholder="公開するPSID">
            @else
            <input type="text" class="change-psid" name="change-psid" value="{{ Auth::user()->psid }}">
            @endif
            
            <div class="setting-button">
                <input type="submit" value="PSID変更" class="setting-button" name="setting-subbmit">
            </div>
        </div>

        <div class="form-container">
            <p>プロフィール</p>
            
            @if(isset( $message ) && $message == "プロフィール")
        　　<p>{{ $message }}を変更しました</p>
        　　@endif
        　　
            @error('change-profile')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            
            @if(!Auth::user()->profile)
            <textarea class="change-profile" name="change-profile"></textarea>
            @else
            <textarea class="change-profile" name="change-profile">{{ Auth::user()->profile }}</textarea>
            @endif
            
            <div class="setting-button">
                <input type="submit" value="プロフィール変更" class="setting-button" name="setting-subbmit">
            </div>
        </div>

        <div class="form-container">
            <p>パスワード</p>
            
            @if(isset( $message ) && $message == "パスワード")
        　　      <p>{{ $message }}を変更しました</p>
        　　@endif
        　　
        　　@if(isset($message['password-error']))
        　　      <span class="invalid-feedback" role="alert">
                    <strong>{{ $message['password-error'] }}</strong>
                </span>
            @endif
            
            @error('new-password1')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong><br>
                </span>
            @enderror
            
            @error('new-password2')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            
            <input type="password" name="old-password" class="old-password" placeholder="現在のパスワード">
            <input type="password" name="new-password1" class="new-password1" placeholder="新しいパスワード">
            <input type="password" name="new-password2" class="new-password2" placeholder="新しいパスワード(確認用)">
            <div class="setting-button">
                <input type="submit" value="パスワード変更" class="setting-button" name="setting-subbmit">
            </div>
        </div>
    </form>

    <div class="setting-logout-container">
        <a href="logout"><p>ログアウト</p></a>
    </div>

    <div class="setting-delete-container">
        <p>アカウント削除</p>
    </div>

</div>
@endsection