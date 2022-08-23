<?php
session_start();
$userId = $_SESSION['USERID'];
$companyId = $_SESSION["COMPANYID"];
$userName = $_SESSION["USERNAME"];
$companyName = $_SESSION["COMPANYNAME"];

if (isset($_GET['af_id'])) {
    $affiliationId = $_GET['af_id'];
    $_SESSION["AFFILIATIONID"] = $affiliationId;
} else {
    $affiliationId = $_SESSION["AFFILIATIONID"];
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


if (isset($_POST['hidden'])) {
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

    // クエリの実行
    $infoSession = "SELECT f.j_id  , f.day , i.classification FROM findworkreport f INNER JOIN information_session i  ON f.j_id = i.j_id WHERE c_id = '$companyId' AND af_id = '$affiliationId' AND a_cd = '1' ORDER BY day DESC;";
    $stmt1 = $dbh->query($infoSession);

    $tests = "SELECT f.j_id  , f.day , t.classification FROM findworkreport f INNER JOIN tests t  ON f.j_id = t.j_id WHERE cf._id = '$companyId' AND f.af_id = '$affiliationId' AND f.a_cd = '2' ORDER BY day DESC;
    ";
    $stmt2 = $dbh->query($tests);
    $stmt2  = array();

    $interview = "SELECT f.j_id  , f.day , i.classification FROM findworkreport f INNER JOIN interview i  ON f.j_id = i.j_id WHERE f.c_id = '$companyId' AND f.af_id = '$affiliationId' AND f.a_cd = '3' ORDER BY day DESC;";
    $stmt3 = $dbh->query($interview);

    $other = "SELECT f.j_id  , f.day , o.classification FROM findworkreport f INNER JOIN other o  ON f.j_id = o.j_id WHERE f.c_id = '$companyId' AND f.af_id = '$affiliationId' AND f.a_cd = '4' ORDER BY day DESC;
    ";
    $stmt4 = $dbh->query($other);
    if (empty($stmt1)) {
        $stmt1 = array();
    }
    if (empty($stmt2)) {
        $stmt2 = array();
    }
    if (empty($stmt3)) {
        $stmt3 = array();
    }
    if (empty($stmt4)) {
        $stmt4 = array();
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
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/button.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/read.css">
    <link rel="stylesheet" type="text/css" href="css/backImg.css">
    <link rel="stylesheet" type="text/css" href="css/readStudentInfo.css">
    <link rel="stylesheet" type="text/css" href="css/favorite.css">

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
                    <li><a href="favoriteCompany.php">検討リスト</a>
                    <li><a href="select.php">TOP</a>
                    <li class="logout"><a href="index.html">ログアウト</a>
                </ul>
            </nav>
        </div>
    </header>

    <a href="readStudentInfo.php" class="backimg"><img src="img/back.png" alt="back"></a>
    <section class="main">
        <div class="text">
            <form action="findWorkReport.php" method="post" name="myForm">
                <div class="flex starflex">
                    <h1><?= $companyName ?> </h1>
                    <span class="star">
                        <input id="review06" type="checkbox" name="review" value="1" <?= $f_check ?> onclick="runOpenstrt()"><label for="review06"><span class="set"><span id="s_star">★</span><span class="block">検討リスト</span></span></label>
                    </span>
                </div>
                <div class="area">
                    <input type="radio" name="tabName" id="tab1" checked value="1">
                    <label class="tabClass" for="tab1">説明会</label>

                    <div class="contentClass">
                        <?php foreach ($stmt1 as $row) { ?>
                            <a href="readReport.php?j_id=<?= $row["j_id"] ?>&a_id=1" class="category2 btn_a "><?= date('Y年n月d日', strtotime($row["day"])) . "&emsp;" . $row["classification"] ?></a><br>
                        <?php } ?>
                    </div>

                    <input type="radio" name="tabName" id="tab2" value="2">
                    <label class="tabClass" for="tab2">試験</label>

                    <div class="contentClass">
                        <?php foreach ($stmt2 as $row) { ?>
                            <a href="readReport.php?j_id=<?= $row["j_id"] ?>&a_id=2" class="category2 btn_a "><?= date('Y年n月d日', strtotime($row["day"])) . "&emsp;" . $row["classification"] ?></a><br>
                        <?php } ?>
                    </div>

                    <input type="radio" name="tabName" id="tab3" value="3">
                    <label class="tabClass" for="tab3">面接</label>

                    <div class="contentClass">
                        <?php foreach ($stmt3 as $row) { ?>
                            <a href="readReport.php?j_id=<?= $row["j_id"] ?>&a_id=3" class="category2 btn_a "><?= date('Y年n月d日', strtotime($row["day"])) . "&emsp;" . $row["classification"] ?></a><br>
                        <?php } ?>
                    </div>

                    <input type="radio" name="tabName" id="tab4" value="4">
                    <label class="tabClass" for="tab4">その他</label>

                    <div class="contentClass">
                        <?php foreach ($stmt4 as $row) { ?>
                            <a href="readReport.php?j_id=<?= $row["j_id"] ?>&a_id=4" class="category2 btn_a "><?= date('Y年n月d日', strtotime($row["day"])) . "&emsp;" . $row["classification"] ?></a><br>
                        <?php } ?>
                    </div>
                </div>
                <input type="hidden" name="hidden" value="hidden">
            </form>
        </div>
    </section>
    <script src="js/favorite.js"></script>
</body>

</html>