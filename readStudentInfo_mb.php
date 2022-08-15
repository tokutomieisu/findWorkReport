<?php
session_start();
$userName = $_SESSION['USERNAME'];

if(!empty($_GET['c_id'])){
    $_SESSION["COMPANYID"] = $_GET['c_id'];
}
if(!empty($_GET['c_name'])){
    $_SESSION["COMPANYNAME"] = $_GET['c_name'];
}

$companyId = $_SESSION["COMPANYID"];
$companyName = $_SESSION["COMPANYNAME"];


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
    <title>トップページ</title>
</head>

<body>
    <header>
        <div class="headwrrap">
            <div class="flex h_textarea">
                <a href="searchResult_mb.php" class="backimg"><img src="img/back_mb.png" alt="back"></a>
                <p class="h_text"><?= $companyName ?></p>
            </div>

        </div>
    </header>
    <section class="main">
        <form action="searchResult.php" method="get">
            <div class="text">
            <?php foreach ($stmt as $row) { ?>
                <p class="panel"><a href="findWorkReport.php?af_id=<?= $row["af_id"] ?>"><span><?= $row["day"] ?></span><span><?= $row["curriculum"] . "&nbsp;" . $row["course"]; ?></span></a></p>
            <?php } ?>
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