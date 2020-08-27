@extends('layouts.header')

@section('content')

<div class="message-box">
    <ul>
        @if(Session::has('info'))
            <p>{{ Session('info') }}</p>
        @endif
            
        @error('newIcon')
            <li>{{ $message }}</li>
        @enderror
        
        @error('change-name')
            <li>{{ $message }}</li>
        @enderror
        
        @error('change-psid')
            <li>{{ $message }}</li>
        @enderror
        
        @error('change-profile')
            <li>{{ $message }}</li>
        @enderror
        
        @error('new-password1')
            <li>{{ $message }}</li>
        @enderror
        
        @error('new-password2')
            <li>{{ $message }}</li>
        @enderror
        
        @if(isset($message['password-error']))
            <li>{{ $message['password-error'] }}</li>
        @endif
    </ul>
</div>

<div class="setting">
    <form action="{{ url('/setting') }}" class="change-icon-form" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-container">
            <p>アイコン</p>
            
            <div>
                <img src="/storage/user-icons/{{ Auth::user()->icon }}" alt="">
            </div>
            <input type="file" name="newIcon">
            <div class="setting-button">
                <input type="submit" value="アイコン" class="setting-button" name="setting-subbmit">
            </div>
        </div>
        
        <div class="form-container">
            <p>表示名</p>
            
            <input type="text" class="change-name" name="change-name" value="{{ Auth::user()->name }}">
            <div class="setting-button">
                <input type="submit" value="表示名" class="setting-button" name="setting-subbmit">
            </div>
        </div>

        <div class="form-container">
            <p>PSID（未入力で削除できます）</p>
            
            @if(!Auth::user()->psid)
                <input type="text" class="change-psid" name="change-psid" placeholder="公開するPSID">
            @else
                <input type="text" class="change-psid" name="change-psid" value="{{ Auth::user()->psid }}">
            @endif
            
            <div class="setting-button">
                <input type="submit" value="PSID" class="setting-button" name="setting-subbmit">
            </div>
        </div>

        <div class="form-container">
            <p>プロフィール</p>
            
            @if(!Auth::user()->profile)
                <textarea class="change-profile" name="change-profile"></textarea>
            @else
                <textarea class="change-profile" name="change-profile">{{ Auth::user()->profile }}</textarea>
            @endif
            
            <div class="setting-button">
                <input type="submit" value="プロフィール" class="setting-button" name="setting-subbmit">
            </div>
        </div>

        <div class="form-container">
            <p>パスワード</p>
            
            <input type="password" name="old-password" class="old-password" placeholder="現在のパスワード">
            <input type="password" name="new-password1" class="new-password1" placeholder="新しいパスワード">
            <input type="password" name="new-password2" class="new-password2" placeholder="新しいパスワード(確認用)">
            <div class="setting-button">
                <input type="submit" value="パスワード" class="setting-button" name="setting-subbmit">
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