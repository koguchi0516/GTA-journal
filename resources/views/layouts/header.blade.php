<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <!--viewport-->
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <!--google-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--css-->
    <link rel="stylesheet" href="../css/reset_stylesheet.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style-mobile.css">
    <!--js-->
    <script src="../script/script.js"></script>
    <title>サービス名 ホーム画面</title>
</head>

<body>
    <div class="unregistered-header">
        <div class="header-container">
            <h1>Service Name</h1>
            <div class="header-menu">
                <a href="create.html">ユーザー登録</a>
                <a href="login.html">ログイン</a>
            </div>
        </div>
    </div>

    <div class="register-header">
        <div class="header-container">
            <h1>Service Names</h1>
            <div class="header-menu">
                <a href="article-post.html">投稿する</a>
                <img src="../img/default-icon.jpeg" alt="icon">
            </div>
        </div>
    </div>

    <div class="icon-nav">
        <a href="my-page.html">マイページ</a><br>
        <a href="setting.html">設定</a><br>
        <a href="#">ログアウト</a><br>
    </div>
    @yield('content')
</body>

</html>
