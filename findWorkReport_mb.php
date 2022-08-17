<?php
session_start();

if (!empty($_GET['a_cd'])) {
    $_SESSION["a_cd"] = $_GET['a_cd'];
    $a_cd = $_GET['a_cd'];
} else {
    $a_cd = $_SESSION['a_cd'];
}

if (!empty($_SESSION["af_id"])) {
    $affiliationId = $_SESSION["af_id"];
}

if (!empty($_SESSION["COMPANYID"])) {
    $companyId = $_SESSION["COMPANYID"];
}

if (!empty($_SESSION["COMPANYNAME"])) {
    $companyName = $_SESSION["COMPANYNAME"];
}

//DB接続準備
$dsn    = 'mysql:host=localhost;dbname=db26;charset=utf8';
$user     = 'root';
$password = '';
$br = '<br>';

// DBへ接続
try {
    $dbh = new PDO($dsn, $user, $password);

    if ($a_cd == 1) {
        $sql = "SELECT f.j_id  , f.day , i.classification FROM findworkreport f INNER JOIN information_session i  ON f.j_id = i.j_id WHERE c_id = '$companyId' AND af_id = '$affiliationId' AND a_cd = '1' ORDER BY day DESC;";
        $a_name = "説明会";
    } else if ($a_cd == 2) {
        $sql = "SELECT f.j_id  , f.day , t.classification FROM findworkreport f INNER JOIN tests t  ON f.j_id = t.j_id WHERE c_id = '$companyId' AND af_id = '$affiliationId' AND a_cd = '2' ORDER BY day DESC;";
        $a_name = "試験";
    } else if ($a_cd == 3) {
        $sql = "SELECT f.j_id  , f.day , i.classification FROM findworkreport f INNER JOIN interview i  ON f.j_id = i.j_id WHERE c_id = '$companyId' AND af_id = '$affiliationId' AND a_cd = '3' ORDER BY day DESC;";
        $a_name = "面接";
    } else if ($a_cd == 4) {
        $sql = "SELECT f.j_id  , f.day , o.classification FROM findworkreport f INNER JOIN other o  ON f.j_id = o.j_id WHERE c_id = '$companyId' AND af_id = '$affiliationId' AND a_cd = '4' ORDER BY day DESC;";
        $a_name = "その他";
    }

    $_SESSION["a_name"] = $a_name;

    // クエリの実行

    $stmt = $dbh->query($sql);
    $count = $stmt->rowCount();
    if ($count == 0) {
        $notStmt = "レポートはありません。";
        $back = "戻る";
    }else{
        $notStmt = "";
        $back = "";
    }

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
    <link rel="stylesheet" type="text/css" href="css/base_mb.css">
    <link rel="stylesheet" type="text/css" href="css/button_mb.css">
    <link rel="stylesheet" type="text/css" href="css/header_mb.css">
    <link rel="stylesheet" type="text/css" href="css/footer_mb.css">
    <link rel="stylesheet" type="text/css" href="css/searchResult_mb.css">
    <title>レポート選択</title>
</head>

<body>
    <header>
        <div class="headwrrap">
            <div class="flex h_textarea">
                <a href="div_mb.php" class="backimg"><img src="img/back_mb.png" alt="back"></a>
                <p class="h_text"><?= $companyName ?>&ensp;<?= $a_name ?></p>
            </div>

        </div>
    </header>
    <section class="main">
        <form action="searchResult.php" method="get">
            <div class="text">
                <?php foreach ($stmt as $row) { ?>
                    <p class="panel"><a href="readReport_mb.php?j_id=<?= $row["j_id"] ?>"><span><?= $row["classification"] ?></span><span class="date"><?= date('Y年n月d日', strtotime($row["day"])) ?></span></a></p>
                <?php } ?>
                <p><?= $notStmt ?></p>
                <a href="div_mb.php"><?= $back ?></a>
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