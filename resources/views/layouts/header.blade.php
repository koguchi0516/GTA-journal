<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <!--viewport-->
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <!--google-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--css-->
    <link rel="stylesheet" href="{{ asset('css/style-reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style-mobile.css') }}">
    <!--js-->
    <script src="{{ asset('js/script.js') }}"></script>
    @yield('script')
    <title>GTA journal</title>
</head>

@guest
<body>
    <div class="unregistered-header">
        <div class="header-container">
            <a href="/home">
                <h1>GTA journal</h1>
            </a>
            <div class="header-menu">
                <a href="register" class="link-btn">ユーザー登録</a>
                <a href="login" class="link-btn">ログイン</a>
            </div>
        </div>
    </div>
@else
    <div class="register-header">
        <div class="header-container">
            <a href="/home">
                <h1>GTA journal</h1>
            </a>
            <div class="header-menu">
                <a href="/article-post" class="link-btn">投稿する</a>
                <a href="/mypage/{{ Auth::user() -> id }}" class="head-img-linl">
                    <img src="/user-icons/{{ Auth::user() -> icon }}" alt="icon">
                </a>
                <i class="material-icons open-menu" id="open-menu" onclick="menuOpen()">arrow_drop_down</i>
            </div>
        </div>
    </div>
    <div class="icon-nav" id="menu-accordion">
        <a href="/mypage/{{ Auth::user() -> id }}">マイページ</a><br>
        <a href="/setting">設定</a><br>
        <a href="/logout">ログアウト</a><br>
        <input type="hidden" id="menu_click" value="Open">
    </div>
@endguest
    
@yield('content')
</body>

</html>
