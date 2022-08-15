<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/base_mb.css">
    <link rel="stylesheet" type="text/css" href="css/button_mb.css">
    <link rel="stylesheet" type="text/css" href="css/login_mb.css">
    <link rel="stylesheet" type="text/css" href="css/header_mb.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <title>トップページ(モバイル)</title>
</head>

<body>
    <header>
        <div class="headwrrap">
            <div class="flex h_textarea">
                <p class="h_text">ログイン</p>
            </div>

        </div>
    </header>
    <section class="main">
        <form action="loginFunction_mb.php" method="post">
            <div class="text">
                <div class="flex">
                    <p class="t_img"><img src="img/aicon.png" alt="logo" class="h_img"></p>
                    <p class="img_title">就活レポート</p>
                </div>
                <p class="title">ID</p>
                <p class="textbox"><input type="text" name="id" value="ohs12345" class="input_border login_text" autofocus onchange="isRegNum1(this)"></p>
                <p class="title">パスワード</p>
                <p class="textbox">
                <div class="div passarea"><input class="passtext" type="password" name="pass" value="B20010506" id="textPassword" onchange="isRegNum2(this)">
                    <p id="buttonEye" class="fa fa-eye" onclick="pushHideButton()"></p>
                </div>
                </p>
            </div>
            <p><button type="submit" name="login" id="btn" class="btn" class="button" value="send">ログイン</button></p>
        </form>
    </section>

    <script src="./js/login.js"></script>
    <script src="./js/button_able.js"></script>
</body>

</html>