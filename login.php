<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/button.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <title>トップページ</title>
</head>

<body>
    <header>
        <div class="headwrrap">
            <div class="flex">

            </div>

            <nav>
                <ul>

                </ul>
            </nav>

        </div>
    </header>
    <section class="main">
        <form action="loginFunction.php" method="post">
            <div class="text">
                <h1>ログイン</h1>
                <p class="textbox"><input type="text" name="id" value="ohs12345" class="input_border login_text" placeholder="ID" autofocus onchange="isRegNum1(this)"></p>
                <p class="textbox">
                <div class="div"><input class="passtext" type="password" name="pass" value="B20010506" id="textPassword" placeholder="パスワード" onchange="isRegNum2(this)">
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