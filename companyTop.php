<?php
session_start();        //セッション開始＆必要な変数
$userName = $_SESSION['USERNAME'];
if (!empty($_GET['c_name'])) {
    $companyName = $_GET['c_name'];        //これでGET受け取れるはず
    $_SESSION['COMPANYNAME'] = $companyName;    //次ページがsessionだったのでここでsession変数に格納
    $companyId = $_GET['c_id'];        //これでGET受け取れるはず
    $_SESSION['COMPANYID'] = $companyId;
} else {
    $companyName = $_SESSION['COMPANYNAME'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>記録・閲覧</title>
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/button.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/backImg.css">
    <link rel="stylesheet" type="text/css" href="css/companyTop.css">

</head>

<body>
    <header>
        <div class="headwrrap">
            <div class="flex">
                <p><img src="img/aicon.png" alt="logo"></p>
                <p><?php echo $userName ?>&nbsp;様</p>
            </div>

            <nav>
                <ul>
                    <li><a href="search.php">企業検索</a>
                    <li class="logout"><a href="index.html">ログアウト</a>
                </ul>
            </nav>
        </div>
    </header>
    <a href="search.php" class="backimg"><img src="img/back.png" alt="back"></a>
    <section class="main">
        <div class="text">
            <h1><?php echo $companyName ?></h1>
        </div>

        <div id="menu">
            <a class="btn" href="recodeTop.php" class="button">記録</a>
            <a class="btn" href="readStudentInfo.php" class="button">閲覧</a>
        </div>
    </section>
</body>

</html>