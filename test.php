<?php
session_start();
$userName = $_SESSION['USERNAME'];

/**
 * 区分を取得
 */
if (!empty($_SESSION['CLASSFICATION2'])) {
    $classification2 = $_SESSION['CLASSFICATION2'];
    $classificationCheck1 = $classification2 == "ES" ? "checked" : "";
    $classificationCheck2 = $classification2 == "作文・小論文" ? "checked" : "";
    $classificationCheck3 = $classification2 == "筆記" ? "checked" : "";
    $classificationCheck4 = $classification2 == "実技" ? "checked" : "";
} else {
    $classificationCheck1 = "checked";
    $classificationCheck2 = "";
    $classificationCheck3 = "";
    $classificationCheck4 = "";
}

/**
 * 区分詳細を取得
 */
if (!empty($_SESSION['CLASSIFICATION2_TEXT'])) {
    $classification2_text = $_SESSION['CLASSIFICATION2_TEXT'];
    $cTextCheck1 = $classification2_text[0];
    $cTextCheck2 = $classification2_text[1];
    $cTextCheck3 = $classification2_text[2];
    $cTextCheck4 = $classification2_text[3];
    $cTextCheck5 = $classification2_text[4];
    $cTextCheck6 = $classification2_text[5];
} else {
    $cTextCheck1 = "";
    $cTextCheck2 = "";
    $cTextCheck3 = "";
    $cTextCheck4 = "";
    $cTextCheck5 = "";
    $cTextCheck6 = "";
}

/**
 * 持参物を取得
 */

$dsn     = 'mysql:host=localhost;dbname=db26;charset=utf8';
$user     = 'root';
$password = '';
try {
    $dbh = new PDO($dsn, $user, $password);

    // クエリの実行
    $query = "SELECT name FROM mt_property";
    $stmt = $dbh->query($query);




    // 接続を閉じる
    $dbh = null;
} catch (PDOException $e) {
    print("データベースの接続に失敗しました" . $e->getMessage());
    die();
}


$val = $stmt->fetchAll();
for ($i = 0; $i < 8; $i++) {
    $checks[$i] = "";
    $columns[$i] = $val[$i]["name"];
}

if (!empty($_SESSION['PROPERTY'])) {
    $property = $_SESSION['PROPERTY'];
    foreach ($property as $date) {
        for ($j = 0; $j < 8; $j++) {
            if ($date == $columns[$j]) $checks[$j] = "checked";
        }
    }
}


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
    <link rel="stylesheet" type="text/css" href="css/recordBase.css">
    <link rel="stylesheet" type="text/css" href="css/recodeTop.css">
</head>

<body>
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
            <h1 class="t_left">試験</h1>
            <h2 class="t_left">区分</h2>
            <form action="recordCheck.php" method="get">

                <p class="article record_t"><input type="radio" class="radio radio_base" id="es" name="classification" <?= $classificationCheck1 ?> onclick="formSwitch()" value="ES">
                    <label for="es" class="radio_l">ES</label>
                    <input type="radio" class="radio radio_base" id="composition" name="classification" <?= $classificationCheck2 ?> onclick="formSwitch()" value="作文・小論文">
                    <label for="composition" class="radio_l">作文・小論文</label>
                    <input type="radio" class="radio radio_base" id="write" name="classification" <?= $classificationCheck3 ?> onclick="formSwitch()" value="筆記">
                    <label for="write" class="radio_l">筆記</label>
                    <input type="radio" class="radio radio_base" id="skill" name="classification" <?= $classificationCheck4 ?> onclick="formSwitch()" value="実技">
                    <label for="skill" class="radio_l">実技</label>
                </p>


                <div id="list" class="t_left record_t">
                    <div id="esList" class="textarea t_left  record_t record_textarea">
                        <label for="question">質問事項</label><br>
                        <textarea rows="10" cols="60" class="largeText" id="question" name="classification2text[]" value=""><?= $cTextCheck1 ?></textarea>
                    </div>
                    <div id="compositionList" class="textarea t_left  record_t record_textarea">
                        <label for="title">題名：</label>
                        <input type="text" id="title" name="classification2text[]" value="<?= $cTextCheck2 ?>">
                        <label for="time">&emsp;所要時間：</label>
                        <input type="text" id="time" name="classification2text[]" value="<?= $cTextCheck3 ?>">分
                        <label for="wordCnt">&emsp;文字数：</label>
                        <input type="text" id="wordCnt" name="classification2text[]" value="<?= $cTextCheck4 ?>">字
                    </div>
                    <div id="writeList" class="textarea t_left  record_t record_textarea">
                        <label for="contentsW">内容</label><br>
                        <textarea rows="10" cols="60" class="largeText" id="contentsW" name="classification2text[]" value=""><?= $cTextCheck5 ?></textarea>
                    </div>
                    <div id="skillList" class="textarea t_left  record_t record_textarea">
                        <label for="contentsS">内容</label><br>
                        <textarea rows="10" cols="60" class="largeText" id="contentsS" name="classification2text[]" value=""><?= $cTextCheck6 ?></textarea>
                    </div>
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
    <script src="./js/test.js"></script>
</body>

</html>