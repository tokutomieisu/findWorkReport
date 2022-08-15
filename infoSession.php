<?php
session_start();
$userName = $_SESSION['USERNAME'];


/**
 * 区分を取得
 */
if (!empty($_SESSION['CLASSFICATION2'])) {
    $classification2 = $_SESSION['CLASSFICATION2'];
    $classificationCheck1 = $classification2 == "合同" ? "checked" : "";
    $classificationCheck2 = $classification2 == "学内" ? "checked" : "";
    $classificationCheck3 = $classification2 == "学外" ? "checked" : "";
} else {
    $classificationCheck1 = "checked";
    $classificationCheck2 = "";
    $classificationCheck3 = "";
}

/**
 * 区分詳細を取得
 */
if (!empty($_SESSION['CLASSIFICATION2_TEXT'])) {
    $classification2_text = $_SESSION['CLASSIFICATION2_TEXT'];
    $cTextCheck1 = $classification2_text[0];
    $cTextCheck2 = $classification2_text[1];
    $cTextCheck3 = $classification2_text[2];
} else {
    $cTextCheck1 = "";
    $cTextCheck2 = "";
    $cTextCheck3 = "";
}

$dsn     = 'mysql:host=localhost;dbname=db26;charset=utf8';
$user     = 'root';
$password = '';

// DBへ接続

try {
    $dbh = new PDO($dsn, $user, $password);

    // クエリの実行
    //ここを変更
    $query = "SELECT name FROM mt_property";
    $stmt = $dbh->query($query);

    $query2 = "SELECT name FROM mt_flow";
    $stmt2 = $dbh->query($query2); 




    // 接続を閉じる
    $dbh = null;
} catch (PDOException $e) {
    print("データベースの接続に失敗しました" . $e->getMessage());
    die();
}

/**
 * 持参物を取得
 * (new)if文のtrueだけバージョンの書き方
 */


/**
 * check0~check7の生成
 * DBから取得したデータをcolums配列に代入
 *  →for文で繰り返すため（foreachや$stmt->fetchAll()だと1回しか回せない）
 */
$val = $stmt->fetchAll();
$val2 = $stmt2->fetchAll();
for ($i = 0; $i < 8; $i++) {
    $checks[$i] = "";
    //配列（筆記用具、印鑑、卒業見込証明書）
    $columns[$i] = $val[$i]["name"];

}
for ($j = 0; $j < 7; $j++) {
    $checks2[$j] = "";
    $columns2[$j] = $val2[$j]["name"];
}


if (!empty($_SESSION['PROPERTY'])) {
    $property = $_SESSION['PROPERTY'];
    foreach ($property as $date) {
        for ($j = 0; $j < 8; $j++) {
            if ($date == $columns[$j]) $checks[$j] = "checked";
        }
    }
}

if (!empty($_SESSION['FLOW'])) {
    $flow = $_SESSION['FLOW'];
    foreach ($flow as $date2) {
        for ($j = 0; $j < 7; $j++) {
            if ($date2 == $columns2[$j]) $checks2[$j] = "checked";
        }
    }
}

// var_dump($GLOBALS);


/**
 * 感想を取得
 */
$thoughts = !empty($_SESSION['THOUGHTS']) ? $_SESSION['THOUGHTS'] : "";

?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>試験</title>
    <link rel="stylesheet" type="text/css" href="css/button.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/backImg.css">
    <link rel="stylesheet" type="text/css" href="css/test.css">
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/recodeTop.css">

</head>

<body>
    <script src="js/infoSession.js"></script>
    <header>
        <div class="headwrrap">
            <div class="flex">
                <p><img src="img/aicon.png" alt="logo"></p>
                <p><?php echo $userName ?>&nbsp;様</p>
            </div>

            <nav>
                <ul>
                    <li><a href="search.php">企業検索</a>
                    <li class="logout"><a href="index.html">ログアウト</a>
                </ul>
            </nav>
        </div>
    </header>

    <a href="recodeTop.php" class="backimg"><img src="img/back.png" alt="back"></a>
    <section class="main">
        <div class="text">
            <h1 class="t_left">説明会</h1>
            <h2 class="t_left">区分</h2>
            <form action="recordCheck.php" method="get">

                <p class="article record_t"><input type="radio" class="radio radio_base" id="es" name="classification2" <?= $classificationCheck1 ?> onclick="formSwitch2()" value="合同" onchange="formSwitch2()">
                    <label for="es" class="radio_l">合同</label>
                    <input type="radio" class="radio radio_base" id="composition" name="classification2" <?= $classificationCheck2 ?> onclick="formSwitch2()" value="学内">
                    <label for="composition" class="radio_l">学内</label>
                    <input type="radio" class="radio radio_base" id="write" name="classification2" <?= $classificationCheck3 ?> onclick="formSwitch2()" value="学外">
                    <label for="write" class="radio_l">学外</label>
                </p>


                <p class="t_left record_t">
                <div id="jointList" class="textarea t_left  record_t">
                    <label for="title">会場名　：</label>
                    <input type="text" id="title" name="classification2text[]" value="<?= $cTextCheck1 ?>">
                </div>
                <div id="onCampusList" class="textarea t_left  record_t">
                    <label for="room">教室名　：</label>
                    <input type="text" id="room" name="classification2text[]" value="<?= $cTextCheck2 ?>">
                </div>
                <div id="offCampusList" class="textarea t_left  record_t">
                    <label for="num">参加人数：</label>
                    <input type="text" id="num" name="classification2text[]" value="<?= $cTextCheck3 ?>">
                </div>
                </p>
                <h2>選考フロー</h2>
                <div class="record_t">
                <?php
                    for ($j = 0; $j < 7; $j++) { ?>
                        <label for="j.<?= $j ?>" class="radio_l"><input class="checkbox" <?= $checks2[$j] ?> type="checkbox" id="j.<?= $j ?>" name="flow[]" value="<?= $columns2[$j] ?>"><?= $columns2[$j] ?></label>
                    <?php } ?>
                </div>
                <h2 class="t_left">持参物</h2>
                <p class="article record_t">
                    <?php
                    for ($i = 0; $i < 8; $i++) { ?>
                        <label for="<?= $i ?>" class="radio_l"><input class="checkbox" <?= $checks[$i] ?> type="checkbox" id="<?= $i ?>" name="property[]" value="<?= $columns[$i] ?>"><?= $columns[$i] ?></label>
                    <?php } ?>
                </p>
                <h2 class="t_left">感想</h2>
                <textarea rows="10" cols="60" class="largeText" name="thoughts"><?php echo $thoughts ?></textarea>
                <p><button type="submit" name="btn" id="btnjs" class="btn btn_narrow" class="button" value="send">確認画面へ</button></p>
            </form>
        </div>
    </section>




    <script src="js/infoSession.js"></script>
</body>

</html>