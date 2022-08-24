<?php
//セッション開始
session_start();
// $_SESSION['USERNAME'] = "大阪 春子";
$userName = $_SESSION['USERNAME'];
$student_id = $_SESSION['USERID'];
$pass = $_GET['pass'];
//DB接続準備
$dsn    = 'mysql:host=localhost;dbname=db26;charset=utf8';
$user     = 'root';
$password = '';
$br = '<br>';

// DBへ接続
try {
    $dbh = new PDO($dsn, $user, $password);

    // クエリの実行
    $sql = "SELECT  c.c_id,c.c_name FROM mt_student s INNER JOIN student_company sc ON s.student_id = sc.s_id INNER JOIN mt_company c ON c.c_id = sc.c_id WHERE s.student_id = $student_id;";
    $stmt = $dbh->query($sql);

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
</head>

<body>
<header>
        <div class="headwrrap">
            <div class="flex h_textarea">
            <a href="<?= $pass ?>" class="backimg"><img src="img/back_mb.png" alt="back"></a>
                <p class="h_text">検討リスト</p>
            </div>
        </div>
    </header>
    <section class="main">
        <div class="text">
            <div class="area">
                <?php foreach ($stmt as $row) { ?>
                    <p class="panel"><a href="readStudentInfo.php?c_id=<?= $row["c_id"] ?>&c_name=<?= $row["c_name"] ?>&back=favorite" class="category2 btn_a a_list"><?= $row["c_name"]; ?></a></p>
                <?php } ?>
            </div>
        </div>
        <footer>
            <div class="footerwrrap">
                <p class="icon">
                    <a href="search_mb.php"><img src="img/search.png" alt=""></a>
                </p>
                <p class="icon">
                    <a href="favoriteCompany_mb.php?pass=favoriteCompany_mb.php"><img src="img/company.png" alt=""></a>
                </p>
            </div>
            <div class="footertext">
                <p class="icontext">検索</p>
                <p class="icontext">検討リスト</p>
            </div>
        </footer>
    </section>
</body>

</html>