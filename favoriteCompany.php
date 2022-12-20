<?php
//セッション開始
session_start();
// $_SESSION['USERNAME'] = "大阪 春子";
$userName = $_SESSION['USERNAME'];
$student_id = $_SESSION['USERID'];
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
    if (!empty($stmt)) {
        $count = $stmt->rowCount();
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
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/button.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/backImg.css">
    <link rel="stylesheet" type="text/css" href="css/searchNotFound.css">
    <link rel="stylesheet" type="text/css" href="css/test_search.css">
    <link rel="stylesheet" type="text/css" href="css/readStudentInfo.css">
    <link rel="stylesheet" type="text/css" href="css/favoriteCompany.css">
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

    <a href="./searchResult.php" class="backimg"><img src="img/back.png" alt="back"></a>

    <section class="main">
        <div class="text">
            <h1>検討リスト</h1>
            <div class="area">
                <?php if ($count != 0) { ?>
                    <?php foreach ($stmt as $row) { ?>
                        <a href="readStudentInfo.php?c_id=<?= $row["c_id"] ?>&c_name=<?= $row["c_name"] ?>&back=favorite" class="category2 btn_a a_list"><?= $row["c_name"]; ?></a><br>
                    <?php } ?>
                <?php } else { ?>
                    <h3>検討リストに保存した企業はありません</h3>
                    <p><a class="btn" href="searchResult.php" class="button">戻る</a></p>
                <?php } ?>
            </div>


        </div>
    </section>
</body>

</html>