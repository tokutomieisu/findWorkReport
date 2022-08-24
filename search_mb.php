<?php
//セッション開始
session_start();
// $_SESSION['USERNAME'] = "大阪 春子";
$userName = $_SESSION['USERNAME'];
unset($_SESSION['COMPANYNAME']);
unset($_SESSION['SELECTCOMPANYNAME']);
unset($_SESSION['DAY']);
// //入力フォームからデータ受け取り
// $select = $_GET['select'];

// $_SESSION['SELECT'] = $select;

// if($select == "read"){
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
// }

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
    <link rel="stylesheet" type="text/css" href="css/base_mb.css">
    <link rel="stylesheet" type="text/css" href="css/button_mb.css">
    <link rel="stylesheet" type="text/css" href="css/login_mb.css">
    <link rel="stylesheet" type="text/css" href="css/header_mb.css">
    <link rel="stylesheet" type="text/css" href="css/footer_mb.css">
    <link rel="stylesheet" type="text/css" href="css/search_mb.css">
    <title>トップページ</title>
</head>

<body>
    <header>
        <div class="headwrrap">
            <div class="flex h_textarea">
                <p class="h_text">検索</p>
            </div>
        </div>
    </header>
    <section class="main">
        <form action="searchResult_mb.php" method="get">
            <div class="text">
                <p class="textbox"><input type="text" name="company" value="" placeholder="企業名で検索" id="inputSerch" autofocus class="input_text"></p>

                <p class="textbox">
                    <select name="industry" id="industry">
                        <option value="in000" hidden selected>業種</option>
                        <?php foreach ($stmt1 as $row) { ?>
                            <option value="<?php echo $row["in_cd"]; ?>"><?php echo $row["in_name"]; ?></option>
                        <?php } ?>
                    </select>
                </p>

                <p class="textbox">
                    <select name="occupation" id="occupation">
                        <option value="oc000" hidden selected>職種</option>
                        <?php foreach ($stmt2 as $row) { ?>
                            <option value="<?php echo $row["o_cd"]; ?>"><?php echo $row["o_name"]; ?></option>
                        <?php } ?>
                    </select>
                </p>
            </div>

            <p><button type="submit" name="sb" class="btn" value="send">検索</button></p>
        </form>
        <footer>
            <div class="footerwrrap">
                <p class="icon">
                    <a href="search_mb.php"><img src="img/search.png" alt=""></a>
                </p>
                <p class="icon">
                    <a href="favoriteCompany_mb.php?pass=search_mb.php"><img src="img/company.png" alt=""></a>
                </p>
            </div>
            <div class="footertext">
                <p class="icontext">検索</p>
                <p class="icontext">検討リスト</p>
            </div>
        </footer>
    </section>
    <script src="js/selectSort.js"></script>
</body>

</html>