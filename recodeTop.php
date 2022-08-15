<?php
session_start();
// $_SESSION['USERNAME'] = '小松原';
$userName = $_SESSION['USERNAME'];
// $_SESSION['COMPANYNAME'] = '〇〇〇株式会社';
if (!empty($_GET['c_name'])) { //既存企業から登録の場合
    $companyName = $_GET['c_name'];
    $_SESSION['COMPANYNAME'] = $companyName;
    $companyId = $_GET['c_id'];
    $_SESSION['COMPANYID'] = $companyId;
    $sb = "";
} elseif (!empty($_POST['sb'])) { //企業追加後の登録の場合
    $sb = $_POST['sb'];
    $companyName = $_SESSION['COMPANYNAME'];
    $companyNames = $_SESSION['COMPANYNAMES'];
    $companyPost = $_SESSION['COMPANYPOST'];
    $companyAddress = $_SESSION['COMPANYADDRESS'];
    $companyTel = $_SESSION['COMPANYTEL'];
    $companyMail = $_SESSION['COMPANYMAIL'];
    $companySection = $_SESSION['COMPANYSECTION'];
} else {
    $companyName = $_SESSION['COMPANYNAME'];
    $sb = "";
}

unset($_SESSION["CLASSFICATION2"]);
unset($_SESSION["CLASSIFICATION2_TEXT"]);
unset($_SESSION["FLOW"]);
unset($_SESSION["PROPERTY"]);
unset($_SESSION["THOUGHTS"]);

if ($sb == "dummy") {
    //必要なデータsessionで受け取り
    $userName = $_SESSION['USERNAME'];  //学生氏名
    $userNumber = $_SESSION['USERNO'];  //学籍番号
    $companyName = $_SESSION['COMPANYNAME'];    //企業名
    $companyNames = $_SESSION['COMPANYNAMES'];  //企業名称
    $companyPost = $_SESSION['COMPANYPOST'];    //郵便番号
    $companyAddress = $_SESSION['COMPANYADDRESS'];  //住所 
    $companyTel = $_SESSION['COMPANYTEL'];  //電話番号
    $companyMail = $_SESSION['COMPANYMAIL'];    //メールアドレス
    $companySection = $_SESSION['COMPANYSECTION'];  //担当部署
    mb_language("Japanese");
    mb_internal_encoding("UTF-8");
    // 受信者
    $to = "tokutomi.eisu@gmail.com";
    // タイトル
    $subject = "新規企業の申請";
    // 本文
    $message = "申請者：" . $userName . " \r\n" . "学籍番号：" . $userNumber . " \r\n" . "企業名：" . $companyName . " \r\n" . "企業名称：" . $companyNames . " \r\n" . "郵便番号：" . $companyPost . " \r\n" . "住所：" . $companyAddress . " \r\n" . "電話番号：" . $companyTel . " \r\n" . "メールアドレス：" . $companyMail . " \r\n" . "担当部署：" . $companySection;
    // ヘッダー
    $headers = "From: from@gmial.com";

    if (mb_send_mail($to, $subject, $message, $headers)) {
        echo "メールを送信しました";
    } else {
        echo "メールの送信に失敗しました";
    }

    //仮テーブルに企業データ登録
    //DB接続準備
    $dsn      = 'mysql:dbname=db26;host=localhost';
    $user     = 'root';
    $password = '';

    // DBへ接続
    try {
        $dbh = new PDO($dsn, $user, $password);
        // echo "接続成功\n";
        // クエリの実行
        $dummySql = "SELECT * FROM new_company";
        $dstmt = $dbh->query($dummySql);
        $count = $dstmt->rowCount();
        $dId = $count + 1;
        // echo "IDの最大値+1：" . $dId . "\n";
        // echo "IDの桁数は：" . strlen($dId) . "\n";
        // echo $companyName.$companyNames.$companyPost.$companyAddress.$companyTel.$companyMail.$companySection;
        //企業を追加登録する
        $sql = "INSERT INTO new_company (d_id,c_name,c_names,c_post,c_address,c_tel,c_mail,c_section) VALUES(:id,:name,:names,:post,:address,:tel,:email,:section);";
        echo $sql;
        $stmt = $dbh->prepare($sql);
        // 値をセット
        if (strlen($dId) == 1) { //仮企業IDの値が一桁（1～9）の場合
            $stmt->bindValue(':id', 'du0000' . $dId);
            $_SESSION['COMPANYID'] = 'du0000' . $dId; //仮企業コードをセッションに保持
        } else { //仮企業IDの値が二桁（10以上）の場合
            $stmt->bindValue(':id', 'du000' . $dId);
            $_SESSION['COMPANYID'] = 'du000' . $dId; //仮企業コードをセッションに保持
        }
        $stmt->bindValue(':name', $companyName);
        $stmt->bindValue(':names', $companyNames);
        $stmt->bindValue(':post', $companyPost);
        $stmt->bindValue(':address', $companyAddress);
        $stmt->bindValue(':tel', $companyTel);
        $stmt->bindValue(':email', $companyMail);
        $stmt->bindValue(':section', $companySection);
        // クエリを実行
        $stmt->execute();
        //マスターテーブル追加用
        $c_id = $_SESSION['COMPANYID'];
        $query = "INSERT INTO mt_company(c_id,c_name) VALUES('$c_id','$companyName');";
        echo $query;
        $mtstmt = $dbh->query($query);
        //仮企業関係のセッションをクリア
        unset($_SESSION['COMPANYNAMES']);
        unset($_SESSION['COMPANYPOST']);
        unset($_SESSION['COMPANYADDRESS']);
        unset($_SESSION['COMPANYTEL']);
        unset($_SESSION['COMPANYMAIL']);
        unset($_SESSION['COMPANYSECTION']);
    } catch (PDOException $e) {
        print("データベースの接続に失敗しました" . $e->getMessage());
        die();
    }

    // 接続を閉じる
    $dbh = null;
}

