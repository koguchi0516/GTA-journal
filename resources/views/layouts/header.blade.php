@if(Session('admin') == 1)
    @include('layouts.admin-header')
@else
    <!DOCTYPE html>
    <html lang="ja">
        <head>
            <meta charset="UTF-8">
            
            <!-- Viewport -->
            <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
            
            <!-- Fonts -->
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=Coda+Caption:wght@800&display=swap" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=Sawarabi+Gothic&display=swap" rel="stylesheet">
            
            <!-- Styles -->
            <link rel="stylesheet" href="/css/app.css">
            <link rel="stylesheet" href="/css/style-reset.css">
            <link rel="stylesheet" href="/css/style.css">
            <link rel="stylesheet" href="/css/style-mobile.css">
            
            <!-- Scripts -->
            <script src="/js/script.js"></script>
            
            <title>grand theft auto JOURNAL</title>
        </head>
    
        <body>
            <div class="header-sticky">
                @guest
                    <div class="unregistered-header">
                        <div class="header-container material">
                            <i class="material-icons mobile" onclick="mobileMenu()">menu</i>
                            <a href="{{ route('home') }}">
                                <h1>grand theft auto <span class="red">JOURNAL</span></h1>
                            </a>
                            <div class="header-menu pc">
                                <a href="/register" class="btn-flat-logo header">登録</a>
                                <a href="/login" class="btn-flat-logo header">ログイン</a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="header-container">
                        <i class="material-icons mobile" onclick="mobileMenu()">menu</i>
                        <a href="{{ route('home') }}">
                            <h1>grand theft auto <span class="red">JOURNAL</span></h1>
                        </a>
                        <div class="header-menu pc">
                            <a href="{{ route('create_article_page') }}" class="btn-flat-logo header">記事投稿</a>
                            <a href="{{ route('mypage.',['user_id' => Auth::user() -> id]) }}" class="head-img-linl">
                                <img src="{{ Storage::url(Auth::user() -> icon) }}" alt="icon">
                            </a>
                            <i class="material-icons open-menu" id="open-menu" onclick="menuOpen()">arrow_drop_down</i>
                        </div>
                    </div>
                @endguest
            </div>
            @auth
                <div class="menu-sticky pc">
                    <div class="icon-nav material" id="menu-accordion">
                        <a href="{{ route('mypage.',['user_id' => Auth::user() -> id]) }}"><p>マイページ</p></a>
                        <a href="{{ route('setting') }}"><p>設定</p></a>
                        <input type="hidden" id="menu_click" value="Open">
                    </div>
                </div>
            @endauth
            
            <div class="main-contents">
                <nav class="material mobile" id="mobile-menu">
                    <input type="hidden" id="mobile-menu-flag" value="Open">
                    @auth
                        <a href="{{ route('mypage.',['user_id' => Auth::user() -> id]) }}"><p>マイページ</p></a>
                        <a href="{{ route('create_article_page') }}" class="mobile"><p>記事投稿</p></a>
                        <a href="{{ route('my_favo_list') }}"><p>お気に入り</p></a>
                    @else
                        <a href="/register"><p>登録</p></a>
                        <a href="/login"><p>ログイン</p></a>
                    @endauth
                        <a href="{{ route('friend_page') }}"><p>フレンド募集</p></a>
                        <a href="{{ route('home') }}"><p>最新記事</p></a>
                        <a href="{{ route('popular_articles.',['period' => 'hot']) }}"><p>Daily</p></a>
                        <a href="{{ route('popular_articles.',['period' => 'weekly']) }}"><p>Weekly</p></a>
                        <a href="{{ route('popular_articles.',['period' => 'month']) }}"><p>Monthly</p></a>
                    @auth
                        <a href="{{ route('setting') }}"><p>設定</p></a>
                    @endauth
                    
                    <form action="{{ route('search_user') }}" method="post">
                        {{ csrf_field() }}
                        <p>ユーザー検索</p>
                        <input class="input" type="text" name='user-data' placeholder="表示名・ユーザーID"><br>
                        <input class="btn-flat-logo" type="submit" value="検索">
                    </form>
                    
                    <form action="{{ route('search_category') }}" method="post">
                        {{ csrf_field() }}
                        <p>カテゴリ検索</p>
                        @include('layouts.select-category')
                        <br>
                        <input class="btn-flat-logo" type="submit" value="検索">
                    </form>
                </nav>
            </div>
            
            @yield('content')
            
        </body>
    </html>
@endif
