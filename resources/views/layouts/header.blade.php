@if(Session('admin') == 1)
    @include('layouts.admin-header')
@else
    <!DOCTYPE html>
    <html lang="ja">
        <head>
            <meta charset="UTF-8">
            <!--viewport-->
            <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
            <!--google-->
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=Coda+Caption:wght@800&display=swap" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=Sawarabi+Gothic&display=swap" rel="stylesheet">
            <!--css-->
            <link rel="stylesheet" href="{{ asset('css/style-reset.css') }}">
            <link rel="stylesheet" href="{{ asset('css/style.css') }}">
            <link rel="stylesheet" href="{{ asset('css/style-mobile.css') }}">
            <!--js-->
            <script src="{{ asset('js/script.js') }}"></script>
            <title>grand theft auto JOURNAL</title>
        </head>
    
        <body>
            <div class="header-sticky">
                @guest
                    <div class="unregistered-header">
                        <div class="header-container material">
                            <a href="/home">
                                <h1>grand theft auto <span class="red">JOURNAL</span></h1>
                            </a>
                            <div class="header-menu">
                                <a href="/register" class="btn-flat-logo header">ユーザー登録</a>
                                <a href="/login" class="btn-flat-logo header">ログイン</a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="register-header">
                        <div class="header-container">
                            <a href="/home">
                                <h1>grand theft auto <span class="red">JOURNAL</span></h1>
                            </a>
                            <div class="header-menu">
                                <a href="/article-post" class="btn-flat-logo header">投稿する</a>
                                <a href="/mypage/{{ Auth::user() -> id }}" class="head-img-linl">
                                    <img src="/storage/user-icons/{{ Auth::user() -> icon }}" alt="icon">
                                </a>
                                <i class="material-icons open-menu" id="open-menu" onclick="menuOpen()">arrow_drop_down</i>
                            </div>
                        </div>
                    </div>
                @endguest
            </div>
            @auth
                <div class="menu-sticky">
                    <div class="icon-nav material" id="menu-accordion">
                        <a href="/mypage/{{ Auth::user() -> id }}"><p>マイページ</p></a>
                        <a href="/setting"><p>設定</p></a>
                        <a href="/logout"><p>ログアウト</p></a>
                        <input type="hidden" id="menu_click" value="Open">
                    </div>
                </div>
            @endauth
            @yield('content')
        </body>
    </html>
@endif
