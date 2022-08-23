<?php
session_start();
$userName = $_SESSION['USERNAME'];

/**
 * 区分を取得
 */
if (!empty($_SESSION['CLASSFICATION2'])) {
    $classification2 = $_SESSION['CLASSFICATION2'];
    $classificationCheck1 = $classification2 == "個人" ? "checked" : "";
    $classificationCheck2 = $classification2 == "集団" ? "checked" : "";
    $classificationCheck3 = $classification2 == "役員" ? "checked" : "";
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
    $cTextCheck4 = $classification2_text[3];
    $cTextCheck5 = $classification2_text[4];
    $cTextCheck6 = $classification2_text[5];
    $cTextCheck7 = $classification2_text[6];
    $cTextCheck8 = $classification2_text[7];
} else {
    $cTextCheck1 = "";
    $cTextCheck2 = "";
    $cTextCheck3 = "";
    $cTextCheck4 = "";
    $cTextCheck5 = "";
    $cTextCheck6 = "";
    $cTextCheck7 = "";
    $cTextCheck8 = "";
}

/**
 * 持参物を取得
 * (new)if文のtrueだけバージョンの書き方
 */
$dsn     = 'mysql:host=localhost;dbname=db26;charset=utf8';
$user     = 'root';
$password = '';

// DBへ接続
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


/**
 * 感想を取得
 */
$thoughts = !empty($_SESSION['THOUGHTS']) ? $_SESSION['THOUGHTS'] : "";


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>面接記録</title>
    <link rel="stylesheet" type="text/css" href="css/button.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/backImg.css">
    <link rel="stylesheet" type="text/css" href="css/test.css">
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/recodeTop.css">
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

    <a href="recodeTop.php" class="backimg"><img src="img/back.png" alt="back"></a>

    <section class="main">
        <div class="text">
            <h1 class="t_left">面接</h1>
            <h2 class="t_left">区分</h2>
            <form action="recordCheck.php" method="get">
                <p class="article record_t">
                    <input type="radio" class="radio radio_base" id="individual" name="classification3" onclick="formSwitch3()" value="個人" <?= $classificationCheck1 ?>>
                    <label for="individual" class="radio_l">個人</label>
                    <input type="radio" class="radio radio_base" id="group" name="classification3" onclick="formSwitch3()" value="集団" <?= $classificationCheck2 ?>>
                    <label for="group" class="radio_l">集団</label>
                    <input type="radio" class="radio radio_base" id="boardMember" name="classification3" onclick="formSwitch3()" value="役員" <?= $classificationCheck3 ?>>
                    <label for="boardMember" class="radio_l">役員</label>
                </p>

                <div id="list" class="t_left record_t">
                    <div id="individualList" class="textarea t_left  record_t record_textarea">
                        <label for="title">面接官：</label>
                        <input type="text" class="title minitext" name="classification2text[]" value="<?= $cTextCheck1 ?>">名・
                        <input type="text" class="title minitext" name="classification2text[]" value="<?= $cTextCheck2 ?>">
                        <label for="title">次面接</label><br>
                        <label for="contentsW">質問内容</label><br>
                        <textarea rows="10" cols="60" class="largeText" id="contentsW" name="classification2text[]" value=""><?= $cTextCheck3 ?></textarea>
                    </div>
                    <div id="groupList" class="textarea">
                        <label for="title">面接官：</label>
                        <input type="text" class="title minitext" name="classification2text[]" value="<?= $cTextCheck4 ?>">名・
                        <label for="title">受験者数：</label>
                        <input type="text" class="title minitext" name="classification2text[]" value="<?= $cTextCheck5 ?>">名<br>
                        <label for="contentsW">質問内容</label><br>
                        <textarea rows="10" cols="60" class="largeText" id="contentsW" name="classification2text[]" value=""><?= $cTextCheck6 ?></textarea>
                    </div>
                    <div id="boardMemberList" class="textarea">
                        <label for="title">面接官：</label>
                        <input type="text" class="title minitext" name="classification2text[]" value="<?= $cTextCheck7 ?>">名<br>
                        <label for="contentsW">質問内容</label><br>
                        <textarea rows="10" cols="60" class="largeText" id="contentsW" name="classification2text[]" value=""><?= $cTextCheck8 ?></textarea>
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
    </section>
    <script src="./js/interview.js"></script>
</body>

</html>