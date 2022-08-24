<?php
session_start();
$userName = $_SESSION['USERNAME'];
$userId = $_SESSION['USERID'];

//戻り矢印のとび先
$a_href = "./searchResult.php";

if (!empty($_GET['c_id'])) {
    $_SESSION["COMPANYID"] = $_GET['c_id'];
}
if (!empty($_GET['c_name'])) {
    $_SESSION["COMPANYNAME"] = $_GET['c_name'];
}
if (!empty($_GET['back'])) {
    $a_href = "favoriteCompany.php";
}

$companyId = $_SESSION["COMPANYID"];
$companyName = $_SESSION["COMPANYNAME"];

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

    // クエリの実行
    $query = "SELECT f.af_id , f.day , c. curriculum , c.course FROM findworkreport f INNER JOIN affiliation a ON f.af_id = a.id JOIN mt_class c ON a.class_id = c.class_id  WHERE c_id = '$companyId' GROUP BY f.af_id ORDER BY f.day DESC;";

    $stmt = $dbh->query($query);

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
    <link rel="stylesheet" type="text/css" href="css/searchResult_mb.css">
    <link rel="stylesheet" type="text/css" href="css/favorite_mb.css">
    <title>トップページ</title>
</head>

<body>
    <header>

        <div class="headwrrap">
            <form action="readStudentInfo_mb.php" method="post" name="myForm">
                <div class="flex h_textarea">
                    <a href="searchResult_mb.php" class="backimg"><img src="img/back_mb.png" alt="back"></a>
                    <p class="h_text"><?= $companyName ?></p>
                    <span class="star">
                        <input id="review06" type="checkbox" name="review" value="1" <?= $f_check ?> onclick="runOpenstrt()"><label for="review06">★</label>
                    </span>

                </div>
                <input type="hidden" name="hidden1" value="hidden">
            </form>
        </div>

    </header>
    <section class="main">
        <form action="searchResult.php" method="get">
            <div class="text">
                <?php foreach ($stmt as $row) { ?>
                    <p class="panel"><a href="div_mb.php?af_id=<?= $row["af_id"] ?>"><span><?= $row["curriculum"] . "&nbsp;" . $row["course"]; ?></span><span class="date"><?= $row["day"] ?></span></a></p>
                <?php } ?>
            </div>
        </form>
        <footer>
            <div class="footerwrrap">
                <p class="icon">
                    <a href="search_mb.php"><img src="img/search.png" alt=""></a>
                </p>
                <p class="icon">
                    <a href="favoriteCompany_mb.php?pass=readStudentInfo_mb.php"><img src="img/company.png" alt=""></a>
                </p>
            </div>
            <div class="footertext">
                <p class="icontext">検索</p>
                <p class="icontext">検討リスト</p>
            </div>
        </footer>
    </section>
    <script src="js/favorite.js"></script>
</body>

</html>