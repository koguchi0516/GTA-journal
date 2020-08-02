<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <!--viewport-->
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <!--google-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--css-->
    <link rel="stylesheet" href="css/style-reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style-mobile.css">
    <!--js-->
    <script src="js/script.js"></script>
    <title>GTA journal</title>
</head>

@guest
<body>
    <div class="unregistered-header">
        <div class="header-container">
            <a href="home"><h1>GTA journal</h1></a>
            <div class="header-menu">
                <a href="register">ユーザー登録</a>
                <a href="login">ログイン</a>
            </div>
        </div>
    </div>
@else
    <div class="register-header">
        <div class="header-container">
            <a href="home"><h1>GTA journal</h1></a>
            <div class="header-menu">
                <a href="article-post">投稿する</a>
                <img src="/user-icons/{{ Auth::user()->icon }}" alt="icon">
            </div>
        </div>
    </div>
@endguest

    <div class="icon-nav">
        <a href="mypage">マイページ</a><br>
        <a href="setting">設定</a><br>
        <a href="logout">ログアウト</a><br>
    </div>
    @yield('content')
</body>

</html>