/**
 * 日付を取得
 * (new)三項演算子
 */
if (!empty($_SESSION['DAY'])) {
    $day = $_SESSION['DAY'];
    $day = empty($day) ? $day = "" : $day;
} else {
    $day = "";
}

/**
 * 形態を取得（対面・オンライン）
 */
if (!empty($_SESSION['PLACE'])) {
    $place = $_SESSION['PLACE'];
    $offCheck = $place == "対面" ? "checked" : "";
    $onCheck = $place == "オンライン" ? "checked" : "";
} else {
    $offCheck = "checked";
    $onCheck = "";
}

/**
 * 活動内容を取得
 */
if (!empty($_SESSION['ACTIVE'])) {
    $active = $_SESSION['ACTIVE'];
    $infoCheck = $active == "説明会" ? "checked" : "";
    $testCheck = $active == "試験" ? "checked" : "";
    $inteCheck = $active == "面接" ? "checked" : "";
    $othCheck = $active == "その他" ? "checked" : "";
} else {
    $infoCheck = "checked";
    $testCheck = "";
    $inteCheck = "";
    $othCheck = "";
}

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



?>

<?php ?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>記録</title>
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/button.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/backImg.css">
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
                    <li><a href="search.php?select=record">企業検索</a>
                    <li class="logout"><a href="index.html">ログアウト</a>
                </ul>
            </nav>
        </div>
    </header>
    <?php if ($sb == "dummy") { ?>
        <a href="./newCompany.php" class="backimg"><img src="img/back.png" alt="back"></a>
    <?php } else { ?>
        <a href="./searchResult.php" class="backimg"><img src="img/back.png" alt="back"></a>
    <?php } ?>
    <section class="main">
        <div class="text">
            <h1 class="t_left"><?php echo $companyName ?></h1>
            <form action="loop.php" method="get">
                <h2 class="t_left" for="day">日時</h2>
                <p class="t_left record_t"><input type="date" class="record_input" name="day" id="day" value="<?= $day ?>" onchange="isRegNum1(this)">
                </p>
                <div class="flex">
                    <div class="div">
                        <h2 class="t_left" for="industry">業種</h2>
                        <p class="t_left"><select class="record_select" name="industry" id="industry">
                                <!--データベースで業種CDを取ってきて表示する-->
                                <option value="">---</option>
                                <?php foreach ($stmt1 as $row) { ?>
                                    <option value="<?php echo $row["in_cd"]; ?>"><?php echo $row["in_name"]; ?></option>
                                <?php } ?>
                            </select>
                        </p>
                    </div>
                    <div>
                        <p class="textbox">
                        <h2 class="t_left" for="occupation">職種</h2>
                        <p class="t_left"><select class=" record_select" name="occupation" id="occupation">
                                <!--データベースで職種CDを取ってきて表示する-->
                                <option value="">---</option>
                                <?php foreach ($stmt2 as $row) { ?>
                                    <option value="<?php echo $row["o_cd"]; ?>"><?php echo $row["o_name"]; ?></option>
                                <?php } ?>
                            </select>
                        </p>
                    </div>
                </div>

                <h2 class="t_left" for="place">形態</h2>
                <p class="article record_t">
                    <input type="radio" name="place" id="offLine" value="対面" class="radio radio_base" <?= $offCheck ?>>
                    <label class="radio_l" for="offLine">対面</label>
                    <input type="radio" name="place" id="onLine" value="オンライン" class="radio radio_base" <?= $onCheck ?>>
                    <label for="onLine" class="radio_l">オンライン</label>
                </p>

                <h2 class="t_left">活動内容</h2>
                <p class="article record_t"><input id="0" class="checkbox radio_base" type="radio" name="active" value="説明会" class="check" <?= $infoCheck ?>>
                    <label for="0" class="radio_l">説明会</label>
                    <input id="1" class="checkbox radio_base" type="radio" name="active" value="試験" class="check" <?= $testCheck ?>>
                    <label for="1" class="radio_l">試験</label>
                    <input id="2" class="checkbox radio_base" type="radio" name="active" value="面接" class="check" <?= $inteCheck ?>>
                    <label for="2" class="radio_l">面接</label>
                    <input id="3" class="checkbox radio_base" type="radio" name="active" value="その他" class="check" <?= $othCheck ?>>
                    <label for="3" class="radio_l">その他</label>
                </p>

                <p><button type="submit" name="btn" id="btnjs" class="btn btn_narrow" class="button" value="send" disabled>次へ</button></p>
            </form>
        </div>

    </section>
    <script src="js/recordToop.js"></script>
    <script src="js/selectSort.js"></script>
</body>

</html>