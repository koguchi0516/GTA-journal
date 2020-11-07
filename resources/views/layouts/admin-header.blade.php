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
        <link rel="stylesheet" href="/css/admin.css">
        <link rel="stylesheet" href="/css/style-mobile.css">
        
        <!-- Scripts -->
        <script src="/js/script.js"></script>
        
        <title>grand theft auto JOURNAL management</title>
    </head>

    <body>
        <div class="header-container">
            <a href="{{ route('admin_page') }}">
                <h1>grand theft auto <span class="red">JOURNAL</span> management</h1>
            </a>
            <div class="header-menu">
                <form action="{{ route('search_user') }}" class="admin-form" method="post">
                    {{ csrf_field() }}
                    <input class="input" type="text" name='user-data' placeholder="ユーザーID"><br>
                    <input class="btn-flat-logo admin-home" type="submit" value="検索">
                    <a href="/admin/logout">
                        <p class="btn-flat-logo admin-header">ログアウト</p>
                    </a>
                </form>
            </div>
        </div>
        
        @yield('content')
    </body>

</html>