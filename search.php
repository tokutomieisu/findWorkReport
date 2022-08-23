<?php
//セッション開始
session_start();
// $_SESSION['USERNAME'] = "大阪 春子";
$userName = $_SESSION['USERNAME'];
unset($_SESSION['COMPANYNAME']);
unset($_SESSION['SELECTCOMPANYNAME']);
unset($_SESSION['DAY']);
//入力フォームからデータ受け取り
$select = $_GET['select'];
// echo "select:" . $select, "　";
$_SESSION['SELECT'] = $select;

if ($select == "read") {
    //DB接続
    $dsn      = 'mysql:dbname=db26;host=localhost';
    $user     = 'root';
    $password = '';
    // DBへ接続
    try {
        $dbh = new PDO($dsn, $user, $password);
        // echo "接続成功\n";

        // クエリの実行
        $industrySql = "SELECT * FROM mt_industry";
        $stmt1 = $dbh->query($industrySql);
        $occupationSql = "SELECT * FROM mt_occupation";
        $stmt2 = $dbh->query($occupationSql);
    } catch (PDOException $e) {
        print("データベースの接続に失敗しました" . $e->getMessage());
        die();
    }

    // 接続を閉じる
    $dbh = null;
}

//エラーメッセージの初期化
$errorMessage = "";
//フラグの初期化
$o = false;

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
    <link rel="stylesheet" type="text/css" href="css/selectbox.css">
    <link rel="stylesheet" type="text/css" href="css/backImg.css">
    <title>トップページ</title>
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
    <a href="./select.php" class="backimg"><img src="img/back.png" alt="back"></a>
    <section class="main">
        <form action="searchResult.php" method="get">
            <div class="text">
                <h1>検索</h1>
                <p class="textbox"><input type="text" name="company" value="" placeholder="企業名※部分一致検索" id="inputSerch" autofocus></p>
                <?php if ($select == "read") { ?>
                    <p class="textbox">
                        <select name="industry" id="industry">
                            <option value="in000">業種</option>
                            <?php foreach ($stmt1 as $row) { ?>
                                <option value="<?php echo $row["in_cd"]; ?>"><?php echo $row["in_name"]; ?></option>
                            <?php } ?>
                        </select>
                    </p>

                    <p class="textbox">
                        <select name="occupation" id="occupation">
                            <option value="oc000">職種</option>
                            <?php foreach ($stmt2 as $row) { ?>
                                <option value="<?php echo $row["o_cd"]; ?>"><?php echo $row["o_name"]; ?></option>
                            <?php } ?>
                        </select>
                    </p>
                <?php } ?>
            </div>


            <p><button type="submit" name="sb" class="btn" value="send">検索</button></p>
        </form>
    </section>
    <script src="js/selectSort.js"></script>
</body>

</html>