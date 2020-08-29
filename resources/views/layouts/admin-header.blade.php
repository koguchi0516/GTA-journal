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
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
        <!--js-->
        <script src="{{ asset('js/script.js') }}"></script>
        <title>grand theft auto JOURNAL</title>
    </head>

    <body>
        <div class="header-sticky">
            <div class="register-header report-header">
                <div class="header-container">
                    <a href="/admin/home">
                        <h1>grand theft auto <span class="red">JOURNAL</span> management</h1>
                    </a>
                    <div class="header-menu">
                        <form action="" class="admin-form" method="post">
                            {{ csrf_field() }}
                            <input class="input" type="text" name='user-data' placeholder="表示名・ユーザーID"><br>
                            <input class="btn-flat-logo admin-home" type="submit" value="検索">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        @yield('content')
    </body>

</html>