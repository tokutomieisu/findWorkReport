<?php
//セッション開始
session_start();
//URLからc_idを取得
$companyId = $_GET['page'];
//echo $companyId;

//DB接続準備
$dsn      = 'mysql:dbname=db26;host=localhost';
$user     = 'root';
$password = '';

// DB接続
try {
    $dbh = new PDO($dsn, $user, $password);
    /***********************************************************/
    //仮企業テーブルのデータ件数を数える
    $aside = "SELECT * FROM new_company WHERE c_id IS NULL;";
    // echo $aside . "\n";

    $stmt0 = $dbh->query($aside);
    $d_count = $stmt0->rowCount();
    // echo $d_count . '件SELECTしました。';
    /***********************************************************/
    // クエリの実行
    $query = "SELECT * FROM mt_company WHERE c_id = '$companyId';";
    $stmt = $dbh->query($query);
    // echo $query;
} catch (PDOException $e) {
    // print("データベースの接続に失敗しました".$e->getMessage());
    die();
}

// 接続を閉じる
$dbh = null;

//表示する情報を変数に保持(1社分のみなのでここで変数にしてしまう)
foreach ($stmt as $row) {
    $companyNo = $row['c_id'];
    //echo $companyNo;
    $companyName = $row['c_name'];
    $_SESSION['COMPANYNAME'] = $companyName;
    echo $companyName;
    $companyNames = $row['c_names'];
    $_SESSION['COMPANYNAMES'] = $companyNames;
    //echo $companyNames;
    $companyPost = $row['c_post'];
    $_SESSION['COMPANYPOST'] = $companyPost;
    //echo $companyPost;
    $companyAddress = $row['c_address'];
    $_SESSION['COMPANYADDRESS'] = $companyAddress;
    //echo $companyAddress;
    $companyTel = $row['c_tel'];
    $_SESSION['COMPANYTEL'] = $companyTel;
    //echo $companyTel;
    $companyMail = $row['c_mail'];
    $_SESSION['COMPANYMAIL'] = $companyMail;
    //echo $companyMail;
    $companySection = $row['c_section'];
    $_SESSION['COMPANYSECTION'] = $companySection;
    //echo $companySection;
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
    <link rel="stylesheet" type="text/css" href="css/aside.css">
    <title>企業編集</title>
</head>

<body>
    <header>
        <div class="headwrrap">
            <div class="flex">
                <p>管理者&nbsp;admin</p>
            </div>

            <nav>
                <ul>
                    <li class="logout"><a href="index.html">ログアウト</a>
                </ul>
            </nav>


        </div>
    </header>

    <section class="main">
        <div class="text">
            <div class="head_flex">
                <h1>企業編集</h1>
            </div>

            <form action="companyEdCheck.php" method="POST">
                <table border="1">

                    <tr>
                        <th>ID</th>
                        <td><?php echo $companyNo; ?></td>
                        <!-- 企業IDを飛ばす -->
                        <input type="hidden" name="form[0]" value="<?php echo $companyNo ?>" required>
                    </tr>

                    <tr>
                        <th>企業名</th>
                        <td><input type="text" name="form[1]" value="<?php echo $companyName; ?>" required></td>
                    </tr>

                    <tr>
                        <th>略称企業名</th>
                        <td><input type="text" name="form[2]" value="<?php echo $companyNames ?>" required></td>
                    </tr>

                    <tr>
                        <th>郵便番号</th>
                        <td><input type="text" name="form[3]" pattern="\d{7}" title="半角数字7桁でご入力ください。" value="<?php echo $companyPost ?>" required></td>
                    </tr>

                    <tr>
                        <th>住所</th>
                        <td><input type="text" name="form[4]" value="<?php echo $companyAddress ?>" required></td>
                    </tr>

                    <tr>
                        <th>電話番号</th>
                        <td><input type="tel" name="form[5]" pattern="\d{10,11}" value="<?php echo $companyTel ?>" required></td>
                    </tr>

                    <tr>
                        <th>メールアドレス</th>
                        <td><input type="email" name="form[6]" value="<?php echo $companyMail ?>" required></td>
                    </tr>

                    <tr>
                        <th>採用課窓口</th>
                        <td><input type="text" name="form[7]" value="<?php echo $companySection ?>" required></td>
                    </tr>


                </table>

                <button type="submit" name="btn" class="btn btn_width" value="ok">完了</button>
            </form>
            <!-- <a class="btn" href="company.html">完了</a> -->
        </div>

    </section>

    <aside id="sub">
        <h2>管理メニュー</h2>
        <ul>
            <li><a href="index.php">トップ</a></li>
            <li><a href="student.php">学生管理</a></li>
            <li><a href="teacher.php">教官管理</a></li>
            <li><a href="company.php">企業管理</a></li>
            <li><a href="#">クラス管理</a></li>
            <li><a href="#">就職管理</a></li>
            <li><a href="newCompany.php">企業申請登録</a>
                <?php if (!empty($d_count)) { ?>
                    <span>未処理<?php echo $d_count ?>件</span>
                <?php } ?>
            </li>
        </ul>
    </aside>

</body>

</html>