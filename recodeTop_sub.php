<?php
session_start();
// $_SESSION['USERNAME'] = '小松原';
$userName = $_SESSION['USERNAME'];
// $_SESSION['COMPANYNAME'] = '〇〇〇株式会社';
$companyName = $_SESSION['COMPANYNAME'];
unset($_SESSION["CLASSFICATION2"]);
unset($_SESSION["CLASSIFICATION2_TEXT"]);
unset($_SESSION["PROPERTY"]);
unset($_SESSION["THOUGHTS"]);


/**
 * 日付を取得
 * (new)三項演算子
 */
if (!empty($_SESSION['DAY'])) {
    $day = $_SESSION['DAY'];
    $day = empty($day) ? $day = "" : $day;
} else {
    $day = "";
}

/**
 * 形態を取得（対面・オンライン）
 */
if (!empty($_SESSION['PLACE'])) {
    $place = $_SESSION['PLACE'];
    $offCheck = $place == "対面" ? "checked" : "";
    $onCheck = $place == "オンライン" ? "checked" : "";
} else {
    $offCheck = "checked";
    $onCheck = "";
}

/**
 * 活動内容を取得
 */
if (!empty($_SESSION['ACTIVE'])) {
    $active = $_SESSION['ACTIVE'];
    $infoCheck = $active == "説明会" ? "checked" : "";
    $testCheck = $active == "試験" ? "checked" : "";
    $inteCheck = $active == "面接" ? "checked" : "";
    $othCheck = $active == "その他" ? "checked" : "";
} else {
    $infoCheck = "checked";
    $testCheck = "";
    $inteCheck = "";
    $othCheck = "";
}





?>

<?php ?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>記録</title>
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/button.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/backImg.css">
    <link rel="stylesheet" type="text/css" href="css/recodeTop.css">
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
    <a href="companyTop.html" class="backimg"><img src="img/back.png" alt="back"></a>
    <section class="main">
        <div class="text">
            <h1><?php echo $companyName ?></h1>

            <form action="loop.php" method="get">
                <div id="info">
                    <p>
                        <label for="day">日時：</label>
                        <input type="date" name="day" id="day" value="<?= $day ?>" onchange="isRegNum1(this)">
                    </p>
                    <p>
                        <label for="place">形態：</label>
                        <input type="radio" name="place" id="offLine" value="対面" class="radio" <?= $offCheck ?>>
                        <label for="offLine">対面</label>
                        <input type="radio" name="place" id="onLine" value="オンライン" class="radio" <?= $onCheck ?>>
                        <label for="onLine">オンライン</label>
                    </p>


                    <p><label>活動内容：</label></p>
                    <input id="0" class="checkbox" type="radio" name="active" value="説明会" class="check" <?= $infoCheck ?>>
                    <label for="0">説明会</label>
                    <input id="1" class="checkbox" type="radio" name="active" value="試験" class="check" <?= $testCheck ?>>
                    <label for="1">試験</label>
                    <input id="2" class="checkbox" type="radio" name="active" value="面接" class="check" <?= $inteCheck ?>>
                    <label for="2">面接</label>
                    <input id="3" class="checkbox" type="radio" name="active" value="その他" class="check" <?= $othCheck ?>>
                    <label for="3">その他</label>

                    <input type="submit" class="btn" name="btn" id="btnjs" disabled>
                </div>
        </div>
        </form>
    </section>
    <script src="js/recordToop.js"></script>
</body>

</html>