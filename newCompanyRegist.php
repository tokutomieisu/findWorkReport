<?php
session_start();            //セッション開始＆必要な変数
$userName = $_SESSION['USERNAME'];
$companyName = $_POST['companyName'];
$companyNames = $_POST['companyNames'];
$companyPost = $_POST['companyPost'];
$companyAddress = $_POST['companyAddress'];
$companyTel = $_POST['companyTel'];
$companyMail = $_POST['companyMail'];
$companySection = $_POST['companySection'];
$_SESSION['COMPANYNAME'] = $companyName;
$_SESSION['COMPANYNAMES'] = $companyNames;
$_SESSION['COMPANYPOST'] = $companyPost;
$_SESSION['COMPANYADDRESS'] = $companyAddress;
$_SESSION['COMPANYTEL'] = $companyTel;
$_SESSION['COMPANYMAIL'] = $companyMail;
$_SESSION['COMPANYSECTION'] = $companySection;

//登録依頼ボタンを表示させるか(初期値は非表示)
$btnflg = false;


//企業名入力されてないとき
if (strcmp($companyName, '') == 0 || is_null($companyName)) {
    $msg = "企業名を入力してください。";
}



//両方入力されている時
else {
    $msg = "以下の内容で登録申請します。";

    //登録依頼ボタンを表示する
    $btnflg = true;
}
?>

<!-- 内容の表示-->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/button.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/backImg.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <title>企業追加登録申請内容確認</title>
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

    <a href="./newCompany.php" class="backimg"><img src="img/back.png" alt="back"></a>

    <div class="text">
        <h1 class="text_left"><?php echo $msg; ?></h1> <!-- 通った処理に合わせたメッセージ-->
        <?php if ($msg == "以下の内容で登録申請します。") { ?>
            <table border="1">
                <tr>
                    <th>企業名</th>
                    <td><?php echo $companyName; ?></td>
                </tr>
                <tr>
                    <th>略称企業名</th>
                    <td><?php echo $companyNames; ?></td>
                </tr>
                <tr>
                    <th>郵便番号</th>
                    <td><?php echo $companyPost; ?></td>
                </tr>
                <tr>
                    <th>住所</th>
                    <td><?php echo $companyAddress; ?></td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td><?php echo $companyTel; ?></td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td><?php echo $companyMail; ?></td>
                </tr>
                <tr>
                    <th>採用課窓口</th>
                    <td><?php echo $companySection; ?></td>
                </tr>
            </table>
        <?php } ?>

        <!--以下削除（130行目からの内容に修正）
        <?php
        if ($btnflg) {
            // echo '<p><button type ="button" class="btn btn_another">登録依頼</button></p>';   //メールに飛ぶ？(未実装)
            echo '<p><button type ="button" onclick=”location.href=’recodeTop.php’” class="btn btn_another">登録依頼</button></p>';
        }
        ?>

        <form action="newCompany.php" method="post">
            //企業の名前と住所をSessionで送る
            <p><button type="submit" name="sb" class="btn btn_another" value="send">戻る</button></p>
        </form>
    ここまで削除、これ以降追加-->
        <form method="POST">
            <?php
            if ($btnflg) {
                echo '<p><button type="submit" name="sb" class="btn btn_another" value="dummy" formaction="./recodeTop.php">次へ</button></p>';
            }
            ?>
            <!--企業の名前と住所をSessionで送る -->
            <p><button type="submit" name="sb" class="btn btn_another" value="send" formaction="./newCompany.php">戻る</button></p>
        </form>
    </div>
</body>

</html>