<?php
session_start();
// $_SESSION["USERNAME"] = "山田";
// $_SESSION["COMPANYNAME"] = "HAL株式会社";
$companyId = $_SESSION["COMPANYID"];
$userName = $_SESSION["USERNAME"];
$companyName = $_SESSION["COMPANYNAME"];

if (isset($_GET['af_id'])) {
    $affiliationId = $_GET['af_id'];
    $_SESSION["AFFILIATIONID"] = $affiliationId;
} else {
    $affiliationId = $_SESSION["AFFILIATIONID"];
}


//DB接続準備
$dsn    = 'mysql:host=localhost;dbname=db26;charset=utf8';
$user     = 'root';
$password = '';
$br = '<br>';

// DBへ接続
try {
    $dbh = new PDO($dsn, $user, $password);

    // クエリの実行
    $infoSession = "SELECT f.j_id  , f.day , i.classification FROM findworkreport f INNER JOIN information_session i  ON f.j_id = i.j_id WHERE c_id = '$companyId' AND af_id = '$affiliationId' AND a_cd = '1' ORDER BY day DESC;";
    $stmt1 = $dbh->query($infoSession);

    $tests = "SELECT f.j_id  , f.day , t.classification FROM findworkreport f INNER JOIN tests t  ON f.j_id = t.j_id WHERE c_id = '$companyId' AND af_id = '$affiliationId' AND a_cd = '2' ORDER BY day DESC;
    ";
    $stmt2 = $dbh->query($tests);

    $interview = "SELECT f.j_id  , f.day , i.classification FROM findworkreport f INNER JOIN interview i  ON f.j_id = i.j_id WHERE c_id = '$companyId' AND af_id = '$affiliationId' AND a_cd = '3' ORDER BY day DESC;";
    $stmt3 = $dbh->query($interview);

    $other = "SELECT f.j_id  , f.day , o.classification FROM findworkreport f INNER JOIN other o  ON f.j_id = o.j_id WHERE c_id = '$companyId' AND af_id = '$affiliationId' AND a_cd = '4' ORDER BY day DESC;
    ";
    $stmt4 = $dbh->query($other);

    // 接続を閉じる(※DBからデータを取得出来た時点で接続を切る)
    $dbh = null;
} catch (PDOException $e) {
    print("データベースの接続に失敗しました" . $e->getMessage());
    die();
}


?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/button.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/read.css">
    <link rel="stylesheet" type="text/css" href="css/backImg.css">
    <link rel="stylesheet" type="text/css" href="css/readStudentInfo.css">

    <title>閲覧</title>
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
                    <li><a href="search.php?select=read">企業検索</a>
                    <li class="logout"><a href="index.html">ログアウト</a>
                </ul>
            </nav>
        </div>
    </header>

    <a href="readStudentInfo.php" class="backimg"><img src="img/back.png" alt="back"></a>
    <section class="main">
        <div class="text">
            <h1><?php echo $companyName ?></h1>
            <div class="area">
                <input type="radio" name="tabName" id="tab1" checked>
                <label class="tabClass" for="tab1">説明会</label>

                <div class="contentClass">
                    <?php foreach ($stmt1 as $row) { ?>
                        <a href="readReport.php?j_id=<?= $row["j_id"] ?>&a_cd=1" class="category btn_a"><?= date('Y年n月d日', strtotime($row["day"]))  . "&emsp;" . $row["classification"] ?></a>
                    <?php } ?>
                </div>

                <input type="radio" name="tabName" id="tab2">
                <label class="tabClass" for="tab2">試験</label>

                <div class="contentClass">
                    <?php foreach ($stmt2 as $row) { ?>
                        <a href="readReport.php?j_id=<?= $row["j_id"] ?>&a_cd=2" class="category btn_a"><?= date('Y年n月d日', strtotime($row["day"])) . "&emsp;" . $row["classification"] ?></a>
                    <?php } ?>
                </div>

                <input type="radio" name="tabName" id="tab3">
                <label class="tabClass" for="tab3">面接</label>

                <div class="contentClass">
                    <?php foreach ($stmt3 as $row) { ?>
                        <a href="readReport.php?j_id=<?= $row["j_id"] ?>&a_cd=3" class="category btn_a"><?= date('Y年n月d日', strtotime($row["day"])) . "&emsp;" . $row["classification"] ?></a>
                    <?php } ?>

                </div>

                <input type="radio" name="tabName" id="tab4">
                <label class="tabClass" for="tab4">その他</label>

                <div class="contentClass">
                    <?php foreach ($stmt4 as $row) { ?>
                        <a href="readReport.php?j_id=<?= $row["j_id"] ?>&a_cd=4" class="category btn_a"><?= date('Y年n月d日', strtotime($row["day"])) . "&emsp;" . $row["classification"] ?></a>
                    <?php } ?>

                </div>
            </div>
        </div>

    </section>
</body>

</html>