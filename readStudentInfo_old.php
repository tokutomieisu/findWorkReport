<?php
session_start();
// 前画面から、ログイン者名・検索結果で挙がった会社名をセッションで受け取る
//ユーザー名
//$_SESSION["USERNAME"] = "田中"; //仮データ
$userName = $_SESSION['USERNAME'];
//戻り矢印のとび先
$a_href = "./searchResult.php";
//会社IDと会社名
if (!empty($_GET['c_id'])) {
    $_SESSION["COMPANYID"] = $_GET['c_id'];
}
if (!empty($_GET['c_name'])) {
    $_SESSION["COMPANYNAME"] = $_GET['c_name'];
}
if (!empty($_GET['back'])) {
    $a_href = "favoriteCompany.php";
}


//$_SESSION["COMPANYID"] = "co00001"; //仮データ
$companyId = $_SESSION["COMPANYID"];
//$_SESSION["COMPANYNAME"] = "HAL株式会社"; //仮データ
$companyName = $_SESSION["COMPANYNAME"];
//$_SESSION['OCCUPATIONNAME'] = "SE"; //仮データ
//$_SESSION['INDUSTRYNAME'] = "IT"; //仮データ
$occupationName = $_SESSION['OCCUPATIONNAME'];
$industryName = $_SESSION['INDUSTRYNAME'];

$title = $companyName;
if ($industryName !== "指定なし") {
    $title .=  "&nbsp;" . $industryName;
}
if ($occupationName !== "指定なし") {
    $title .=  "&nbsp;" . $occupationName;
}
// if (isset($industryName)) {
//     $title .=  "&nbsp;" . $industryName;
// }
// if (isset($occupationName)) {
//     $title .=  "&nbsp;" . $occupationName;
// }



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
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/button.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/read.css">
    <link rel="stylesheet" type="text/css" href="css/backImg.css">
    <link rel="stylesheet" type="text/css" href="css/readStudentInfo.css">

    <title>閲覧（学生名）</title>
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
                    <li><a href="search.php?select=read">企業検索</a>
                    <li class="logout"><a href="index.html">ログアウト</a>
                </ul>
            </nav>
        </div>
    </header>

    <a href=<?= $a_href ?> class="backimg"><img src="img/back.png" alt="back"></a>

    <section class="main">
        <div class="text">
            <h1><?= $title ?></h1>
            <div class="area">
                <?php foreach ($stmt as $row) { ?>
                    <a href="findWorkReport.php?af_id=<?= $row["af_id"] ?>" class="category2 btn_a a_list"><?= date('Y年n月d日', strtotime($row["day"])) . "&emsp;" . $row["curriculum"] . "&nbsp;" . $row["course"]; ?></a><br>
                <?php } ?>
            </div>
        </div>
    </section>
</body>

</html>