<?php
session_start();

$userId = $_SESSION['USERID'];

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

if (!empty($_SESSION['f_c_name'])) {
    $f_c_name = $_SESSION['f_c_name'];
}

$f_check = "";
$f_judge = "";

foreach ($f_c_name as $c_name) {
    if ($c_name == $companyName) {
        $f_check = "checked";
    }
}

if (isset($_POST['hidden1'])) {
    if (isset($_POST['review'])) {
        $f_judge = "add";
    } else {
        $f_judge = "del";
    }
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
    } else {
        $notStmt = "";
        $back = "";
    }

    if ($f_judge == "add") {
        $sql1 = "INSERT INTO student_company (s_id, c_id) VALUES('$userId', '$companyId');";
        $f_c_name[] = $companyName;
        $stmtf = $dbh->query($sql1);
        $_SESSION['f_c_name'] = $f_c_name;
    } else if ($f_judge == "del") {
        $sql1 = "DELETE FROM student_company WHERE c_id = '$companyId' AND s_id = '$userId';";
        $stmtf = $dbh->query($sql1);
        $key = array_search($companyName, $f_c_name);
        unset($f_c_name[$key]);
        $f_c_name = array_values($f_c_name);
        $_SESSION['f_c_name'] = $f_c_name;
    }

    // 接続を閉じる(※DBからデータを取得出来た時点で接続を切る)
    $dbh = null;
} catch (PDOException $e) {
    print("データベースの接続に失敗しました" . $e->getMessage());
    die();
}

$f_check = "";

foreach ($f_c_name as $c_name) {
    if ($c_name == $companyName) {
        $f_check = "checked";
    }
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
    <link rel="stylesheet" type="text/css" href="css/favorite_mb.css">
    <title>レポート選択</title>
</head>

<body>
    <header>
        <div class="headwrrap">
            <form action="findWorkReport_mb.php" method="post" name="myForm">
                <div class="flex h_textarea">
                    <a href="div_mb.php" class="backimg"><img src="img/back_mb.png" alt="back"></a>
                    <p class="h_text_star"><?= $companyName ?>&ensp;<?= $a_name ?>
                        <span class="star">
                            <input id="review06" type="checkbox" name="review" value="1" <?= $f_check ?> onclick="runOpenstrt()"><label for="review06">★</label>
                        </span>
                    </p>
                </div>
                <input type="hidden" name="hidden1" value="hidden"> 
            </form>
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
    <script src="js/favorite.js"></script>
</body>
</html>