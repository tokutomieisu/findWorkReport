<?php
session_start();        //セッション開始＆必要な変数
$userName = $_SESSION['USERNAME'];
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
    <link rel="stylesheet" type="text/css" href="css/companyTop.css">

</head>

<body>
    <header>
        <div class="headwrrap">
            <div class="flex">
                <p><img src="img/aicon.png" alt="logo"></p>
                <p><?php echo $userName; ?>&nbsp;様</p>
            </div>
            <nav>
                <ul>
                    <li><a href="favoriteCompany.php">検討リスト</a>
                    <li><a href="select.php">TOP</a>
                    <li class="logout"><a href="index.html">ログアウト</a>
                </ul>
            </nav>
        </div>
    </header>
    <section class="main">
        <div class="text">
            <h1> </h1>
        </div>

        <div id="menu">
            <a class="btn" href="search.php?select=record" class="button">記録</a>
            <a class="btn" href="search.php?select=read" class="button">閲覧</a>
        </div>
    </section>
</body>

</html>