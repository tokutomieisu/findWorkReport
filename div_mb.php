<?php
session_start();

if (!empty($_GET['af_id'])) {
    $_SESSION["af_id"] = $_GET['af_id'];
}
if (!empty($_SESSION["COMPANYNAME"])) {
    $companyName = $_SESSION["COMPANYNAME"];
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/base_mb.css">
    <link rel="stylesheet" type="text/css" href="css/button_mb.css">
    <link rel="stylesheet" type="text/css" href="css/header_mb.css">
    <link rel="stylesheet" type="text/css" href="css/footer_mb.css">
    <link rel="stylesheet" type="text/css" href="css/div_mb.css">
    <title>トップページ</title>
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
        <form action="searchResult.php" method="get">
            <div class="text">

                <ul>
                    <li><a href="findWorkReport_mb.php?a_cd=1"><span>説明会</span><img src="img/arrow.png" alt="" class="li_img"></a></li>
                    <li><a href="findWorkReport_mb.php?a_cd=2"><span>試験</span><img src="img/arrow.png" alt="" class="li_img"></a></li>
                    <li><a href="findWorkReport_mb.php?a_cd=3"><span>面接</span><img src="img/arrow.png" alt="" class="li_img"></a></li>
                    <li><a href="findWorkReport_mb.php?a_cd=4"><span>その他</span><img src="img/arrow.png" alt="" class="li_img"></a></li>
                </ul>
            </div>
        </form>
        <footer>
            <div class="footerwrrap">
                <p class="icon"><a href="search_mb.php"><img src="img/search.png" alt=""></a></p>
            </div>
            <div class="footertext">
                <p class="icontext">検索</p>
            </div>
        </footer>
    </section>
</body>

</html>