<?php
session_start();

$userId = $_SESSION['USERID'];
$companyId = $_SESSION["COMPANYID"];

if (!empty($_GET['af_id'])) {
    $_SESSION["af_id"] = $_GET['af_id'];
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

    if ($f_judge == "add") {
        $sql1 = "INSERT INTO student_company (s_id, c_id) VALUES('$userId', '$companyId');";
        $f_c_name[] = $companyName;
        $stmt1 = $dbh->query($sql1);
        $_SESSION['f_c_name'] = $f_c_name;
    } else if ($f_judge == "del") {
        $sql1 = "DELETE FROM student_company WHERE c_id = '$companyId' AND s_id = '$userId';";
        $stmt1 = $dbh->query($sql1);
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
    <link rel="stylesheet" type="text/css" href="css/div_mb.css">
    <link rel="stylesheet" type="text/css" href="css/favorite_mb.css">
    <title>トップページ</title>
</head>

<body>
    <header>
        <div class="headwrrap">
            <form action="div_mb.php" method="post" name="myForm">
                <div class="flex h_textarea">
                    <a href="readStudentInfo_mb.php" class="backimg"><img src="img/back_mb.png" alt="back"></a>
                    <p class="h_text"><?= $companyName ?>
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
    <script src="js/favorite.js"></script>
</body>

</html>